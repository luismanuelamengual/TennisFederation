<?php

namespace TennisFederation\views\site;

class PortalView extends DefaultView
{
    private $message;
    
    protected function build ()
    {
        parent::build();
        $this->setTitle($this->getApplication()->getName());
        $this->addStyleFile($this->getBaseUrl() . "css/style.css");
        $this->getBodyTag()->setAttribute("data-spy", "scroll");
        $this->getBodyTag()->setAttribute("data-target", "#mainNavbar");
        $this->buildHead();
        $this->buildBody();
    }
    
    protected function buildHead ()
    {
    }
    
    protected function buildBody ()
    {
        $this->bodyTag->add($this->createHeader());
        $this->bodyTag->add($this->createContent());
        $this->bodyTag->add($this->createFooter());
    }
    
    protected function createHeader ()
    {   
        return '
        <div id="mainNavbar" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">' . $this->getApplication()->getName() . '</a>
                </div>
                <div class="navbar-collapse collapse">
                    ' . $this->createHeaderContent() . '
                </div>
            </div>
        </div>';
    }
    
    protected function createContent ()
    {
        return  
        $this->createCarousel() .
        '<div class="container">
            ' . $this->createSectionsRow() . '
            <hr class="featurette-divider">
            ' . $this->createOurHomeRow() . '
            ' . $this->createObjectivesRow () . '
        </div>';
    }
    
    protected function createFooter ()
    {
        return '<div id="footer">' . $this->createFooterContent() . '</div>';
    }
    
    public function setMessage ($message)
    {
        $this->message = $message;
    }
    
    protected function createFooterContent ()
    {
        return '
        <hr>
        <div class="container">        
        <p class="pull-right"><a href="#">Volver al inicio</a></p>
        <p class="text-muted credit">' . $this->getApplication()->getName() . ' <br>Dirección: San Martin 1362 1º Piso Of. 2 - Mendoza - Argentina <br>Telefono/Fax: 2615552686/2616306174 <br>E-mail: femetenis@yahoo.com.ar </p>
        </div>';
    }
    
    protected function createHeaderContent ()
    {   
        return $this->createLoginForm();
    }
    
    protected function createLoginForm ()
    {
        return '
        <form class="navbar-form navbar-right" action="' . $this->getUrl("site/login") . '" method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Usuario" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>';
    }
    
    protected function createCarousel ()
    {
        return '
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="item active">
                <img src="' . $this->getBaseUrl() . 'images/fondo1.jpg" alt="">
                <div class="carousel-caption">
                  <h1 style="color:#ffffff">' . $this->getApplication()->getName() . '</h1>
                  <p>La Federación Mendocina de tenis creada el 29 de mayo de 1928, es una Asociación Civil sin fines de lucro, con domicilio legal en la Ciudad de Mendoza y con alcance jurisdiccional en toda la Provincia.</p>
                </div>
              </div>
              <div class="item">
                <img src="' . $this->getBaseUrl() . 'images/fondo3.jpg" alt="">
                <div class="carousel-caption">
                  <h1 style="color:#ffffff">' . $this->getApplication()->getName() . '</h1>
                  <p>La F.M.T organiza por año más de 100 torneos para menores, seniors y profesionales en sus distintas categorías</p>
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>';
    }
    
    protected function createSectionsRow ()
    {
        $imageWidth = 260;
        $imageHeight = 175;
        return '
        <div class="row text-center">
            <div class="col-sm-4">
                <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'images/featurette3.jpg" data-src="holder.js/' . $imageWidth . 'x' . $imageHeight . '" alt="" style="width: ' . $imageWidth . 'px; height: ' . $imageHeight . 'px;">
                <h2>Menores</h2>
            </div>
            <div class="col-sm-4">
                <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'images/featurette7.jpg" data-src="holder.js/' . $imageWidth . 'x' . $imageHeight . '" alt="" style="width: ' . $imageWidth . 'px; height: ' . $imageHeight . 'px;">
                <h2>Categorías - Seniors</h2>
            </div>
            <div class="col-sm-4">
                <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'images/featurette5.jpg" data-src="holder.js/' . $imageWidth . 'x' . $imageHeight . '" alt="" style="width: ' . $imageWidth . 'px; height: ' . $imageHeight . 'px;">
                <h2>Profesionales</h2>
            </div>
        </div>';
    }
    
    protected function createOurHomeRow ()
    {
        return '
        <div class="row featurette">
            <div class="col-md-12">
                <h2 class="featurette-heading">NUESTRA CASA</h2>
                <p class="lead">La Federación tiene sede propia y es la oficina privilegiadamente ubicada en el centro de la capital de Mendoza, nuestra casa ,durante este ejercicio se refacciono recientemente contando con una superficie cubierta propia de 54 metros cuadrados distribuidos en una sala de atención y administración, un privado y una amplia sala de reunion .nuestra federación actualmente cuenta con equipos modernos de computación en red y banda ancha de internet. </p>
            </div>
        </div>';
    }
    
    protected function createObjectivesRow ()
    {
        return '
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
        </div>';
    }
}

?>