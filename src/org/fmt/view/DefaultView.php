<?php

namespace org\fmt\view;

use com\bootstrap\component\BSNavBar;
use com\bootstrap\view\BSPage;
use NeoPHP\web\html\HTMLPage;
use NeoPHP\web\html\HTMLTag;

abstract class DefaultView extends BSPage
{
    private $mainNavBar;
    private $mainContent;
    
    public function __construct()
    {
        parent::__construct();
        $this->setTitle($this->getApplication()->getName());
        $this->addStyleFile($this->getBaseUrl() . "res/css/site.css");
        $this->mainNavBar = $this->createMainNavBar();
        $this->mainContent = $this->createMainContent();
        $this->addElement($this->mainNavBar);
        $this->addElement($this->mainContent);
    }
    
    private function createMainNavBar ()
    {
        $mainHeader = new BSNavBar();
        $mainHeader->setId("mainnavbar");
        $mainHeader->setBrand($this->getApplication()->getName());
        $mainHeader->setStyle(BSNavBar::STYLE_DEFAULT);
        return $mainHeader;
    }
    
    private function createMainContent ()
    {
        $mainContent = new class extends \com\bootstrap\component\BSComponent
        {
            public function build (HTMLPage $page, HTMLTag $parent)
            {
                $mainBodyDiv = new HTMLTag("div", ["id"=>"mainbody"]);
                parent::build($page, $mainBodyDiv);
                $mainDiv = new HTMLTag("div", ["id"=>"maincontainer"]);
                $mainDiv->add($mainBodyDiv);
                $parent->add($mainDiv);
            }
        };
        return $mainContent;
    }
    
    function getMainNavBar() 
    {
        return $this->mainNavBar;
    }

    function getMainContent() 
    {
        return $this->mainContent;
    }
}

?>