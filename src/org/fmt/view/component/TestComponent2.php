<?php

namespace org\fmt\view\component;

use NeoPHP\web\html\HTMLPage;
use NeoPHP\web\html\HTMLTag;
use NeoPHP\web\WebView;

class TestComponent2 extends WebView
{
    private $htmlPage;
    
    function __construct(HTMLPage $htmlPage) 
    {
        $this->htmlPage = $htmlPage;
    }
    
    public function onRender() 
    {
        $this->htmlPage->addScriptFile("pepech.js");
        $this->htmlPage->addScript("console.log(1);");
        $body = new HTMLTag("div", ["class"=>"titoch"]);
        echo $body->toHtml();
    }
}

?>