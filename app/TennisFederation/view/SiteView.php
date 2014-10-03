<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\model\UserType;

abstract class SiteView extends DefaultView
{
    protected function build ()
    {
        parent::build();
        $this->setTitle($this->getApplication()->getName());
        $this->addScripts();
        $this->buildHead();
        $this->buildBody();
    }
    
    protected function addScripts ()
    {
        $this->addStyleFile($this->getBaseUrl() . "assets/font-awesome/css/font-awesome.css");
        $this->addStyleFile($this->getBaseUrl() . "css/style.css?_dc=4");
    }
    
    protected function buildHead ()
    {
    }
    
    protected function buildBody()
    {
        $this->getBodyTag()->add($this->createHeader());
        $this->getBodyTag()->add($this->createContent());
    }
    
    protected function createHeader ()
    {   
        return '
        <nav id="header" class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="' . $this->getUrl("site/dashboard/") . '" class="navbar-brand" href="#">' . $this->getApplication()->getName() . '</a>
                </div>
                <div class="navbar-collapse collapse navbar-responsive-collapse">
                    ' . $this->createMainMenu() . '
                    ' . $this->createUserMenu() . '
                </div>
            </div>
        </nav>';
    }
    
    protected function createMainMenu()
    {
        $mainMenu = new Tag("ul", array("class"=>"nav navbar-nav navbar-left"));
        if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR)
            $mainMenu->add ($this->createAdministratorToolsMenu());
        if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR || $this->getSession()->type == UserType::USERTYPE_ORGANIZER)
            $mainMenu->add ($this->createOrganizerToolsMenu());
        if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR || $this->getSession()->type == UserType::USERTYPE_ORGANIZER || $this->getSession()->type == UserType::USERTYPE_PLAYER)
            $mainMenu->add ($this->createPlayerToolsMenu());
        return $mainMenu;
    }
    
    protected function createUserMenu()
    {
        return '
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">            
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-user"></i> ' . $this->getSession()->firstname . ' ' . $this->getSession()->lastname . ' <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#" onclick="loadUrl(\'' . $this->getUrl("account/") . '\')"><i class="fa fa-user"></i> Mi Cuenta</a></li>
                    <li><a href="#" onclick="loadUrl(\'' . $this->getUrl("settings/") . '\')"><i class="fa fa-gear"></i> Configuración</a></li>
                    <li class="divider"></li>
                    <li><a href="' . $this->getUrl("site/logout") . '"><i class="fa fa-power-off"></i> Salir</a></li>
                </ul>
            </li>
        </ul>';
    }
    
    protected function createAdministratorToolsMenu ()
    {
        $list = new Tag("ul", array("class"=>"dropdown-menu"));
        $list->add ($this->createToolMenuItem ("Adm Usuarios", "site/user/"));
        $list->add ($this->createToolMenuItem ("Adm Categorías", "site/category/"));
        $list->add ($this->createToolMenuItem ("Adm Clubes", "site/club/"));
        $list->add ($this->createToolMenuItem ("Adm Paises", "site/country/"));
        $list->add ($this->createToolMenuItem ("Adm Provincias", "site/province/"));
        return new Tag("li", array(new Tag("a", array("href"=>"#", "class"=>"dropdown-toggle", "data-toggle"=>"dropdown"), "&nbsp;Administración<b class=\"caret\"></b>"), $list));;
    }
    
    protected function createOrganizerToolsMenu ()
    {
        $list = new Tag("ul", array("class"=>"dropdown-menu"));
        $list->add ($this->createToolMenuItem ("Adm Torneos", "site/tournament/"));
        $list->add ($this->createToolMenuItem ("Adm Rankings", "site/ranking/"));
        $list->add ($this->createToolMenuItem ("Adm Anuncios", "site/notification/"));
        return new Tag("li", array(new Tag("a", array("href"=>"#", "class"=>"dropdown-toggle", "data-toggle"=>"dropdown"), "&nbsp;Organización<b class=\"caret\"></b>"), $list));;
    }
    
    protected function createPlayerToolsMenu ()
    {
        $list = new Tag("ul", array("class"=>"dropdown-menu"));
        $list->add ($this->createToolMenuItem ("Ver Torneos", "site/tournament/viewAll"));
        $list->add ($this->createToolMenuItem ("Ver Rankings", "site/ranking/viewAll"));
        return new Tag("li", array(new Tag("a", array("href"=>"#", "class"=>"dropdown-toggle", "data-toggle"=>"dropdown"), "&nbsp;Jugadores<b class=\"caret\"></b>"), $list));;
    }
    
    protected function createToolMenuItem ($title, $action)
    {
        $menuItem = new Tag("li", array(), new Tag("a", array("href"=>$this->getUrl($action)), $title));
        if ($this->getMenuItemAction() == $action)
            $menuItem->setAttribute ("class", "active");
        return $menuItem;
    }
    
    protected function getMenuItemAction ()
    {
        return null;
    }
    
    protected function createMainContent ()
    {
        return new Tag("div", array("class"=>"col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"));
    }
    
    protected function createFooter ()
    {
        return '';
    }
        
    protected function createHeaderContent ()
    {   
        $content = "";
        $content .= $this->createUserNavbar();
        return $content;
    }
    
    protected function createUserNavbar ()
    {
        return '
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown">            
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-user"></i> ' . $this->getSession()->firstname . ' ' . $this->getSession()->lastname . ' <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="' . $this->getUrl("site/user/myAccount") . '"><i class="icon-user"></i> Mi Cuenta</a></li>
                    <li><a href="' . $this->getUrl("settings/") . '"><i class="icon-gear"></i> Configuración</a></li>
                    <li class="divider"></li>
                    <li><a href="' . $this->getUrl("site/logout") . '"><i class="icon-power-off"></i> Salir</a></li>
                </ul>
            </li>
        </ul>';
    }
    
    protected abstract function createContent();
}

?>