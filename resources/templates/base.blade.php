<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Federación mendocina de tenis</title>

        <!-- Vendor CSS -->
        @yield("vendorStyleFiles")
        
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('css/app.min.1.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('css/app.min.2.css') }}" />
        @yield("styleFiles")
        
        <!-- Custom CSS -->
        @yield("styles")
    </head>
    
    <body class="@yield('contentType')">
        @yield("contents")
    </body>
    
    <!-- Vendor Scripts -->
    @yield("vendorScriptFiles")
    
    <!-- Scripts -->
    <script src="{{ $this->getResourceUrl('js/functions.js') }}"></script>
    @yield("scriptFiles")
    
    <!-- Custom Scripts -->
    @yield("scripts")
</html>