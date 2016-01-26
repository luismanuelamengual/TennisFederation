<?php

namespace org\fmt\view;

use com\bootstrap\component\BSButton;
use com\bootstrap\component\BSDropdownItem;
use com\bootstrap\component\BSDropdownMenu;
use com\bootstrap\component\BSModal;
use com\bootstrap\component\BSNav;
use com\bootstrap\component\BSNavBar;
use com\bootstrap\component\BSNavItem;
use com\bootstrap\component\form\BSForm;
use com\bootstrap\component\form\BSPasswordField;
use com\bootstrap\component\form\BSTextField;
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
        $this->addElement($this->mainContent);
        $this->addElement($this->mainNavBar);
    }
    
    protected function isSessionStarted()
    {
        return $this->getSession()->isStarted() && isset($this->getSession()->sessionId);
    }
    
    private function createMainNavBar ()
    {
        $navbar = new BSNavBar();
        $navbar->setId("mainnavbar");
        $navbar->setBrand($this->getApplication()->getName());
        $navbar->setStyle(BSNavBar::STYLE_DEFAULT);
        $navbar->setCollapsible(true);
        $navbar->setUseContainer(true);
        
        if ($this->isSessionStarted())
        {
            $userIcon = new HTMLTag("i", ["class"=>"fa fa-user"], "");
            $closeIcon = new HTMLTag("i", ["class"=>"fa fa-sign-out"], "");
            $userAccountItem = new BSDropdownItem($userIcon->toHtml() . " " . "Mi Cuenta");
            $userAccountItem->setHref($this->getUrl("user/showUserAccount"));
            $closeSessionItem = new BSDropdownItem($closeIcon->toHtml() . " " . "Salir");
            $closeSessionItem->setHref($this->getUrl("site/logout"));
            $menu = new BSDropdownMenu();
            $menu->addItem($userAccountItem);
            $menu->addItem($closeSessionItem);
            $userItem = new BSNavItem($userIcon->toHtml() . " " . $this->getSession()->firstName . " " . $this->getSession()->lastName);
            $userItem->setMenu($menu);
            $nav = new BSNav();
            $nav->addItem($userItem);
            $navbar->addNav($nav, "navbar-right");
        }
        else
        {
            $this->addElement($this->createLoginModal());
            $nav = new BSNav();
            $nav->addItem(new BSNavItem("Registrate", ["href"=>$this->getUrl("/user/showRegistrationForm")]));
            $nav->addItem(new BSNavItem("Ingresa", ["attributes"=>["data-toggle"=>"modal", "data-target"=>"#mainmodal"]]));
            $navbar->addNav($nav, "navbar-right");
        }
        
        return $navbar;
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
    
    protected function createLoginModal ()
    {
        $form = new BSForm();
        $form->addField(new BSTextField(["label"=>"Usuario", "name"=>"loginUsername", "emptyText"=>"Nombre de Usuario"]));
        $form->addField(new BSPasswordField(["label"=>"Contraseña", "name"=>"loginPassword", "emptyText"=>"Contraseña"]));
        $form->addButton(new BSButton("Iniciar sesión", ["id"=>"loginButton", "style"=>BSButton::STYLE_PRIMARY, "type"=>"submit"]));
        $modal = new BSModal();
        $modal->setId("mainmodal");
        $modal->setTitle("Inicio de sesión");
        $modal->addElement($form);
        $this->addScript('
        (function ()
        {
            function disableLoginControls ()
            {
                $("#mainmodal input").attr("disabled", "true");
                $("#mainmodal button").attr("disabled", "disabled");
            }
            
            function enableLoginControls ()
            {
                $("#mainmodal input").removeAttr("disabled");
                $("#mainmodal button").removeAttr("disabled");
            }

            function clearLoginError ()
            {
                $("#mainmodal .help-block").remove();
                $("#mainmodal .alert").remove();
                $("#mainmodal .has-error").removeClass("has-error");
            }

            function showLoginError (message)
            {
                clearLoginError();
                $("#mainmodal .form-group").addClass("has-error");
                $("#mainmodal .modal-body").prepend($("<div>").addClass("alert").addClass("alert-danger").html(message));
            }

            $("#loginButton").click(function() 
            {
                clearLoginError();
                disableLoginControls();
                $("body").css("cursor", "wait");
                var $form = $(this).closest("form");
                var username = $form.find("input[name=loginUsername]")[0].value;
                var password = $form.find("input[name=loginPassword]")[0].value;
                $.ajax("' . $this->getUrl("session/") . '",
                {
                    method: "POST",
                    data:
                    {
                        username: username,
                        password: password
                    },
                    success: function (contents)
                    {
                        window.open("' . $this->getUrl("site/") . '?PHPSESSID=" + contents, "_self");
                    },
                    error: function (qXHR, textStatus, errorThrown)
                    {
                        showLoginError(qXHR.responseText);
                    },
                    timeout: function ()
                    {
                        showLoginError("Se ha agotado el tiempo de conexión. Intente más tarde");
                    },
                    complete: function ()
                    {
                        enableLoginControls();
                        $("input[name=username]").focus();
                        $("body").css("cursor", "default");
                    }
                });
            });
            
            $("#mainmodal").on("shown.bs.modal", function (e) 
            {
                $("input[name=username]").focus();
            })
            
            $("#mainmodal").on("show.bs.modal", function (e) 
            {
                clearLoginError();
                $("input[name=loginUsername]").val("");
                $("input[name=loginPassword]").val("");
            })
        })();
        ');
        return $modal;
    }
}

?>