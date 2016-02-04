<?php

namespace org\fmt\view;

use com\bootstrap\component\BSCarousel;
use NeoPHP\web\html\HTMLTag;

class PortalView extends DefaultView
{
    public function __construct()
    {
        parent::__construct();
        $this->getMainContent()->addElement($this->createMainJumbotron()); 
        $this->getMainContent()->addElement($this->createInformationContent()); 
        $this->getMainContent()->addElement($this->createFooter()); 
    }
    
    protected function createMainJumbotron()
    { 
        $carousel = new BSCarousel();
        $carousel->addSlide($this->getBaseUrl() . "res/images/background1.jpg", $this->getApplication()->getName(), "La Federación Mendocina de tenis creada el 29 de mayo de 1928, es una Asociación Civil sin fines de lucro, con domicilio legal en la Ciudad de Mendoza y con alcance jurisdiccional en toda la Provincia.");
        $carousel->addSlide($this->getBaseUrl() . "res/images/background3.jpg", $this->getApplication()->getName(), "La Federacións Mendocina de tenis creada el 29 de mayo de 1928, es una Asociación Civil sin fines de lucro, con domicilio legal en la Ciudad de Mendoza y con alcance jurisdiccional en toda la Provincia.");
        return $carousel; 
    }
        
    protected function createInformationContent()
    {
        return '
        <div class="container">
            <hr class="featurette-divider">

            <div class="row text-center">
                <div class="col-sm-4">
                    <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'res/images/featurette3.jpg" data-src="holder.js/260x175" alt="" style="width: 260px; height: 175px;">
                    <h2>Menores</h2>
                </div>
                <div class="col-sm-4">
                    <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'res/images/featurette7.jpg" data-src="holder.js/260x175" alt="" style="width: 260px; height: 175px;">
                    <h2>Categorías - Seniors</h2>
                </div>
                <div class="col-sm-4">
                    <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'res/images/featurette5.jpg" data-src="holder.js/260x175" alt="" style="width: 260px; height: 175px;">
                    <h2>Profesionales</h2>
                </div>
            </div>
            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-12">
                    <h2 class="featurette-heading">NUESTRA CASA</h2>
                    <p class="lead">La Federación tiene sede propia y es la oficina privilegiadamente ubicada en el centro de la capital de Mendoza, nuestra casa ,durante este ejercicio se refacciono recientemente contando con una superficie cubierta propia de 54 metros cuadrados distribuidos en una sala de atención y administración, un privado y una amplia sala de reunion .nuestra federación actualmente cuenta con equipos modernos de computación en red y banda ancha de internet. </p>
                </div>
            </div>

            <div class="row featurette">
                <div class="col-md-12">
                    <h2 class="featurette-heading">FINES Y OBJETIVOS</h2>
                    <p class="lead">La Federación tiene sede propia y es la oficina privilegiadamente ubicada en el centro de la capital de Mendoza, nuestra casa ,durante este ejercicio se refacciono recientemente contando con una superficie cubierta propia de 54 metros cuadrados distribuidos en una sala de atención y administración, un privado y una amplia sala de reunion .nuestra federación actualmente cuenta con equipos modernos de computación en red y banda ancha de internet.</p>
                    <p class="lead">La F.M.T es la Asociación Civil rectora de todo cuanto se relaciona con el deporte del Tenis en la provincia de Mendoza y las entidades afiliadas a la misma .proponiendonos durante el ejercicio. la promoción, fomento y desarrollo del deporte del tenis en toda la Provincia. Para cumplimentar tales fines y objetivos, que se establecen como fundamentales:</p>
                    <p class="lead">Organizamos, fiscalizamos , patrocinamos y dirigimos torneos, campeonatos o competencias de tenis en las que intervengan las entidades que la integran o sus jugadores, y aquellos eventos de carácter provincial ,nacional e internacional que se desarrollen en la Provincia.</p>
                    <p class="lead">Representamos en forma exclusiva a los clubes y jugadores afiliados en los organismos nacionales que dirigen el tenis, reconociendo las funciones y atribuciones correspondientes a la Asociación Argentina de Tenis, conforme a sus estatutos y reglamentos.</p>
                    <p class="lead">Designamos a los jugadores que representen a la Provincia, en las distintas competencias nacionales en las que participen representaciones Mendocinas.</p>
                    <p class="lead">Propendemos a la camaradería entre jugadores y demás participantes en el deporte del tenis.</p>
                </div>
            </div>
        </div>';
    }
    
    protected function createFooter()
    {
        return '
        <div id="footer">
            <hr>
            <div class="container">
                <p class="text-muted credit">Federación Mendocina de Tenis <br>Dirección: San Martin 1362 1º Piso Of. 2 - Mendoza - Argentina <br>Telefono/Fax: 2615552686/2616306174 <br>E-mail: femetenis@yahoo.com.ar </p>
            </div>
        </div>';
    }
}

?>