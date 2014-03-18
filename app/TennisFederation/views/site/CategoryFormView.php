<?php

namespace TennisFederation\views\site;

use NeoPHP\web\html\Tag;
use TennisFederation\components\Button;
use TennisFederation\components\Form;
use TennisFederation\components\Selector;
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
        $matchTypeSelector = new Selector($this, array("placeholder"=>"Tipo de Partido", "name"=>"matchtype"));
        $matchTypeSelector->setOptions(array(Match::MATCHTYPE_SINGLES=>"Singles", Match::MATCHTYPE_DOUBLES=>"Dobles"));
        $descriptionTextField = new Tag("input", array("placeholder"=>"Descripción", "type"=>"text", "class"=>"form-control", "name"=>"description"));
        if ($this->category != null)
        {
            $matchTypeSelector->setValue($this->category->getMatchType ());
            $descriptionTextField->setAttribute("value", $this->category->getDescription());
        }
        $form = new Form(array("method"=>"post", "action"=>($this->category != null)? "updateCategory" : "createCategory"));
        $form->setType(Form::TYPE_HORIZONTAL);
        $form->addField($descriptionTextField, "Descripción");
        $form->addField($matchTypeSelector, "Tipo de Partido");
        $form->addButton(new Button("Guardar datos", array("class"=>"btn btn-primary")));
        return $form;
    }
}

?>
