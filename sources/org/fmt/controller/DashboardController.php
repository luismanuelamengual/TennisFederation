<?php

namespace org\fmt\controller;

use NeoPHP\web\WebTemplateView;

class DashboardController extends SiteController 
{
    public function indexAction ()
    {
        return new WebTemplateView("site.dashboard");        
    }
}