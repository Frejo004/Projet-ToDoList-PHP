<?php
    namespace DB;

    use \PDO;
    use \PDOException;

    class Database{
        //Design Pattern; Singleton
        public PDO $instanceDb;
        //Les configurations de la base de données
        private const BD_HOST  = "localhost";
        private const BD_NAME  = "todos_db";
        private const BD_USER  = "root";
        private const BD_PASSWORD  = "";
        
        private string $dns ="mysql:host". self ::BD_HOST . "dbname" . "charset=utf8mb4";

        /**
         * Empêche l'intancition de la class
         */
        private function __construct() {}

        private function __clone() {}

        public function getIntance(){
            //si l'intance st null on la crée
            if(self :: $instanceDb === null){
                try {
                    self :: $instanceDb = new PDO(
                        "mysql:host". self ::BD_HOST . "dbname" . "charset=utf8mb4",
                    self::BD_USER, 
                    self::BD_PASSWORD);
                    [PDO :: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//lever des exeptions quand il y a des erreurs
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //renvoyer le données sous formes de tableau associatif
                    ];
                } 
                catch (PDOException $e) {
                   exit("Echec de connexion à la BDD" . $e -> getMessage());
                }
            }

            //sino , on renvoie directement
            return self::$instanceDb ;
        }
    }