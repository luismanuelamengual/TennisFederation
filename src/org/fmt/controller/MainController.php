<?php

namespace org\fmt\controller;

use NeoPHP\web\WebController;
use org\fmt\view\PortalView;

/**
 * @route (path="/")
 */
class MainController extends WebController
{
    public function onBeforeActionExecution ($action, $params)
    {
        $this->getSession()->destroy();
        return true;
    }
   
    /**
     * @routeAction
     */
    public function showPortal ()
    {
        return new PortalView();
    }
}

?>