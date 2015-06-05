<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->getApplication()->getName(); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->getBaseUrl(); ?>res/assets/bootstrap-3.3.4/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->getBaseUrl(); ?>res/css/site.css" />
        <%styles%>
    </head>
    <body>
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
                    <%header%>
                </div>
            </div>
        </div>

        <div id="mainContent">
            <div id="mainBody">
                <%contents%>
            </div>
        </div>
        <%body%>
    </body>
    <script type="text/javascript" src="<?php echo $this->getBaseUrl(); ?>res/assets/jquery-1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->getBaseUrl(); ?>res/assets/bootstrap-3.3.4/js/bootstrap.min.js"></script>
    <%scripts%>
</html>