<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\Combobox;
use TennisFederation\components\Form;
use TennisFederation\models\Category;
use TennisFederation\models\Match;
use TennisFederation\views\site\SiteView;

class CategoryFormView extends SiteView
{
    private $category;
    
    public function setCategory (Category $category)
    {
        $this->category = $category;
    }
    
    protected function createMainContent() 
    {
        $container = parent::createMainContent();
        $container->add (new Tag("h1", array("class"=>"page-header"), $this->category != null? "Edición de Categoría" : "Creación de Categoría"));
        $container->add ($this->createForm());
        return $container;
    }
    
    protected function createForm ()
    {
        $idHiddenField = new Tag("input", array("type"=>"hidden", "name"=>"categoryid"));
        $matchTypeCombobox = new Combobox(array("placeholder"=>"Tipo de Partido", "name"=>"matchtype"), array(Match::MATCHTYPE_SINGLES=>"Singles", Match::MATCHTYPE_DOUBLES=>"Dobles"));
        $descriptionTextField = new Tag("input", array("placeholder"=>"Descripción", "type"=>"text", "class"=>"form-control", "name"=>"description"));
        if ($this->category != null)
        {
            $idHiddenField->setAttribute("value", $this->category->getId());
            $descriptionTextField->setAttribute("value", $this->category->getDescription());
            $matchTypeCombobox->setAttribute("value", $this->category->getMatchType());
        }
        
        $form = new Form(Form::TYPE_HORIZONTAL, array("method"=>"post", "action"=>($this->category != null)? "updateCategory" : "createCategory"));
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, "Descripción");
        $form->addField($matchTypeCombobox, "Tipo de Partido");    
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>