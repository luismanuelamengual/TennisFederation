<?php

namespace org\fmt\view;

use NeoPHP\web\html\HTMLPage;
use NeoPHP\web\WebView;
use org\fmt\view\component\TestComponent1;
use org\fmt\view\component\TestComponent2;

class TestView extends HTMLPage 
{
    private $views;

    public function __construct() 
    {
        parent::__construct();
        $this->addView(new TestComponent1());
        $this->addView(new TestComponent2($this));
    }
    
    public function addView (WebView $view)
    {
        $this->views[] = $view;
    }
    
    protected function build() 
    {
        foreach ($this->views as $view)
        {
            $this->bodyTag->add($view->render(true));
        }       
    }
}

?>