<?php

namespace TennisFederation\controller;

use NeoPHP\web\WebController;

class PortalController extends WebController
{   
    public function onBeforeActionExecution ($action, $params)
    {
        $this->getSession()->destroy();
        return true;
    }
    
    public function indexAction ()
    {
//        $this->createView('site/portal')->render();
    }
}

?>

