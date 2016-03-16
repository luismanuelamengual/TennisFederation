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

    public function indexAction ()
    {
        return new WebTemplateView("public.portal");
    }
    
    public function logoutAction ()
    {
        $this->getSession()->destroy();
        return new RedirectResponse("/");
    }
}