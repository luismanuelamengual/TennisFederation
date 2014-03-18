<?php

namespace TennisFederation\components;

use NeoPHP\util\IntrospectionUtils;
use NeoPHP\web\html\HTMLComponent;
use NeoPHP\web\html\Tag;
use stdClass;

class Table extends HTMLComponent
{
    private $id;
    private $columns;
    private $records;
    private $attributes;
    private $hover;
    private $striped;
    private $bordered;
    private $condensed;
    private $responsive;
    
    public function __construct($attributes = array())
    {
        static $idCounter = 0;
        $this->id = isset($attributes["id"])? $attributes["id"] : "table_" . ($idCounter++);        
        $this->columns = array();
        $this->records = array();
        $this->attributes = $attributes;
        $this->hover = false;
        $this->striped = true;
        $this->bordered = false;
        $this->responsive = true;
    }
    
    public static function createColumn ($name, $property, callable $renderer=null)
    {
        $column = new stdClass();
        $column->name = $name;
        $column->property = $property;
        $column->renderer = $renderer;
        return $column;
    }
    
    public function setColumns ($columns)
    {
        $this->columns = $columns;
    }
    
    public function addColumn ($column)
    {
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
}

?>
