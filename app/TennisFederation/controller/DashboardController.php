<?php

namespace TennisFederation\controller;

use TennisFederation\controller\SiteController;
use TennisFederation\view\DashboardView;

class DashboardController extends SiteController
{
    public function indexAction ()
    {
        $view = new DashboardView();
        $view->render();
    }
}

?>