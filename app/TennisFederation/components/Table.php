<?php

namespace TennisFederation\components;

use NeoPHP\util\IntrospectionUtils;
use NeoPHP\web\html\HTMLComponent;
use NeoPHP\web\html\HTMLView;
use NeoPHP\web\html\Tag;
use stdClass;

class Table extends HTMLComponent
{
    private $view;
    private $id;
    private $columns;
    private $records;
    private $attributes;
    private $hover;
    private $striped;
    private $bordered;
    private $condensed;
    private $selectable;
    private $selectionClass;
    private $responsive;
    private $recordsIdProperty;
    
    public function __construct(HTMLView $view=null, $attributes = array())
    {
        static $idCounter = 0;
        $this->view = $view;
        $this->id = isset($attributes["id"])? $attributes["id"] : "table_" . ($idCounter++);        
        $this->columns = array();
        $this->records = array();
        $this->attributes = $attributes;
        $this->hover = false;
        $this->striped = false;
        $this->bordered = false;
        $this->responsive = true;
        $this->recordsIdProperty = null;
        $this->selectionClass = "active";
    }
    
    public function addColumn ($name, $property, callable $renderer=null)
    {
        $column = new stdClass();
        $column->name = $name;
        $column->property = $property;
        $column->renderer = $renderer;
        $this->columns[] = $column;
    }
    
    public function setRecords ($records)
    {
        $this->records = $records;
    }
    
    public function addRecord ($record)
    {
        $this->records[] = $record;
    }
    
    public function getRecordsIdProperty()
    {
        return $this->recordsIdProperty;
    }

    public function setRecordsIdProperty($idProperty)
    {
        $this->recordsIdProperty = $idProperty;
    }
    public function getHover()
    {
        return $this->hover;
    }

    public function setHover($hover)
    {
        $this->hover = $hover;
    }

    public function getStriped()
    {
        return $this->striped;
    }

    public function setStriped($striped)
    {
        $this->striped = $striped;
    }

    public function getBordered()
    {
        return $this->bordered;
    }

    public function setBordered($bordered)
    {
        $this->bordered = $bordered;
    }

    public function getCondensed()
    {
        return $this->condensed;
    }

    public function setCondensed($condensed)
    {
        $this->condensed = $condensed;
    }

    public function getResponsive()
    {
        return $this->responsive;
    }

    public function setResponsive($responsive)
    {
        $this->responsive = $responsive;
    }
    
    public function getSelectable()
    {
        return $this->selectable;
    }

    public function setSelectable($selectable)
    {
        $this->selectable = $selectable;
    }
    
    public function getSelectionClass()
    {
        return $this->selectionClass;
    }

    public function setSelectionClass($selectionClass)
    {
        $this->selectionClass = $selectionClass;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }
    
    protected function createContent ()
    {
        $columns = $this->columns;
        $records = $this->records;
        $tableHead = new Tag("thead");
        $tableHeadContainer = new Tag("tr");
        foreach ($columns as $column)
        {
            $tableHeadContainer->add (new Tag("th", array(), $column->name));
        }
        $tableHead->add($tableHeadContainer);
        
        $tableBody = new Tag("tbody");
        foreach ($records as $record)
        {
            $tableRow = new Tag("tr");
            if (!empty($this->recordsIdProperty))
            {
                $tableRow->setAttribute("recordId", IntrospectionUtils::getRecursivePropertyValue($record, $this->recordsIdProperty));
            }
            foreach ($columns as $column)
            {
                if (!is_string($column->property) && is_callable($column->property))
                {
                    $columnValue = call_user_func_array($column->property, array($record));
                }
                else
                {
                    $columnValue = IntrospectionUtils::getRecursivePropertyValue($record, $column->property);
                    if (isset($column->renderer))
                        $columnValue = call_user_func_array($column->renderer, array($columnValue));
                }
                $tableRow->add (new Tag("td", strval($columnValue)));
            }
            $tableBody->add($tableRow);
        }
        
        $tableClassName = "table";
        if ($this->striped)
            $tableClassName .= " table-striped";
        if ($this->hover)
            $tableClassName .= " table-hover";
        if ($this->bordered)
            $tableClassName .= " table-bordered";
        if ($this->condensed)
            $tableClassName .= " table-condensed";
        $table = new Tag("table", array_merge(array("id"=>$this->id, "class"=>$tableClassName, "style"=>"cursor:pointer;"), $this->attributes));
        $table->add($tableHead);
        $table->add($tableBody);
        return ($this->responsive)? new Tag("div", array("class"=>"table-responsive"), $table) : $table;
    }
    
    protected function onBeforeBuild ()
    {
        if ($this->view != null)
        {
            if ($this->selectable)
            {
                $this->view->addScript('
                    $(document).ready(function() 
                    { 
                        $("#' . $this->id . ' > tbody > tr").on("click", function(event) { $(this).addClass("' . $this->selectionClass . '").siblings().removeClass("' . $this->selectionClass . '"); });
                        $("#' . $this->id . '").get(0).getSelectedRecordId = function () { var selectedRows = $("#' . $this->id . ' > tbody > tr.' . $this->selectionClass . '"); return (selectedRows.length > 0)? selectedRows.first().attr("recordId") : false; }
                    });
                ');
            }
        }
    }
}

?>
