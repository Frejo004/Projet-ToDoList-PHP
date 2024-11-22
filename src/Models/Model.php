<?php
    namespace App\Models;

    use DB\Database;

    abstract class Model{
        protected $db;

        public function __construct(){
            $this -> db = Database::getInstance();
        }
            
    }