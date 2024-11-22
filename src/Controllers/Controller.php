<?php
    namespace App\Controllers;

    class Controller{

        /**
         * Méthode pour charger la vue
         * @param mixed $view Nom de la vue (fichier PHP)
         * @param mixed $data Données à transmettre
         * @return void
         */
        protected function view($view, $data = []){
            extract($data);
            require dirname(__DIR__) . "/Views/$view.php";
        }


        /**Méthode de rédiriger vers une URL
         * @param string $url ULR de rédirection
         * @return never
         */
        protected function redirect($url){
            header("Location:$url");
            exit;
        }
    }