<?php

namespace TennisFederation\controller;

use TennisFederation\controller\SiteController;
use TennisFederation\model\Country;
use TennisFederation\view\CountriesView;
use TennisFederation\view\CountryFormView;

/**
 * @Route (path  = "/countries")
 * @Route  (path="/country" )
 */
class CountryController extends SiteController
{
    /**
     * @RouteAction (name = "showCountries")
     */
    public function showCountryListAction ()
    {
        $countryView = new CountriesView();
        $countryView->setCountries (Country::findAll());
        $countryView->render();
    }
    
    /**
     * @RouteAction (name = "showCountry")
     */
    public function showCountryFormAction($countryid=null)
    {
        $countryView = new CountryFormView();
        if ($countryid != null)
            $countryView->setCountry(Country::findById($countryid));
        $countryView->render();
    }
    
    /**
     * @RouteAction (name = "createCountry")
     */
    public function createCountryAction($description)
    {
        $country = new Country();
        $country->setDescription($description);
        $country->persist();
        $this->showCountryListAction ();
    }
    
    /**
     * @RouteAction (name = "updateCountry")
     */
    public function updateCountryAction($countryid, $description)
    {
        $country = new Country();
        $country->setId($countryid);
        $country->setDescription($description);
        $country->persist();
        $this->showCountryListAction ();
    }
    
    /**
     * @RouteAction (name = "deleteCountry")
     */
    public function deleteCountryAction($countryid)
    {
        $country = new Country();
        $country->setId($countryid);
        $country->delete();
        $this->showCountryListAction ();
    }
}

?>