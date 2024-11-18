<?php

use App\Router;

    require __DIR__ . "/../vendor/autoload.php";

    //Démarrer la session
    if(isset($_SESSION)){
        session_start();
    }

    //Créer l'instance de route
    $router = new Router();

    $router -> get ("/", function(){});
    $router -> get ("/add", function(){});
    $router -> post ("/add", function(){});
    $router -> get ("/toggle", function(){});
    $router -> get ("/delete", function(){});

    echo"<pre>";
    var_dump($router);