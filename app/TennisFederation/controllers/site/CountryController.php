<?php

namespace TennisFederation\controllers\site;

use Exception;
use TennisFederation\controllers\SiteController;
use TennisFederation\models\Country;
use TennisFederation\models\UserType;

class CountryController extends SiteController
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
        $this->showCountryListAction();
    }
    
    public function showCountryListAction ()
    {
        $this->renderCountriesView();
    }
    
    public function showCountryFormAction($countryid=null)
    {
        $countryView = $this->createView("site/countryForm");
        if ($countryid != null)
            $countryView->setCountry($this->getCountry($countryid));
        $countryView->render();
    }
    
    public function createCountryAction($description)
    {
        $country = new Country();
        $country->setDescription($description);
        $this->saveCountry($country);
        $this->renderCountriesView();
    }
    
    public function updateCountryAction($countryid, $description)
    {
        $country = new Country();
        $country->setId($countryid);
        $country->setDescription($description);
        $this->saveCountry($country);
        $this->renderCountriesView();
    }
    
    public function deleteCountryAction($countryid)
    {
        $this->deleteCountry($countryid);
        $this->renderCountriesView();
    }
    
    private function renderCountriesView ()
    {
        $countries = $this->getCountries();        
        $countryView = $this->createView("site/countries");
        $countryView->setCountries ($countries);
        $countryView->render();
    }
    
    public function getCountries ()
    {
        $countries = array();
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCountry = $database->getDataObject ("country");
        $doCountry->addOrderByField ("countryid");
        $doCountry->find();
        while ($doCountry->fetch())
        {
            $country = new Country();
            $country->completeFromFieldsArray($doCountry->getFields());
            $countries[] = $country;
        }
        return $countries;
    }
    
    public function getCountry ($countryid)
    {
        $country = null;
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCountry = $database->getDataObject ("country");
        $doCountry->addWhereCondition("countryid = " . $countryid);
        if ($doCountry->find(true))
        {
            $country = new Country();
            $country->completeFromFieldsArray($doCountry->getFields());
        }
        return $country;
    }
    
    public function saveCountry (Country $country)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCountry = $database->getDataObject ("country");
        $doCountry->description = $country->getDescription();
        if ($country->getId() != null)
        {
            $doCountry->addWhereCondition("countryid = " . $country->getId());
            $doCountry->update();
        }
        else
        {
            $doCountry->insert();
        }
    }
    
    public function deleteCountry ($countryid)
    {
        $database = $this->getApplication()->getDefaultDatabase ();
        $doCountry = $database->getDataObject ("country");
        $doCountry->addWhereCondition("countryid = " . $countryid);
        $doCountry->delete();
    }
}

?>