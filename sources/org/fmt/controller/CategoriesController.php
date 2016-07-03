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
        $categoriesView = $this->createTemplateView("site.categories");
        $categoriesView->categories = $this->retrieveModels(Category::class, [], ["id"]);
        return $categoriesView;
    }
    
    public function showCategoryFormAction ($id = null)
    {
        $categoryFormView = $this->createTemplateView("site.categoryForm");
        if (!empty($id))
            $categoryFormView->category = $this->retrieveModel(Category::class, $id);
        return $categoryFormView;
    }
    
    public function saveCategoryAction ($id, $description, $type)
    {
        $category = new Category();
        if (!empty($id))
            $category->setId ($id);
        $category->setDescription($description);
        $category->setMatchType($type);
        $this->persistModel($category);
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