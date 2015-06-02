<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->getApplication()->getName(); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->getBaseUrl(); ?>assets/bootstrap-3.1.1/css/bootstrap.united.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->getBaseUrl(); ?>css/style.css" />
    </head>
    <body data-spy="scroll" data-target="#mainNavbar">

        <div id="messageBox" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?php echo $this->getApplication()->getName(); ?></h4>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
        
        <div id="mainNavbar" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand"><?php echo $this->getApplication()->getName(); ?></a>
                </div>
                <div class="navbar-collapse collapse">
                    <form class="navbar-form navbar-right" action="http://localhost/TennisFederation/site/login" method="post">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Usuario" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Contraseña" class="form-control">
                        </div>
                        <button type="button" class="btn btn-btn btn-primary" onclick="login(); return false;">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo $this->getBaseUrl(); ?>images/fondo1.jpg" alt="">
                    <div class="carousel-caption">
                        <h1 style="color:#ffffff">Federación Mendocina de Tenis</h1>
                        <p>La Federación Mendocina de tenis creada el 29 de mayo de 1928, es una Asociación Civil sin fines de lucro, con domicilio legal en la Ciudad de Mendoza y con alcance jurisdiccional en toda la Provincia.</p>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo $this->getBaseUrl(); ?>images/fondo3.jpg" alt="">
                    <div class="carousel-caption">
                        <h1 style="color:#ffffff">Federación Mendocina de Tenis</h1>
                        <p>La F.M.T organiza por año más de 100 torneos para menores, seniors y profesionales en sus distintas categorías</p>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
        
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-4">
                    <img class="img-thumbnail" src="http://localhost/TennisFederation/images/featurette3.jpg" data-src="holder.js/260x175" alt="" style="width: 260px; height: 175px;">
                    <h2>Menores</h2>
                </div>
                <div class="col-sm-4">
                    <img class="img-thumbnail" src="http://localhost/TennisFederation/images/featurette7.jpg" data-src="holder.js/260x175" alt="" style="width: 260px; height: 175px;">
                    <h2>Categorías - Seniors</h2>
                </div>
                <div class="col-sm-4">
                    <img class="img-thumbnail" src="http://localhost/TennisFederation/images/featurette5.jpg" data-src="holder.js/260x175" alt="" style="width: 260px; height: 175px;">
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
        </div>
        
        <div id="footer">
            <hr>
            <div class="container">        
                <p class="pull-right"><a href="#">Volver al inicio</a></p>
                <p class="text-muted credit">Federación Mendocina de Tenis <br>Dirección: San Martin 1362 1º Piso Of. 2 - Mendoza - Argentina <br>Telefono/Fax: 2615552686/2616306174 <br>E-mail: femetenis@yahoo.com.ar </p>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="http://localhost/TennisFederation/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://localhost/TennisFederation/assets/bootstrap-3.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">

            function showMessage (message)
            {
                $("#messageBox .modal-body").html(message);
                $("#messageBox").modal("show");
            }

            function login ()
            {
                var username = $('input[name=username]')[0].value;
                var password = $('input[name=password]')[0].value;
                $.ajax("http://localhost/TennisFederation/session/?username=" + username + "&password=" + password + "&returnFormat=json",
                {
                    method: "PUT",
                    success: function (jsonData)
                    {
                        var data = jQuery.parseJSON(jsonData);
                        if (data.success)
                        {
                            window.open("http://localhost/TennisFederation/dashboard/", "_self");
                        }
                        else
                        {
                            showMessage(data.message);
                        }
                    },
                    error: function (qXHR, textStatus, errorThrown)
                    {
                        showMessage(errorThrown);
                    },
                    timeout: function ()
                    {
                        showMessage("Se ha agotado el tiempo de conexión. Intente más tarde");
                    }
                });
            }
        
    </script>
</html>