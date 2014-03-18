<?php

namespace TennisFederation\controllers\site;

use TennisFederation\controllers\SiteController;
use TennisFederation\models\Category;

class CategoryController extends SiteController
{
    public function indexAction()
    {
        $categories = $this->getCategories();        
        $categoryView = $this->createView("site/categories");
        $categoryView->setCategories ($categories);
        $categoryView->render();
    }
    
    private function getCategories ()
    {
        $categories = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCategory = $database->getDataObject ("category");
        $doCategory->find();
        while ($doCategory->fetch())
        {
            $category = new Category();
            $category->completeFromFieldsArray($doCategory->getFields());
            $categories[] = $category;
        }
        return $categories;
    }
}

?>
