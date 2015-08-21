<?php

namespace org\fmt\controller;

use com\bootstrap\component\BSAlert;
use com\bootstrap\component\BSButton;
use com\bootstrap\component\BSContainer;
use com\bootstrap\component\BSLayoutConstraints;
use com\bootstrap\component\BSDropdownItem;
use com\bootstrap\component\BSDropdownMenu;
use com\bootstrap\component\BSNav;
use com\bootstrap\component\BSNavBar;
use com\bootstrap\component\BSNavItem;
use com\bootstrap\component\BSTable;
use com\bootstrap\component\form\BSForm;
use com\bootstrap\component\form\BSFormField;
use com\bootstrap\component\form\BSTextField;
use com\bootstrap\view\BSPage;
use NeoPHP\web\WebController;

class MainController extends WebController
{
    public function onBeforeActionExecution ($action, $params)
    {
        $this->getSession()->destroy();
        return true;
    }
   
    public function indexAction ()
    {
        $dropMenu = new BSDropdownMenu();
        $dropMenu->addItem(new BSDropdownItem("PEPE"));
        $dropMenu->addItem(new BSDropdownItem("HONGEX"));
        $dropMenu->addDivider();
        $dropMenu->addItem(new BSDropdownItem("titoch"));
        $item1 = new BSNavItem("action1");
        $item2 = new BSNavItem("action2");
        $item2->setMenu($dropMenu);
        $nav = new BSNav();
        $nav->addItem($item1);
        $nav->addItem($item2);
        $navBar = new BSNavBar();
        $navBar->setBrand("Sitrack.com");
        $navBar->addNav($nav);
        
        $table = new BSTable();
        $table->setHeaders(["Id", "Nombre", "Apellido", "Edad"]);
        $table->addRow([11, "Luis", "Amengual", 33]);
        $table->addRow([2, "Pipo", "Chippolaz", 72]);
        $table->addRow([5, "Ramon", "Pareditas", 14]);
        $table->addRow([45, "Sigmund", "Froid", 41]);
        $table->setRowStyle(1, BSTable::STYLE_WARNING);
        $table->setCellStyle(3, 2, BSTable::STYLE_DANGER);
        
        $form = new BSForm();
        $formConstraints = new BSLayoutConstraints();
        $formConstraints->colsSm = 6;
        $form->addField(new BSTextField(["label"=>"Nombre", "helpTexts"=>["(*) Campo requerido"]]));
        $form->addField(new BSTextField(["label"=>"Apellido", "value"=>"Super campo", "style"=>BSFormField::STYLE_WARNING]));
        $form->addField(new BSTextField(["label"=>"Direccion", "disabled"=>true]), $formConstraints);
        $form->addField(new BSTextField(["label"=>"Telefono", "style"=>BSFormField::STYLE_ERROR, "helpTexts"=>["Formato no valido de teléfono"]]), $formConstraints);
        $form->addButton(new BSButton("Guardar", ["style"=>BSButton::STYLE_PRIMARY]));
        $form->addButton(new BSButton("Cancelar"));
        
        $alert = new BSAlert();
        $alert->setText("Este es un mensaje copado de advertencia !!");
        $alert->setStyle(BSAlert::STYLE_DANGER);
        $alert->setDismissible(true);
        
        $container = new BSContainer();
        $containerConstraints = new BSLayoutConstraints();
        $containerConstraints->colsSm = 6;
        $container->addElement($alert);
        $container->addElement($table, $containerConstraints);
        $container->addElement($form, $containerConstraints);
        
        
        $page = new BSPage();        
        $page->addElement($navBar);
        $page->addElement($container);
        
        return $page;
    }
    
    public function showPortalAction ()
    {
        
    }
}

?>