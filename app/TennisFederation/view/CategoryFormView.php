<?php

namespace TennisFederation\view;

use NeoPHP\web\html\Tag;
use TennisFederation\component\Button;
use TennisFederation\component\Combobox;
use TennisFederation\component\Form;
use TennisFederation\model\Category;
use TennisFederation\model\Match;
use TennisFederation\view\SiteView;

class CategoryFormView extends SiteView
{
    private $category;
    
    public function setCategory (Category $category)
    {
        $this->category = $category;
    }
    
    protected function createContent() 
    {
        $container = new Tag("div", array("class"=>"container"));
        $container->add (new Tag("h2", array("class"=>"page-header"), $this->category != null? "Edición de Categoría" : "Creación de Categoría"));
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
        
        $form = new Form(array("method"=>"post", "action"=>($this->category != null)? "updateCategory" : "createCategory"));
        $form->add($idHiddenField);
        $form->addField($descriptionTextField, array("label"=>"Descripción"));
        $form->addField($matchTypeCombobox, array("label"=>"Tipo de Partido"));
        $form->add(new Button("Guardar datos", array("type"=>"submit", "class"=>"btn btn-primary")));
        return $form;
    }
}

?>