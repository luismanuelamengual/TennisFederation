<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use org\fmt\manager\CategoriesManager;
use org\fmt\model\Category;

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
        return $this->showCategoriesListAction();
    }
    
    public function showCategoriesListAction ()
    {
        $categoriesView = $this->createTemplateView("site.categories");
        $categoriesView->categories = $this->getCategoriesManager()->getCategories();
        return $categoriesView;
    }
    
    public function showCategoryFormAction ($id = null)
    {
        $categoryFormView = $this->createTemplateView("site.categoryForm");
        if (!empty($id))
            $categoryFormView->category = $this->getCategoriesManager()->getCategory ($id);
        return $categoryFormView;
    }
    
    public function saveCategoryAction ($id, $description, $type)
    {
        $category = new Category();
        if (!empty($id))
            $category->setId ($id);
        $category->setDescription($description);
        $category->setMatchType($type);
        $this->getCategoriesManager()->persistCategory($category);
        return new RedirectResponse($this->getUrl("category/showCategoriesList"));
    }
    
    public function deleteCategoryAction ($id)
    {
        $category = new Category();
        $category->setId($id);
        $this->getCategoriesManager()->deleteCategory($category);
        return new RedirectResponse($this->getUrl("category/showCategoriesList"));
    }
}