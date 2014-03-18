<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\Table;
use TennisFederation\views\site\SiteView;

class CategoriesView extends SiteView
{
    private $categories;
    
    public function setCategories ($categories)
    {
        $this->categories = $categories;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), "Administración de Categorias"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createCategoriesGrid());
        return $container;
    }
    
    protected function createCategoriesGrid()
    {
        $table = new Table();
        $table->addColumn (Table::createColumn ("#", "id"));
        $table->addColumn (Table::createColumn ("Nombre", "description"));
        $table->addColumn (Table::createColumn ("Tipo de Partido", "matchtype", function ($matchType) { return $matchType==1?"Singles":"Dobles";}));
        $table->setRecords($this->categories);  
        $this->addScript ('$(document).ready(function() { $("table > tbody > tr").on("click", function(event) { console.log($(this)); $(this).addClass("danger").siblings().removeClass("danger"); }); }); ');        
        return $table;
    }
    
    protected function createButtonToolbar()
    {
        $createButton = new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary"));
        $updateButton = new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("class"=>"btn btn-primary"));
        $deleteButton = new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("class"=>"btn btn-primary"));
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", $createButton));
        $toolbar->add (new Tag("li", $updateButton));
        $toolbar->add (new Tag("li", $deleteButton));
        return $toolbar;
    }
}

?>
