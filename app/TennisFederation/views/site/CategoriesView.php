<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\EntityTable;
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
        $container->add ($this->createCategoriesTable());
        return $container;
    }
    
    protected function createCategoriesTable()
    {
        $table = new EntityTable(array("id"=>"categoriesTable"));
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "description");
        $table->addColumn ("Tipo de Partido", "matchtype", function ($matchType) { return $matchType==1?"Singles":"Dobles";});
        $table->setEntities($this->categories);
        $table->addEntityProperty("categoryId", "id");
        $this->addOnDocumentReadyScript('
            var tableRows = $("#categoriesTable > tbody > tr");
            tableRows.on("click", function(event) { $(this).addClass("danger").siblings().removeClass("danger"); });
            tableRows.on("dblclick", function(event) { updateCategory(); });
        ');
        return $table;
    }
    
    protected function createButtonToolbar()
    {
        $this->addScript ('
            function getSelectedCategoryId ()
            {
                var selectedRows = $("#categoriesTable > tbody > tr.danger"); 
                return (selectedRows.length > 0)? selectedRows.first().attr("categoryId") : false;
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
        $toolbar = new Tag("ul", array("class"=>"nav nav-pills"));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-file"></span>&nbsp;Crear', array("class"=>"btn btn-primary", "onclick"=>"createCategory();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifiar', array("class"=>"btn btn-primary", "onclick"=>"updateCategory();"))));
        $toolbar->add (new Tag("li", new Button('<span class="glyphicon glyphicon-trash"></span>&nbsp;Eliminar', array("class"=>"btn btn-primary", "onclick"=>"deleteCategory();"))));
        return $toolbar;
    }
}

?>
