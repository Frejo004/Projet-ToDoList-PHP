<?php
    namespace App\Controllers;

    class TodoController{
        public function index(){
            //Récupérer les tâches depuis la session
            if(!isset($_SESSION)){
                session_start();
            }

            $todos = $_SESSION["todos"] ?? [];//si $todos est NULL, on prend le tableau vide
            // echo "<pre>";
            // echo session_save_path();
            //  print_r($todos);
            // var_dump($todos);


            //Charger la vue "Views/index.php"
            require __DIR__ . "/../Views/index.php";
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $task = trim($_POST['task']);
                if($task) {
                    $_SESSION['todos'][] = [
                        'id' => uniqid('todo_'),
                        'task' => $task,
                        'done' => false,
                    ];
                }
                header('Location: /');
                exit;
            }
            //charger la vue add.php
            require dirname(__DIR__) . "/Views/add.php";
        }

        public function delete(){
            $id = $_GET['id'] ?? null;
            if($id){
                $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) use ($id){
                    return $todo['id'] !== $id;
                });
            }

            header('Location: /');
            exit;
        }

        public function toggle(){
            $id = $_GET['id'] ?? null;
            if($id){
                foreach($_SESSION['todos'] as &$todo){
                    if($todo['id'] === $id){
                        $todo['done'] = !$todo['done'];
                    }
                }
            }
            header('Location: /');
            exit;
        }

        public function update(){
            $id = $_GET['id'] ?? null;
            $task = $_GET['task'] ?? null;


            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $task = trim($_POST['task']);
                if($id){
                    foreach($_SESSION['todos'] as &$todo){
                        $todo['done'] = !$todo['done'];
                    }
                }
                var_dump($id);
                header('Location: /');
                exit ;
            }
            //charger la vue update.php
            require dirname(__DIR__) . "/Views/update.php";
        }
    }