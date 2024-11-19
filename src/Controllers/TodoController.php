<?php
    namespace App\Controllers;

    class TodoController{
        public function index(){
            //Récupérer les tâches depuis la session
            if(!isset($_SESSION)){
                session_start();
            }

            $todos = $_SESSION["todos"] ?? [];//si $todos est NULL, on prend le tableau vide

            //Charger la vue "Views/index.php"
            require __DIR__ . "/../Views/index.php";
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $task = trim($_POST['task']);

                if($task){
                    $_SESSION['todos'][] = [
                        'id' => uniqid("todo_"),
                        'task' => $task,
                        'done' => false
                    ];
                }
                header('location : /');
                exit;
            }
            //charger la vue add.php
            require dirname(__DIR__) . "/Views/add.php";
        }

        public function delete(){

        }

        public function toggle(){

        }
    }