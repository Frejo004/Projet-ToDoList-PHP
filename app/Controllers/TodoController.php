<?php
    namespace App\Controllers;

;
    use App\Models\Todo;
    use DB\Database;


    class TodoController extends Controller{

        private $todoModels;

        public function __construct(){
            $this -> todoModels = new Todo();
        }

        public function index(){
            $todos =  $this -> todoModels -> getALL();
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
                $this -> redirect ("/");
            }
            //charger la vue add.php
            $this -> view("add");
        }



        public function delete(){
            $id = $_GET['id'] ?? null;
            if($id){
                $this -> todoModels -> delete($id);

                // $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) use ($id){
                //     return $todo['id'] !== $id;
                // });
                $this -> redirect ("/");
            }

            $this -> view("delete");
        }

        public function toggle(){
            $id = $_GET['id'] ?? null;
            if($id){
                $this -> todoModels ->toggle($id);


                // foreach($_SESSION['todos'] as &$todo){
                //     if($todo['id'] === $id){
                //         $todo['done'] = !$todo['done'];
                //     }
                $this -> redirect ("/");
                }
                $this -> view("toggle");
            }


        public function update(){
            $id = $_GET['id'] ?? null;
            
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $task = $_POST['task'];
                echo "$id";
                
                if($id){
                    $this -> todoModels -> update($id, $task);
                }
                $this -> redirect ("/");
            }
                //charger la vue update.php
                $this -> view("update");
            }
    }