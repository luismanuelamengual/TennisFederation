<?php

namespace TennisFederation\controllers;

use TennisFederation\controllers\SiteController;

class DashboardController extends SiteController
{
    public function indexAction ()
    {
        $this->createView("site/dashboard")->render();
    }
}

?>