<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\models\UserType;

class SiteView extends DefaultView
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
    
    protected function buildBody ()
    {
        $this->bodyTag->add($this->createHeader());
        $this->bodyTag->add($this->createContent());
        $this->bodyTag->add($this->createFooter());
    }
    
    protected function createHeader ()
    {   
        return '
        <div id="mainNavbar" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="' . $this->getUrl('site/dashboard/') . '" class="navbar-brand">' . $this->getApplication()->getName() . '</a>
                </div>
                <div class="navbar-collapse collapse">
                    ' . $this->createHeaderContent() . '
                </div>
            </div>
        </div>';
    }
    
    protected function createContent()
    {
        $container = new Tag("div", array("class"=>"container-fluid"));
        $container->add ($this->createSideBar());
        $container->add ($this->createMainContent());
        return $container;
    }
    
    protected function createSideBar ()
    {
        $sidebar = new Tag("div", array("class"=>"col-sm-3 col-md-2 sidebar"));
        $sidebar->add ($this->createMainToolsMenu());
        if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR)
            $sidebar->add ($this->createAdministratorToolsMenu());
        if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR || $this->getSession()->type == UserType::USERTYPE_ORGANIZER)
            $sidebar->add ($this->createOrganizerToolsMenu());
        if ($this->getSession()->type == UserType::USERTYPE_ADMINISTRATOR || $this->getSession()->type == UserType::USERTYPE_ORGANIZER || $this->getSession()->type == UserType::USERTYPE_PLAYER)
            $sidebar->add ($this->createPlayerToolsMenu());
        return $sidebar;
    }
    
    protected function createMainToolsMenu ()
    {
        $list = new Tag("ul", array("class"=>"nav nav-sidebar"));
        $list->add ($this->createToolMenuItem ("Tabla de Anuncios", "site/dashboard/"));
        return $list;
    }
    
    protected function createAdministratorToolsMenu ()
    {
        $list = new Tag("ul", array("class"=>"nav nav-sidebar"));
        $list->add ($this->createToolMenuItem ("Adm Usuarios", "site/user/"));
        $list->add ($this->createToolMenuItem ("Adm Categorías", "site/category/"));
        $list->add ($this->createToolMenuItem ("Adm Clubes", "site/club/"));
        $list->add ($this->createToolMenuItem ("Adm Paises", "site/country/"));
        $list->add ($this->createToolMenuItem ("Adm Provincias", "site/province/"));
        return $list;
    }
    
    protected function createOrganizerToolsMenu ()
    {
        $list = new Tag("ul", array("class"=>"nav nav-sidebar"));
        $list->add ($this->createToolMenuItem ("Adm Torneos", "site/tournament/"));
        $list->add ($this->createToolMenuItem ("Adm Rankings", "site/ranking/"));
        $list->add ($this->createToolMenuItem ("Adm Anuncios", "site/notification/"));
        return $list;
    }
    
    protected function createPlayerToolsMenu ()
    {
        $list = new Tag("ul", array("class"=>"nav nav-sidebar"));
        $list->add ($this->createToolMenuItem ("Ver Torneos", "site/tournament/viewAll"));
        $list->add ($this->createToolMenuItem ("Ver Rankings", "site/ranking/viewAll"));
        return $list;
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
}

?>