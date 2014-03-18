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
        $table = new Table($this, array("id"=>"categoriesTable"));
        $table->setRecordsIdProperty("id");
        $table->addColumn ("#", "id");
        $table->addColumn ("Nombre", "description");
        $table->addColumn ("Tipo de Partido", "matchtype", function ($matchType) { return $matchType==1?"Singles":"Dobles";});
        $table->setRecords($this->categories);  
        $table->setSelectable(true);
        return $table;
    }
    
    protected function createButtonToolbar()
    {
        $this->addScript ('
            function createCategory ()
            {
                window.open("' . $this->getUrl("site/category/showCategoryForm") . '", "_self");
            }
            
            function updateCategory ()
            {
                var selectedCategoryId = $("#categoriesTable").get(0).getSelectedRecordId();
                if (selectedCategoryId != false)
                    window.open("' . $this->getUrl("site/category/showCategoryForm") . '?categoryid=" + selectedCategoryId, "_self");
            }
            
            function deleteCategory ()
            {
                var selectedCategoryId = $("#categoriesTable").get(0).getSelectedRecordId();
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
