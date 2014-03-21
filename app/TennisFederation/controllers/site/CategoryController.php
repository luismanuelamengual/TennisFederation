<?php

namespace TennisFederation\controllers\site;

use Exception;
use TennisFederation\controllers\SiteController;
use TennisFederation\models\Category;
use TennisFederation\models\PlayerType;

class CategoryController extends SiteController
{
    public function onBeforeActionExecution ($action)
    {
        $executeAction = parent::onBeforeActionExecution($action);
        if ($executeAction && $this->getSession()->type != PlayerType::PLAYERTYPE_ADMINISTRATOR)
            throw new Exception ("No tiene permisos para acceder a este controlador");
        return $executeAction;
    }
    
    public function indexAction()
    {
        $this->showCategoriesListAction();
    }
    
    public function showCategoriesListAction ()
    {
        $this->renderCategoriesView();
    }
    
    public function showCategoryFormAction($categoryid=null)
    {
        $categoryView = $this->createView("site/categoryForm");
        if ($categoryid != null)
            $categoryView->setCategory($this->getCategory($categoryid));
        $categoryView->render();
    }
    
    public function createCategoryAction($description, $matchtype)
    {
        $category = new Category();
        $category->setDescription($description);
        $category->setMatchType($matchtype);
        $this->createCategory($category);
        $this->renderCategoriesView();
    }
    
    public function updateCategoryAction($categoryid, $description, $matchtype)
    {
        $category = new Category();
        $category->setId($categoryid);
        $category->setDescription($description);
        $category->setMatchType($matchtype);
        $this->updateCategory($category);
        $this->renderCategoriesView();
    }
    
    public function deleteCategoryAction($categoryid)
    {
        $this->deleteCategory($categoryid);
        $this->renderCategoriesView();
    }
    
    private function renderCategoriesView ()
    {
        $categories = $this->getCategories();        
        $categoryView = $this->createView("site/categories");
        $categoryView->setCategories ($categories);
        $categoryView->render();
    }
    
    public function getCategories ()
    {
        $categories = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCategory = $database->getDataObject ("category");
        $doCategory->addOrderByField ("categoryid");
        $doCategory->find();
        while ($doCategory->fetch())
        {
            $category = new Category();
            $category->completeFromFieldsArray($doCategory->getFields());
            $categories[] = $category;
        }
        return $categories;
    }
    
    public function getCategory ($categoryid)
    {
        $category = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCategory = $database->getDataObject ("category");
        $doCategory->addWhereCondition("categoryid = " . $categoryid);
        if ($doCategory->find(true))
        {
            $category = new Category();
            $category->completeFromFieldsArray($doCategory->getFields());
        }
        return $category;
    }
    
    public function createCategory (Category $category)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCategory = $database->getDataObject ("category");
        $doCategory->description = $category->getDescription();
        $doCategory->matchtype = $category->getMatchType();
        $doCategory->insert();
    }
    
    public function updateCategory (Category $category)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCategory = $database->getDataObject ("category");
        $doCategory->description = $category->getDescription();
        $doCategory->matchtype = $category->getMatchType();
        $doCategory->addWhereCondition("categoryid = " . $category->getId());
        $doCategory->update();
    }
    
    public function deleteCategory ($categoryid)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCategory = $database->getDataObject ("category");
        $doCategory->addWhereCondition("categoryid = " . $categoryid);
        $doCategory->delete();
    }
}

?>