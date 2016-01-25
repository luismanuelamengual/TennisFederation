<?php

namespace org\fmt\view;

use com\bootstrap\view\BSPage;

abstract class DefaultView extends BSPage
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle($this->getApplication()->getName());
        $this->addStyleFile($this->getBaseUrl() . "res/css/site.css");
        $this->getBodyTag()->add($this->createMainHeader());
        $this->getBodyTag()->add($this->createMainContent());
    }
    
    protected function createMainHeader ()
    {
        return '
        <div id="mainNavbar" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">' . $this->getApplication()->getName() . '</a>
                </div>
                 <div class="navbar-collapse collapse navbar-responsive-collapse">
                    ' . $this->createHeaderContent() . '
                </div>
            </div>
        </div>';
    }
    
    protected function createMainContent ()
    {
        return '
        <div id="mainContent">
            <div id="mainBody">
                ' . $this->createContent() . '
            </div>
        </div>';
    }
    
    protected abstract function createHeaderContent();
    protected abstract function createContent();
}

?>