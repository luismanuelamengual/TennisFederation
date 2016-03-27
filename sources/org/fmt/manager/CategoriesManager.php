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
}