<?php

namespace TennisFederation\controller;

use TennisFederation\controller\SiteController;

class DashboardController extends SiteController
{
    public function indexAction ()
    {
        $view = new \TennisFederation\view\DashboardView();
        $view->render();
    }
}

?>