<?php

namespace TennisFederation\controller;

use NeoPHP\web\WebController;
use TennisFederation\view\ErrorView;

/**
 * @route (path="/")
 */
class SiteController extends WebController
{   
    public function onBeforeActionExecution ($action, $params)
    {
//        $executeAction = ($action == "login" || $action == "logout" || ($this->getSession()->isStarted() && isset($this->getSession()->sessionId)));
//        if (!$executeAction)
//            $this->redirectAction("portal/");
//        return $executeAction;
        return true;
    }
    
    /**
     * @routeAction
     */
    public function helloWorld ()
    {
        echo "hola mundo";
        echo "<br>";
        if (is_subclass_of($this->getClassName(), \NeoPHP\core\Object::getClassName() ))
            echo 'yes';
        else 
            echo 'no';
    }
    
    /**
     * @routeAction (action="pepe")
     */
    public function aaa ()
    {
        echo "alfa";
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
