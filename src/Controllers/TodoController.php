<?php
    namespace App\Controllers;

    class TodoController{
        public function index(){
            //Récupérer les tâches depuis la session
            if(isset($_SESSION)){
                session_start();
            }

            $todos = $_SESSION["todos"];
            //Charger la vue "Views/index.php"
            require __DIR__ . "../Views/index.php";
        }

        public function add(){

        }

        public function delete(){

        }

        public function toggle(){

        }
    }