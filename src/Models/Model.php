<?php
    namespace App\Models;

    use DB\Database;

    class Model{
        protected $db;

        public function __construct(){
            $this -> db = Database::getInstance();
        }
            
    }