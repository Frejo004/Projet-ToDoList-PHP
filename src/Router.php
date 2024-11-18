<?php
    namespace App;

    class Router {
        private $routes = [];

        public function get( $url, callable $action){
            $this -> addRoutes ('GET', $url, $action);
        }
        public function post( $url, callable $action){
            $this -> addRoutes ('POST', $url, $action);
        }
        public function addRoutes($method, $url, callable $action){
            $this -> routes[] = [
                "method" => $method,
                "url" => $url,
                "action" => $action
            ];
        }

        public function resolve(){

        }
    }