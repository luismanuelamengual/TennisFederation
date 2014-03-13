<?php

namespace TennisFederation\controllers\site;

use NeoPHP\web\WebController;

class PortalController extends WebController
{   
    public function onBeforeActionExecution ($action)
    {
        $this->executeAction("session/destroySession");
        return true;
    }
    
    public function indexAction ($message=null)
    {
        $this->createView('site/portal')->render();
    }
}

?>

