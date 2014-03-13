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
            ' . $this->createFeaturettesSection() . '
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
        <p class="text-muted credit">© Copyright 2014. ' . $this->getApplication()->getName() . ' - Todos los derechos reservados</p>
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
                <img src="' . $this->getBaseUrl() . 'images/fondo2.jpg" alt="">
                <div class="carousel-caption">
                  <h1 style="color:#ffffff">' . $this->getApplication()->getName() . '</h1>
                  <p>La Federación de Tenis Mendocina organiza más de 100 torneos al año entre los cuales participan menores, seniors y profesionales en diversas categorías</p>
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>';
    }
    
    protected function createFeaturettesSection ()
    {
        $imageWidth = 260;
        $imageHeight = 175;
        return '
        <div class="row text-center">
            <div class="col-lg-4">
                <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'images/featurettes/featurette1.jpg" data-src="holder.js/' . $imageWidth . 'x' . $imageHeight . '" alt="" style="width: ' . $imageWidth . 'px; height: ' . $imageHeight . 'px;">
                <h2>Menores</h2>
                <p>Aliquam tempor adipiscing lorem quis sodales. Vestibulum aliquet massa at elit egestas, vitae pulvinar ipsum porta. Nunc faucibus urna ut ante commodo aliquam. Donec in eros ut enim placerat gravida eu sit amet est. Donec a egestas urna, id interdum massa. Vestibulum pharetra, mi laoreet sagittis condimentum, leo nisl volutpat libero, cursus volutpat lorem tortor eget justo. Cras ac felis nec felis volutpat rutrum eu vel ligula. Pellentesque justo nisl, posuere non placerat eu, vestibulum mollis risus. Maecenas porttitor nisl varius quam fringilla, quis gravida leo convallis. Morbi quis nisi vitae magna interdum feugiat.</p>
            </div>
            <div class="col-lg-4">
                <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'images/featurettes/featurette2.jpg" data-src="holder.js/' . $imageWidth . 'x' . $imageHeight . '" alt="" style="width: ' . $imageWidth . 'px; height: ' . $imageHeight . 'px;">
                <h2>Categorías - Seniors</h2>
                <p>Duis ut nisl vitae quam elementum tempor a non sem. Integer consectetur arcu ut tellus blandit euismod. Sed aliquet aliquet nisi, in faucibus quam laoreet eleifend. Nam ac libero erat. Aliquam ullamcorper velit orci, et laoreet eros vestibulum non. Nullam rutrum sapien at pharetra malesuada. Sed feugiat sapien ut neque auctor, id consequat tortor aliquet. Proin ac erat rhoncus, dictum sapien vel, rhoncus libero.</p>
            </div>
            <div class="col-lg-4">
                <img class="img-thumbnail" src="' . $this->getBaseUrl() . 'images/featurettes/featurette3.jpg" data-src="holder.js/' . $imageWidth . 'x' . $imageHeight . '" alt="" style="width: ' . $imageWidth . 'px; height: ' . $imageHeight . 'px;">
                <h2>Profesionales</h2>
                <p>Vivamus pulvinar libero at justo luctus euismod. Proin quis imperdiet sem. Curabitur orci purus, viverra eget lectus ut, pharetra condimentum nibh. Nullam cursus ligula varius, tincidunt dolor id, bibendum arcu. In a iaculis velit, et commodo nunc. Suspendisse dolor orci, pretium at porttitor vitae, sollicitudin et turpis. Etiam sollicitudin massa at malesuada euismod. Vivamus pharetra nulla ac mi sodales condimentum.</p>
            </div>
        </div>';
    }
}

?>