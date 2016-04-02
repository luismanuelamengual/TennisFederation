<?php

namespace org\fmt\manager;

use NeoPHP\mvc\ModelManager;
use org\fmt\model\Category;

class CategoriesManager extends ModelManager
{
    public function getCategories ()
    {
        return $this->createModelCollection(Category::class, $this->getConnection()->createQuery("category")->get());
    }
    
    public function getCategory ($id)
    {
        return $this->createModel(Category::class, $this->getConnection()->createQuery("category")->addWhere("id", "=", $id)->getFirst());
    }
    
    public function persistCategory (Category $category)
    {
        $query = $this->getConnection()->createQuery("category");
        if (!empty($category->getId()))
        {
            $query->addWhere("id", "=", $category->getId());
            $query->update(["description"=>$category->getDescription(), "matchtype"=>$category->getMatchType()]);
        }
        else
        {
            $query->insert(["description"=>$category->getDescription(), "matchtype"=>$category->getMatchType()]);
        }
    }
    
    public function deleteCategory ($id)
    {
        $this->getConnection()->createQuery("category")->addWhere("id", "=", $id)->delete();
    }
}