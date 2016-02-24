<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use NeoPHP\web\WebController;
use NeoPHP\web\WebTemplateView;

class SiteController extends WebController
{
    private $sessionlessActions = ["logout"];
    
    protected function onBeforeAction($action, $parameters) 
    {
        $this->getSession()->start();
        
        if (!empty($action) && !in_array($action, $this->sessionlessActions))
        {
            if (!isset($this->getSession()->sessionId))
            {
                $response = new RedirectResponse("/");
                $response->send();
                return false;
            }
        }
        
        return parent::onBeforeAction($action, $parameters);
    }
    
    /**
     * @action
     */
    public function index ()
    {      
        if (!isset($this->getSession()->sessionId))
        {
            $view = new WebTemplateView("portal");
        }
        else
        {
            $view = new WebTemplateView("dashboard");
        }
        return $view;
    }
    
    /**
     * @action (name="logout")
     */
    public function logout ()
    {
        $this->getSession()->destroy();
        return new RedirectResponse("/");
    }
}