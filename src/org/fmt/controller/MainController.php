<?php

namespace org\fmt\controller;

use NeoPHP\web\WebController;
use org\fmt\view\PortalView;

class MainController extends WebController
{
    public function onBeforeActionExecution ($action, $params)
    {
        $this->getSession()->destroy();
        return true;
    }
   
    public function indexAction ()
    {
        return new PortalView();        
    }
}

?>