<?php

namespace org\fmt\manager;

use NeoPHP\mvc\ConnectionModelManager;
use org\fmt\model\Category;

class CategoriesManager extends ConnectionModelManager
{
    public function getCategories ()
    {
        return $this->getAllModels(Category::class);
    }
    
    public function getCategory ($id)
    {
        return $this->getModel(Category::class, $id);
    }
    
    public function persistCategory (Category $category)
    {
        return $this->persistModel($category);
    }
    
    public function deleteCategory (Category $category)
    {
        return $this->deleteModel($category);
    }
}