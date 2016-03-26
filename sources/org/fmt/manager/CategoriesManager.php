<?php

namespace org\fmt\manager;

use NeoPHP\core\Collection;
use NeoPHP\mvc\ModelManager;
use org\fmt\model\Category;

class CategoriesManager extends ModelManager
{
    public function findCategories ()
    {
        $categories = new Collection();
        $query = $this->getConnection()->createQuery("category");
        $results = $query->get();
        foreach ($results as $result)
        {
            $category = new Category();
            $category->setFrom($result);
            $categories->add($category);
        }
        return $categories;
    }
}