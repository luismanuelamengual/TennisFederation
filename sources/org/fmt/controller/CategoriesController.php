<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use org\fmt\model\Category;

class CategoriesController extends SiteController 
{   
    public function indexAction ()
    {
        return $this->showCategoriesListAction();
    }
    
    public function showCategoriesListAction ()
    {
        return $this->createTemplateView("site.categories", ["categories"=>$this->retrieveModels(Category::class, [], ["id"])]);
    }
    
    public function showCategoryFormAction ($id = null)
    {
        return $this->createTemplateView("site.categoryForm", ["category"=>!empty($id)? $this->retrieveModel(Category::class, $id) : null]);
    }
    
    public function createCategoryAction ()
    {
        $category = new Category();
        $category->setFrom($this->getRequest()->getParameters()->get());
        $this->createModel($category);
        return new RedirectResponse($this->getUrl("category/showCategoriesList"));
    }
    
    public function updateCategoryAction ()
    {
        $category = new Category();
        $category->setFrom($this->getRequest()->getParameters()->get());
        $this->updateModel($category);
        return new RedirectResponse($this->getUrl("category/showCategoriesList"));
    }
    
    public function deleteCategoryAction ($id)
    {
        $category = new Category();
        $category->setId($id);
        $this->deleteModel($category);
        return new RedirectResponse($this->getUrl("category/showCategoriesList"));
    }
}