<?php

namespace org\fmt\controller;

use NeoPHP\util\ArrayList;
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
//        $list = new ArrayList();
//        
//        
//        $list->add(1);
//        $list->add(25);
//        $list[] = "ljlkjlk";
//        
//        $otherList = new ArrayList();
//        $otherList->add(25);
//        $otherList->add(2235);
//        
//        
//        $list->addAll($otherList);
//        $list->addAll(["hola", 57]);
//        
//        $list->insert(2, "item en pos 2");
//        
//        $list->removeAll([1,2235]);
//        $list->remove("hola");
//        
//        $list->remove("lsajdfal");
//        
//        $list->insert(4, "item4");
//        $list->add(546);
//        
//        $list->removeAt(3);
//        
//        
//        
//        echo "<pre>";
//        print_r($list->toArray());
//        echo "</pre>";
//        
//        echo "<pre>";
//        print_r($list->subList(2, 4)->toArray());
//        echo "</pre>";
//        
//        exit;
        
        return new WebTemplateView("public.portal");
    }
    
    public function logoutAction ()
    {
        $this->getSession()->destroy();
        return new RedirectResponse("/");
    }
}