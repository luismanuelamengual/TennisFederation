<?php

namespace TennisFederation\controllers\site;

use Exception;
use TennisFederation\controllers\SiteController;
use TennisFederation\models\UserType;
use TennisFederation\models\Province;

class ProvinceController extends SiteController
{
    public function onBeforeActionExecution ($action)
    {
        $executeAction = parent::onBeforeActionExecution($action);
        if ($executeAction && $this->getSession()->type != UserType::USERTYPE_ADMINISTRATOR)
            throw new Exception ("No tiene permisos para acceder a este controlador");
        return $executeAction;
    }
    
    public function indexAction()
    {
        $this->showProvinceListAction();
    }
    
    public function showProvinceListAction ()
    {
        $this->renderProvincesView();
    }
    
    public function showProvinceFormAction($provinceid=null)
    {
        $provinceView = $this->createView("site/provinceForm");
        if ($provinceid != null)
            $provinceView->setProvince($this->getProvince($provinceid));
        $provinceView->render();
    }
    
    public function createProvinceAction($description)
    {
        $province = new Province();
        $province->setDescription($description);
        $this->saveProvince($province);
        $this->renderProvincesView();
    }
    
    public function updateProvinceAction($provinceid, $description)
    {
        $province = new Province();
        $province->setId($provinceid);
        $province->setDescription($description);
        $this->saveProvince($province);
        $this->renderProvincesView();
    }
    
    public function deleteProvinceAction($provinceid)
    {
        $this->deleteProvince($provinceid);
        $this->renderProvincesView();
    }
    
    private function renderProvincesView ()
    {
        $provinces = $this->getProvinces();        
        $provinceView = $this->createView("site/provinces");
        $provinceView->setProvinces ($provinces);
        $provinceView->render();
    }
    
    public function getProvinces ()
    {
        $provinces = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doProvince = $database->getDataObject ("province");
        $doProvince->addOrderByField ("provinceid");
        $doProvince->find();
        while ($doProvince->fetch())
        {
            $province = new Province();
            $province->completeFromFieldsArray($doProvince->getFields());
            $provinces[] = $province;
        }
        return $provinces;
    }
    
    public function getProvince ($provinceid)
    {
        $province = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doProvince = $database->getDataObject ("province");
        $doProvince->addWhereCondition("provinceid = " . $provinceid);
        if ($doProvince->find(true))
        {
            $province = new Province();
            $province->completeFromFieldsArray($doProvince->getFields());
        }
        return $province;
    }
    
    public function saveProvince (Province $province)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doProvince = $database->getDataObject ("province");
        $doProvince->description = $province->getDescription();
        if ($province->getCountry() != null)
            $doProvince->countryid = $province->getCountry()->getId();
        if ($province->getId() != null)
        {
            $doProvince->addWhereCondition("provinceid = " . $province->getId());
            $doProvince->update();
        }
        else 
        {
            $doProvince->insert();
        }
    }
    
    public function deleteProvince ($provinceid)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doProvince = $database->getDataObject ("province");
        $doProvince->addWhereCondition("provinceid = " . $provinceid);
        $doProvince->delete();
    }
}

?>