<?php

namespace org\fmt\manager;

use NeoPHP\mvc\ModelManager;
use org\fmt\model\Category;

class CategoriesManager extends ModelManager
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