<?php

namespace org\fmt\controller;

use org\fmt\manager\CategoriesManager;

class CategoriesController extends SiteController 
{
    /**
     * Obtiene el manejador de categorias
     * @return CategoriesManager Manejador de categorias
     */
    private function getCategoriesManager ()
    {
        return $this->getManager(CategoriesManager::class);
    }
    
    public function indexAction ()
    {
        $categoriesView = $this->createTemplateView("site.categories");
        $categoriesView->categories = $this->getCategoriesManager()->findCategories();
        return $categoriesView;
    }
}