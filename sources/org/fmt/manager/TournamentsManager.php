<?php

namespace org\fmt\manager;

use NeoPHP\mvc\manager\DefaultModelManager;
use NeoPHP\mvc\Model;

class TournamentsManager extends DefaultModelManager
{
    public function find(array $filters = [], array $sorters = [], array $options = [])
    {
        return parent::find($filters, $sorters, $options);
    }

    public function insert(Model $model, array $options = [])
    {
        return parent::insert($model, $options);
    }

    public function remove(Model $model, array $options = [])
    {
        return parent::remove($model, $options);
    }

    public function update(Model $model, array $options = [])
    {
        return parent::update($model, $options);
    }
}