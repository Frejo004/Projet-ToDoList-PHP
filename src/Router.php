<?php
    namespace App;

    /**
     * Classe Rooter
     * Gérer l'enregistrement et la résolution des routes pour notre application web.
     * Permet de définir des routes HTTP et d'excuterles actions corresoendantes
     * en fonction des requêtes entrantes
     */
    class Router {
        //Propiétéé privées pour stocker 
        private $routes = [];
        
        /**
         * Enregistre une route GET
         * 
         * @param mixed $url URL de la routtez (ex:"/home")
         * @param callable $action Fonction oh méthode à exécuter si la route correspondant
         * @return void
         */
        public function get( $url, callable $action){
            $this -> addRoutes ('GET', $url, $action);
        }

        /**
         * Enregistre une route POST
         * 
         * @param mixed $url URL de la routtez (ex:"/delete")
         * @param callable $action Fonction oh méthode à exécuter si la route correspondant
         * @return void
         */
        public function post( $url, callable $action){
            $this -> addRoutes ('POST', $url, $action);
        }

        /**
         * Ajouter une nouvelle routs
         * 
         * @param mixed $method (GET, POST)
         * @param mixed $url
         * @param callable $action
         * @return void
         */
        public function addRoutes($method, $url, callable $action){
            $this -> routes[] = [
                "method" => $method,
                "url" => $url,
                "action" => $action
            ];
        }


        /**
         * Résout la requête entrante en foncrion de routes enrégistrées
         * 
         * Compare l'URL et la méthode HTTP de la requ^ête de chaque route enregistrée
         * Si une correspondances est trouvé, l'action associéest exécutée.
         * Sinon une erreur 404 est retournée
         * 
         * @return void
         */
        public function resolve(){
            //Récupérer l'URL depuis la requête
            $requestURL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            //Récupérer la méthode HTTP utilisée pour la requête
            $requestMethode = $_SERVER['REQUEST_METHOD'];

            //Parcourir toutes les routes enrégistrées
            foreach ($this ->routes as $route){
                //Vérifier si l'URL et la méthode HTTP correspond à la routes   actuelle
                if($route['url'] === $requestURL && $route['method'] === $requestMethode){
                    //si une correspondante est trouvée, exécute l'action associée
                    call_user_func($route['action']);
                    return ;

                }
            }

            //
            http_response_code(404);
            echo "404 non trouvé";
        }
    }