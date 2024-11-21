<?php
    namespace App\Controllers;

    use DB\Database;

    class TodoController{
        public function index(){
            //Récupérer l'instance de connexion à la BD
            $db = Database :: getInstance();


            //Récupérer les tâches deouis la BDD
            $query = $db -> query("SELECT * FROM todos");//preépre la requête
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
                //Récupérer l'instance de connexion à la BDD
                $db = Database::getInstance();
                //Prépare la requête SQL pour insérer un nouvelle tâche dans la table "todos".
                //Les placeholders `:task` et `done` sont utilisés pour éviter les iinjections SQL.
                //Cela sécurise les données entrés par l'utilisateur
                $stmt = $db->prepare("INSERT INTO todos(task,done) VALUES(:task, :done); ");//prépare la requête
                //Exécute la requête préparée avec les valeurs spécifiques fournies dans un tableau associatif
                // - `:task` contient la description de la tâche saisie par l'user
                // - `:done` est initialisé à 0 (indiquand que la tâche n'est pas encore)
                $stmt->execute([":task" => $task, ":done" => 0]);
                //exécution de la requête

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
            $task = $_POST['task'] ?? null;
            
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($id){

                    $db = Database::getInstance();
    
                    $stmt = $db -> prepare("UPDATE todos SET task = :task WHERE id = :id;");
                    $stmt -> execute ([":task" => $task,":id"=> $id]);
                }
                header('Location: /');
                exit ;
            }
                //charger la vue update.php
                require dirname(__DIR__) . "/Views/update.php";
            }
    }