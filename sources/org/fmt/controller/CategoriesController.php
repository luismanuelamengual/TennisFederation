<?php

namespace org\fmt\controller;

use NeoPHP\web\WebTemplateView;

class CategoriesController extends SiteController 
{
    /**
     * @action
     */
    public function index ()
    {
        return new WebTemplateView("site.categories");
    }
}