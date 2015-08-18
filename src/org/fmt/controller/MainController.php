<?php

namespace org\fmt\controller;

use com\bootstrap\component\BSButton;
use com\bootstrap\component\BSGridLayout;
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
        $table = new BSTable();
        $table->setHeaders(["Id", "Nombre", "Apellido", "Edad"]);
        $table->addRow([11, "Luis", "Amengual", 33]);
        $table->addRow([2, "Pipo", "Chippolaz", 72]);
        $table->addRow([5, "Ramon", "Pareditas", 14]);
        $table->addRow([45, "Sigmund", "Froid", 41]);
        $table->setRowStyle(1, BSTable::STYLE_WARNING);
        $table->setCellStyle(3, 2, BSTable::STYLE_DANGER);
        
        $form = new BSForm();
        $form->addField(new BSTextField(["label"=>"Nombre", "helpTexts"=>["(*) Campo requerido"]]));
        $form->addField(new BSTextField(["label"=>"Apellido", "value"=>"Super campo", "style"=>BSFormField::STYLE_WARNING]));
        $form->addField(new BSTextField(["label"=>"Direccion", "disabled"=>true]), [BSGridLayout::COLS_MD=>6]);
        $form->addField(new BSTextField(["label"=>"Telefono", "style"=>BSFormField::STYLE_ERROR, "helpTexts"=>["Formato no valido de teléfono"]]), [BSGridLayout::COLS_MD=>6]);
        $form->addButton(new BSButton("Guardar", ["style"=>BSButton::STYLE_PRIMARY]));
        $form->addButton(new BSButton("Cancelar"));
        
        $page = new BSPage();
        $page->addElement($table, [BSGridLayout::COLS_MD=>6]);
        $page->addElement($form, [BSGridLayout::COLS_MD=>6]);
        
        return $page;
    }
    
    public function showPortalAction ()
    {
        
    }
}

?>