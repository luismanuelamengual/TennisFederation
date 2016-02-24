<?php

namespace org\fmt\controller;

use NeoPHP\web\WebTemplateView;

class DashboardController extends SiteController {
    
    /**
     * @action
     * @return WebTemplateView
     */
    public function showDashboard ()
    {
        return new WebTemplateView("dashboard");
    }
}