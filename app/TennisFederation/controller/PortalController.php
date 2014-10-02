<?php

namespace TennisFederation\controller;

use NeoPHP\web\WebController;
use TennisFederation\view\PortalView;

class PortalController extends WebController
{   
    public function onBeforeActionExecution ($action, $params)
    {
        $this->getSession()->destroy();
        return true;
    }
    
    public function indexAction ()
    {
        $view = new PortalView();
        $view->render();
    }
}

?>

