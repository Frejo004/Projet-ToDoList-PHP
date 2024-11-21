<?php
    namespace App\Controllers;

;
    use App\Models\Todo;
    use DB\Database;


    class TodoController{

        private $todoModels;

        public function __construct(){
            $this -> todoModels = new Todo();
        }

        public function index(){
            $todo =  $this -> todoModels -> getALL();
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

                    $this -> todoModels -> create($task);
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
                $this -> todoModels -> delete($id);

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
                $this -> todoModels ->toggle($id);


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