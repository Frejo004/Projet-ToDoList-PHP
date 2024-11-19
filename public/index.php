<?php

use App\Controllers\TodoController;
use App\Router;

    require __DIR__ . "/../vendor/autoload.php";

    //Démarrer la session
    if(!isset($_SESSION)){
        session_start();
    }

    //Créer l'instance de route
    $router = new Router();

    //Crérer une instance de contrôllers
    $todoController = new TodoController();

    //Définir les router de l'application
    $router -> get ("/", [$todoController, 'index' ]);
    $router -> get ("/add", [$todoController, 'add' ]);
    $router -> post ("/add", [$todoController, 'add' ]);
    $router -> get ("/toggle", [$todoController, 'toggle' ]);
    $router -> get ("/delete", [$todoController, 'delete' ]);


    //Résoudre ma route correspondant
    $router -> resolve();