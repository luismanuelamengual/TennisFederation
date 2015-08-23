<?php

namespace org\fmt\controller;

use com\bootstrap\component\BSAlert;
use com\bootstrap\component\BSButton;
use com\bootstrap\component\BSCarousel;
use com\bootstrap\component\BSContainer;
use com\bootstrap\component\BSDropdownItem;
use com\bootstrap\component\BSDropdownMenu;
use com\bootstrap\component\BSLayoutConstraints;
use com\bootstrap\component\BSModal;
use com\bootstrap\component\BSNav;
use com\bootstrap\component\BSNavBar;
use com\bootstrap\component\BSNavItem;
use com\bootstrap\component\BSTable;
use com\bootstrap\component\card\BSCard;
use com\bootstrap\component\card\BSCardColumns;
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
        $modal = new BSModal();
        $modal->setTitle("Super formulario modal");
        $modal->addElement("Este es el contenido del modal");
        $modal->addFooterElement(new BSButton("Guardar"));
        
        
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
        $navBar = new BSNavBar(["useContainer"=>true]);
        $navBar->setBrand("Sitrack.com");
        $navBar->addNav($nav);
        
        
        $carousel = new BSCarousel();
        $carousel->addSlide("res/images/background1.jpg", "Titular 1", "Este es un texto de prueba");
        $carousel->addSlide("res/images/background4.jpg", "Titulo 2", "Lorem ipsum dolor sit amet");
        
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
        
        $cardColumns = new BSCardColumns();
        for($i = 1; $i <= 8; $i++)
        {
            $card = new BSCard();
            if ($i == 2)
            {
                $card->setInversed(true);
                $card->setStyle (BSCard::STYLE_INFO);
            }
            if ($i%4==0)
                $card->addHeader ("Encabezado de carta");
            $card->addTitle("Super carta " . $i);
            $card->addText($i%2==0?"Lorem ipsum dolor sit amet":"Rembla ripola dorem spsum dolor sit amet alessandra rampolla laralaral ambar de gorilla");
            $cardColumns->addCard($card);
        }
        
        $container = new BSContainer();
        $containerConstraints = new BSLayoutConstraints();
        $containerConstraints->colsMd = 6;
        $container->addElement($alert);
        $container->addElement($table, $containerConstraints);
        $container->addElement($form, $containerConstraints);
        $container->addElement($cardColumns);
        
        
        $page = new BSPage();    
        $page->addElement($modal);
        $page->addElement($navBar);
        $page->addElement($container);
        $page->addScript("
            (function () 
            {
                $('#bs18').click(function() 
                {
                    $('#bs1').modal();
                });
            })();
        ");
        
        return $page;
    }
    
    public function showPortalAction ()
    {
        
    }
}

?>