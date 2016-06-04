<?php

require_once ("../../NeoPHP/autoload.php");
$app = new NeoPHP\web\WebApplication(realpath(".."));
$app->addRoute("/", "org\\fmt\\controller\\PublicSiteController");
$app->addRoute("/dashboard/", "org\\fmt\\controller\\DashboardController");
$app->addRoute("/session/", "org\\fmt\\controller\\SessionController");
$app->addRoute("/category/", "org\\fmt\\controller\\CategoriesController");
$app->addRoute("/club/", "org\\fmt\\controller\\ClubsController");
$app->addRoute("/user/", "org\\fmt\\controller\\UsersController");
$app->handleRequest();