<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $this->getApplication()->getName() }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ $this->getResourceUrl('css/site.css') }}" />
        @yield("styleFiles")
        @yield("styles")
    </head>
    <body>
        <nav id="mainheader" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand">{{ $this->getApplication()->getName() }}</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainnavbar_collasiblecontent" aria-expanded="false"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                </div>
                <div id="mainnavbar_collasiblecontent" class="collapse navbar-collapse">
                    @yield("mainbarContents")
                </div>
            </div>
        </nav>
        <div id="maincontainer">
            <div id="maincontent">
                @yield("contents")
            </div>
        </div>
    </body>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    @yield("scriptFiles")
    @yield("scripts")
</html>