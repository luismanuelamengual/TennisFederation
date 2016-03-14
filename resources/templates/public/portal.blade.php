@extends ("public.base")

@section("scriptFiles")
    <script type="text/javascript" src="{{ $this->getResourceUrl("assets/jquery.backstretch.min.js") }}"></script>
@stop

@section("scripts")
    @parent
    <script type="text/javascript">
        $("#mainjumbotron").backstretch(
        [
            "{{ $this->getResourceUrl('images/background1.jpg') }}", 
            "{{ $this->getResourceUrl('images/background2.jpg') }}",
            "{{ $this->getResourceUrl('images/background3.jpg') }}",
            "{{ $this->getResourceUrl('images/background4.jpg') }}"
        ], {duration: 4000, fade: 1000, centeredX:true, centeredY:true});
    </script>
@stop

@section("contents")

    <div class="container">
        <div id="mainjumbotron" class="jumbotron">
            <h1 class="display-3">Federación mendocina de Tenis</h1>
            <p class="lead">La federeción de mendocina de tenis organiza mas de 100 torneos al año tanto para menores, seniors, categorías y profesionales</p>
            <p>Cientos de jugadores de toda mendoza estan compitiendo hoy, No te quedes afuera ... Inscribite ahora</p>
        </div>
    </div>

    <div class="container">         
        <h3>NUESTRA CASA</h3>
        <div class="col-sm-4">
            <img src="{{ $this->getResourceUrl('images/featurette1.jpg') }}" class="img-rounded img-responsive">
        </div>
        <div class="col-sm-8"> 
            <p class="lead">La Federación tiene sede propia y es la oficina privilegiadamente ubicada en el centro de la capital de Mendoza, nuestra casa ,durante este ejercicio se refacciono recientemente contando con una superficie cubierta propia de 54 metros cuadrados distribuidos en una sala de atención y administración, un privado y una amplia sala de reunion .nuestra federación actualmente cuenta con equipos modernos de computación en red y banda ancha de internet. </p>
        </div>
    </div>
    <div class="container">
        <h3>FINES Y OBJETIVOS</h3>
        <div class="col-sm-8"> 
            <p class="lead">La Federación tiene sede propia y es la oficina privilegiadamente ubicada en el centro de la capital de Mendoza, nuestra casa ,durante este ejercicio se refacciono recientemente contando con una superficie cubierta propia de 54 metros cuadrados distribuidos en una sala de atención y administración, un privado y una amplia sala de reunion .nuestra federación actualmente cuenta con equipos modernos de computación en red y banda ancha de internet.</p>
            <p class="lead">La F.M.T es la Asociación Civil rectora de todo cuanto se relaciona con el deporte del Tenis en la provincia de Mendoza y las entidades afiliadas a la misma .proponiendonos durante el ejercicio. la promoción, fomento y desarrollo del deporte del tenis en toda la Provincia. Para cumplimentar tales fines y objetivos, que se establecen como fundamentales:</p>
            <p class="lead">Organizamos, fiscalizamos , patrocinamos y dirigimos torneos, campeonatos o competencias de tenis en las que intervengan las entidades que la integran o sus jugadores, y aquellos eventos de carácter provincial ,nacional e internacional que se desarrollen en la Provincia.</p>
            <p class="lead">Representamos en forma exclusiva a los clubes y jugadores afiliados en los organismos nacionales que dirigen el tenis, reconociendo las funciones y atribuciones correspondientes a la Asociación Argentina de Tenis, conforme a sus estatutos y reglamentos.</p>
            <p class="lead">Designamos a los jugadores que representen a la Provincia, en las distintas competencias nacionales en las que participen representaciones Mendocinas.</p>
            <p class="lead">Propendemos a la camaradería entre jugadores y demás participantes en el deporte del tenis.</p>
        </div>
        <div class="col-sm-4"> 
            <img src="{{ $this->getResourceUrl('images/featurette2.jpg') }}" class="img-rounded img-responsive">
            <img src="{{ $this->getResourceUrl('images/featurette3.jpg') }}" class="img-rounded img-responsive" style="margin-top:10px">
        </div>
    </div>

    <div id="footer">
        <hr>
        <div class="container">
            <p class="text-muted credit">Federación Mendocina de Tenis <br>Dirección: San Martin 1362 1º Piso Of. 2 - Mendoza - Argentina <br>Telefono/Fax: 2615552686/2616306174 <br>E-mail: femetenis@yahoo.com.ar </p>
        </div>
    </div>
@stop