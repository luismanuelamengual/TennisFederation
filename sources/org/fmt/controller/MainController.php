<?php

namespace org\fmt\controller;

use NeoPHP\web\WebController;
use NeoPHP\web\WebTemplateView;

class MainController extends WebController
{
    public function onBeforeAction ($action, $params)
    {
        $this->getSession()->destroy();
        return true;
    }
   
    /**
     * @action
     */
    public function indexAction ()
    {      
        return new WebTemplateView("portal");
    }
}

?>