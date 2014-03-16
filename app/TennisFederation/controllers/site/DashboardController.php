<?php

namespace TennisFederation\controllers\site;

use TennisFederation\controllers\SiteController;

class DashboardController extends SiteController
{
    public function indexAction ()
    {
        $this->createView("site/dashboard")->render();
    }
}

?>