<?php

namespace org\fmt\controller;

use NeoPHP\web\http\RedirectResponse;
use NeoPHP\web\WebController;

class PublicSiteController extends WebController 
{
    protected function onBeforeAction($action, $parameters) 
    {
        $this->getSession()->destroy();
        return true;
    }

    public function indexAction ()
    {
        return $this->createTemplateView("site.login");
    }
    
    public function logoutAction ()
    {
        $this->getSession()->destroy();
        return new RedirectResponse($this->getUrl("/"));
    }
}