<?php

namespace TennisFederation\controller;

use TennisFederation\controller\SiteController;
use TennisFederation\model\Country;
use TennisFederation\view\CountriesView;
use TennisFederation\view\CountryFormView;

class CountryController extends SiteController
{
    public function showCountryListAction ()
    {
        $countryView = new CountriesView();
        $countryView->setCountries (Country::findAll());
        $countryView->render();
    }
    
    public function showCountryFormAction($countryid=null)
    {
        $countryView = new CountryFormView();
        if ($countryid != null)
            $countryView->setCountry(Country::findById($countryid));
        $countryView->render();
    }
    
    public function createCountryAction($description)
    {
        $country = new Country();
        $country->setDescription($description);
        $country->persist();
        $this->showCountryListAction ();
    }
    
    public function updateCountryAction($countryid, $description)
    {
        $country = new Country();
        $country->setId($countryid);
        $country->setDescription($description);
        $country->persist();
        $this->showCountryListAction ();
    }
    
    public function deleteCountryAction($countryid)
    {
        $country = new Country();
        $country->setId($countryid);
        $country->delete();
        $this->showCountryListAction ();
    }
}

?>