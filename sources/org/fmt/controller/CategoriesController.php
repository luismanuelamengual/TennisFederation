<?php

namespace org\fmt\controller;

use NeoPHP\web\WebTemplateView;
use org\fmt\model\Category;

class CategoriesController extends SiteController 
{
    public function indexAction ()
    {
        $categoriesView = new WebTemplateView("site.categories");
        $categoriesView->categories = $this->getConnection()->getEntityManager()->findAll(Category::getClass());
        return $categoriesView;
    }
}