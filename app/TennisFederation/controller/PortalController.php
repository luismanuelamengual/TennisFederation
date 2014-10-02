<?php

namespace TennisFederation\controllers;

use NeoPHP\web\WebController;

class PortalController extends WebController
{   
    public function onBeforeActionExecution ($action)
    {
        $this->executeAction("session/deleteResource");
        return true;
    }
    
    public function indexAction ()
    {
        $this->createView('site/portal')->render();
    }
}

?>

