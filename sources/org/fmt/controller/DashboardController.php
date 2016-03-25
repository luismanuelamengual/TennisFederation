<?php

namespace org\fmt\controller;

class DashboardController extends SiteController 
{
    public function indexAction ()
    {
        return $this->createTemplateView("site.dashboard");  
    }
}