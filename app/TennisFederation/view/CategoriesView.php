<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\component\Button;
use TennisFederation\component\EntityTable;
use TennisFederation\model\Match;
use TennisFederation\view\SiteView;

class CategoriesView extends SiteView
{
    private $categories = array();
    
    public function setCategories ($categories)
    {
        $this->categories = $categories;
    }
    
    protected function build()
    {
        parent::build();
        $this->addScript('
            $("#categoriesTable tr").on(
            {
                click: function (e) 
                {
                    $("#categoriesTable tr").removeClass("danger");
                    $(this).addClass("danger");
                    $("#updateButton").prop("disabled",false); 
                    $("#deleteButton").prop("disabled",false); 
                },
                dblclick: function (e)
                {
                    var id = $(this).attr("categoryId");
                    window.open("showCategoryForm?categoryid=" + id, "_self");
                }
            });
            $("#createButton").click(function (e) 
            {
                window.open("showCategoryForm", "_self");
            });
            $("#updateButton").click(function (e) 
            {
                var id = $("#categoriesTable tr.danger").attr("categoryId");
                window.open("showCategoryForm?categoryid=" + id, "_self");
            });
            $("#deleteButton").click(function (e) 
            {
                var id = $("#categoriesTable tr.danger").attr("categoryId");
                if (window.confirm("Esta seguro de eliminar la categoría " + id + " ?"))
                    window.open("deleteCategory?categoryid=" + id, "_self");
            });
        ');
    }
    
    protected function createContent() 
    {
        $container = new Tag("div", array("class"=>"container"));
        $container->add (new Tag("h2", array("class"=>"page-header"), "Administración de Categorias"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createCategoriesTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("id"=>"createButton", "class"=>"btn btn-primary"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "disabled"=>"true"))));
        return $toolbar;
    }
    
    protected function createCategoriesTable()
    {
        $table = new EntityTable(array("id"=>"categoriesTable"));
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "description");
        $table->addColumn ("Tipo de Partido", "matchtype", function ($matchType) { return $matchType==Match::MATCHTYPE_SINGLES?"Singles":"Dobles";});
        $table->setEntities($this->categories);
        $table->addEntityProperty("categoryId", "id");
        return $table;
    }
}

?>