<?php

namespace TennisFederation\controllers;

use Exception;
use NeoPHP\web\WebController;

class SiteController extends WebController
{   
    public function onBeforeActionExecution ($action)
    {
        $executeAction = ($action == "login" || $action == "logout" || ($this->getSession()->isStarted() && isset($this->getSession()->sessionId)));
        if (!$executeAction)
            $this->redirectAction("site/portal/");
        return $executeAction;
    }
    
    public function indexAction ()
    {
        $this->executeAction("site/portal/");
    }
    
    public function loginAction ()
    {  
        try
        {
            $sessionId = $this->executeAction("session/startSession");
            if ($sessionId == false)
                throw new Exception ("Nombre de usuario o contraseña incorrecta");
            $this->redirectAction('site/dashboard/');
        }
        catch (Exception $ex) 
        {
            $this->executeAction('site/portal/', array($ex->getMessage()));
        }
    }
    
    public function logoutAction ()
    {
        $this->executeAction("session/destroySession");
        $this->redirectAction();
    }
    
    public function onActionError ($action, $error)
    {
        $errorView = $this->createView("site/error");
        $errorView->setException ($error);
        $errorView->render();
    }
}

?>
