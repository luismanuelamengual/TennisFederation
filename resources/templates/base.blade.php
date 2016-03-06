<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $this->getApplication()->getName() }}</title>
        <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/tether-1.2.0/css/tether.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('assets/bootstrap-4.0/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('css/site.css') }}" />
        @yield("styleFiles")
        @yield("styles")
    </head>
    <body>
        <nav id="mainheader" class="navbar navbar-fixed-top navbar-dark bg-inverse">
            <div class="container">
                <a class="navbar-brand" href="#">{{ $this->getApplication()->getName() }}</a>
                @yield("mainbarContents")
            </div>
        </nav>
        <div id="maincontent">
            @yield("contents")
        </div>
    </body>
    <script type="text/javascript" src="{{ $this->getResourceUrl('assets/jquery-2.2.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ $this->getResourceUrl('assets/tether-1.2.0/js/tether.min.js') }}" ></script>
    <script type="text/javascript" src="{{ $this->getResourceUrl('assets/bootstrap-4.0/js/bootstrap.min.js') }}" ></script>
    @yield("scriptFiles")
    @yield("scripts")
</html>