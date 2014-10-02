<?php

namespace TennisFederation\controller;

use TennisFederation\controller\SiteController;

class DashboardController extends SiteController
{
    public function indexAction ()
    {
        $this->createView("site/dashboard")->render();
    }
}

?>