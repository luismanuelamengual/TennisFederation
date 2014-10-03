<?php

namespace TennisFederation\controller;

use TennisFederation\controller\SiteController;
use TennisFederation\model\Province;
use TennisFederation\view\ProvinceFormView;
use TennisFederation\view\ProvincesView;

class ProvinceController extends SiteController
{      
    public function showProvinceListAction ()
    {
        $view = new ProvincesView();
        $view->setProvinces (Province::findAll());
        $view->render();
    }
    
    public function showProvinceFormAction($provinceid=null)
    {
        $view = new ProvinceFormView();
        if ($provinceid != null)
            $view->setProvince(Province::findById($provinceid));
        $view->render();
    }
    
    public function createProvinceAction($description)
    {
        $province = new Province();
        $province->setDescription($description);
        $province->persist();
        $this->showProvinceListAction();
    }
    
    public function updateProvinceAction($provinceid, $description)
    {
        $province = new Province();
        $province->setId($provinceid);
        $province->setDescription($description);
        $province->persist();
        $this->showProvinceListAction();
    }
    
    public function deleteProvinceAction($provinceid)
    {
        $province = new Province();
        $province->setId($provinceid);
        $province->delete();
        $this->showProvinceListAction();
    }
}

?>