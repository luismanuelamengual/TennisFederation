<?php

namespace org\fmt\controller;

use NeoPHP\web\WebController;
use NeoPHP\web\WebScriptView;

/**
 * @route (path="/")
 * @route (path="portal")
 */
class PortalController extends WebController
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
        return new WebScriptView("org\\fmt\\view\\PortalView");
    }
}

?>