<?php
    namespace App\Controllers;

    use DB\Database;

    class TodoController{
        public function index(){
            //Récupérer l'instance de connexion à la BD
            $db = Database :: getInstance();


            //Récupérer les tâches deouis la BDD
            $query = $db -> query("SELECT * FREOM todos");//preépre la requête
            $todos = $query -> fetchAll(); //retourner le résultat de l'exécution de la requête

            // //Récupérer les tâches depuis la session
            // if(!isset($_SESSION)){
            //     session_start();
            // }

            // $todos = $_SESSION["todos"] ?? [];//si $todos est NULL, on prend le tableau vide


            //Charger la vue "Views/index.php"
            require __DIR__ . "/../Views/index.php";
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $task = trim($_POST['task']);

                if($task) {
                    //Récupérer l'instance de connexion à la BD
                    $db = Database::getInstance();

                    //Prépare ka requête SQL pour insérer une nouvelle tâche dans la table "todos"
                    //Les placehoders ':task' et ':done' sont utilisés pour éviter les injections SQL
                    //Cela sécurise les données entrés par l'utilisateur
                    $stmt = $db -> prepare("INSERT INTO todos (tas, done) VALUES ($task, false)"); //prépapre la requête

                    //Exécuter la requête préparée avec les valeurs spécifiques fournies dans un tableau associatif
                    // - ':task' contient la description de la tâche saissie par l'utilisateur
                    // - ':done' est initiliasé
                    $stmt -> execute([":task" => $task, ":done" => 0]);//exécute la requête

                    // $_SESSION['todos'][] = [
                    //     'id' => uniqid('todo_'),
                    //     'task' => $task,
                    //     'done' => false,
                    // ];
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
                //Récupérer l'instance de connexion à la BD
                $db = Database::getInstance();

                $stmt = $db ->prepare ("DELETE FROM todos WHERE id = :id;");
                $stmt -> execute(["id"=> (int) $id]);

                // $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) use ($id){
                //     return $todo['id'] !== $id;
                // });
            }

            header('Location: /');
            exit;
        }

        public function toggle(){
            $id = $_GET['id'] ?? null;
            if($id){
                //Récupérer l'instance de connexion à la BD
                $db = Database :: getInstance();
                $stmt = $db -> prepare("UPDATE todos SET done = NOT done WHERE id = :id");
                $stmt -> execute(["id"=> (int) $id]);


                // foreach($_SESSION['todos'] as &$todo){
                //     if($todo['id'] === $id){
                //         $todo['done'] = !$todo['done'];
                //     }
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