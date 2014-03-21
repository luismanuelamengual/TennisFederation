<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\EntityTable;
use TennisFederation\models\Match;
use TennisFederation\views\site\SiteView;

class CategoriesView extends SiteView
{
    private $categories = array();
    
    public function setCategories ($categories)
    {
        $this->categories = $categories;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), "Administración de Categorias"));
        $container->add ($this->createButtonToolbar());
        $container->add ($this->createCategoriesTable());
        return $container;
    }
    
    protected function createButtonToolbar()
    {
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary", "onclick"=>"createCategory();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("id"=>"updateButton", "class"=>"btn btn-primary", "onclick"=>"updateCategory();", "disabled"=>"true"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("id"=>"deleteButton", "class"=>"btn btn-primary", "onclick"=>"deleteCategory();", "disabled"=>"true"))));
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
    
    protected function addScripts ()
    {
        parent::addScripts();
        $this->addScript ('
            function getSelectedCategoryId ()
            {
                var selectedRows = $("#categoriesTable > tbody > tr.danger"); 
                return (selectedRows.length > 0)? selectedRows.first().attr("categoryId") : false;
            }
            
            function selectCategory (categoryId)
            {
                $("tr[categoryId=" + categoryId + "]").addClass("danger").siblings().removeClass("danger");
                $("#updateButton").prop("disabled",false); 
                $("#deleteButton").prop("disabled",false);
            }

            function createCategory ()
            {
                window.open("' . $this->getUrl("site/category/showCategoryForm") . '", "_self");
            }
            
            function updateCategory ()
            {
                var selectedCategoryId = getSelectedCategoryId();
                if (selectedCategoryId != false)
                    window.open("' . $this->getUrl("site/category/showCategoryForm") . '?categoryid=" + selectedCategoryId, "_self");
            }
            
            function deleteCategory ()
            {
                var selectedCategoryId = getSelectedCategoryId();
                if (selectedCategoryId != false)
                    if (window.confirm("Esta seguro de eliminar la categoría " + selectedCategoryId + " ?"))
                        window.open("' . $this->getUrl("site/category/deleteCategory") . '?categoryid=" + selectedCategoryId, "_self");
            }
        ');
        
        $this->addOnDocumentReadyScript('
            var tableRows = $("#categoriesTable > tbody > tr");
            tableRows.on("click", function(event) { selectCategory($(this).attr("categoryId")); });
            tableRows.on("dblclick", function(event) { updateCategory(); });
        ');
    }
}

?>