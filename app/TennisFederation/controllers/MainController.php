<?php

namespace TennisFederation\controllers;

use NeoPHP\web\WebController;

class MainController extends WebController 
{
    public function indexAction ()
    {
        $this->executeAction("site/portal/");
    }
}

?>