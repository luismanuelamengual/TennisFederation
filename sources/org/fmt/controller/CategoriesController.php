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
        return $this->createTemplateView("site.categories.list", ["categories"=>$this->findModels(Category::class, ["sorters"=>["id"]])]);
    }
    
    public function showCategoryFormAction ($id = null)
    {
        return $this->createTemplateView("site.categories.form", ["category"=>!empty($id)? $this->findModel(Category::class, $id) : null]);
    }
    
    public function createCategoryAction ()
    {
        $this->insertModel($this->createModel(Category::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("category/showCategoriesList"));
    }
    
    public function updateCategoryAction ()
    {
        $this->updateModel($this->createModel(Category::class, $this->getRequest()->getParameters()->get()));
        return new RedirectResponse($this->getUrl("category/showCategoriesList"));
    }
    
    public function deleteCategoryAction ($id)
    {
        $this->removeModel(new Category($id));
        return new RedirectResponse($this->getUrl("category/showCategoriesList"));
    }
}