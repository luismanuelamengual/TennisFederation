<?php

namespace TennisFederation\controllers\site;

use TennisFederation\controllers\SiteController;

class PlayerController extends SiteController
{
    public function onBeforeActionExecution ($action)
    {
        return ($action == "index" || $action == "showRegistrationForm" || $action == "register") ? true : parent::onBeforeActionExecution ($action);
    }
    
    public function indexAction()
    {
        $this->showRegistrationFormAction();
    }
    
    public function showRegistrationFormAction()
    {
        
    }
    
    public function registerAction()
    {
        
    }
}

?>
