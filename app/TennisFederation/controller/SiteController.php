<?php

namespace TennisFederation\controller;

use NeoPHP\web\WebController;
use TennisFederation\view\ErrorView;

class SiteController extends WebController
{   
    public function onBeforeActionExecution ($action, $params)
    {
        $executeAction = ($action == "login" || $action == "logout" || ($this->getSession()->isStarted() && isset($this->getSession()->sessionId)));
        if (!$executeAction)
            $this->redirectAction("portal/");
        return $executeAction;
    }
    
    public function logoutAction ()
    {
        $this->getSession()->destroy();
        $this->redirectAction("portal/");
    }
    
    public function onActionError ($action, $error)
    {
        $errorView = new ErrorView();
        $errorView->setException ($error);
        $errorView->render();
    }
}

?>
