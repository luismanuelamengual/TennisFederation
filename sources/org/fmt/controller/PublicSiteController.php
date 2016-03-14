<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use NeoPHP\web\WebController;
use NeoPHP\web\WebTemplateView;

class PublicSiteController extends WebController 
{
    protected function onBeforeAction($action, $parameters) 
    {
        $this->getSession()->destroy();
        return true;
    }

    /**
     * @action
     */
    public function index ()
    {
        return new WebTemplateView("public.portal");
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