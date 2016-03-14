<?php

namespace org\fmt\controller;

use NeoPHP\web\WebTemplateView;

class DashboardController extends SiteController 
{    
    /**
     * @action
     */
    public function index ()
    {
        return new WebTemplateView("site.dashboard");        
    }
}