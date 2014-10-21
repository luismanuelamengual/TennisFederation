<?php

namespace TennisFederation\controller;

use TennisFederation\controller\SiteController;
use TennisFederation\model\Category;
use TennisFederation\view\CategoriesView;
use TennisFederation\view\CategoryFormView;

class CategoryController extends SiteController
{   
    public function showCategoryListAction ()
    {
        $categoryView = new CategoriesView();
        $categoryView->setCategories (Category::findAll());
        $categoryView->render();
    }
    
    public function showCategoryFormAction($categoryid=null)
    {
        $categoryView = new CategoryFormView();
        if ($categoryid != null)
            $categoryView->setCategory(Category::findById($categoryid));
        $categoryView->render();
    }
    
    public function createCategoryAction($description, $matchtype)
    {
        $category = new Category();
        $category->setDescription($description);
        $category->setMatchType($matchtype);
        $category->persist();
        $this->showCategoryListAction();
    }
    
    public function updateCategoryAction($categoryid, $description, $matchtype)
    {
        $category = new Category();
        $category->setId($categoryid);
        $category->setDescription($description);
        $category->setMatchType($matchtype);
        $category->persist();
        $this->showCategoryListAction();
    }
    
    public function deleteCategoryAction($categoryid)
    {
        $category = new Category();
        $category->setId($categoryid);
        $category->delete();
        $this->showCategoryListAction();
    }
}

?>