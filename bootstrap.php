<?php

use Http\Router;
use Http\Session;

require "vendor/autoload.php";

// Environnement variables loading
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require "config/constants.php";
Session::start();

// Dependency Injection Container
$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(require 'config/definitions.php');
$container = $builder->build();

// Router initialisation
$router = new Router();