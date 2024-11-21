<?php
    namespace DB;

    use Dotenv\Dotenv;
    use \PDO;
    use \PDOException;
    
    class Database{
        //Design Pattern; Singleton
        public static ?PDO $instanceDb = null;

        
        /**
         * Empêche l'intancition de la class
         */
        private function __construct() {}

        private function __clone() {}

        public static function getInstance(){

            $dotenv = Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->load();

            //Les configurations de la base de données
            $dbHost = $_ENV["BD_HOST"];
            $dbName = $_ENV["BD_NAME"];
            $dbUser = $_ENV["BD_USER"];
            $dbPassword = $_ENV["BD_PASSWORD"];


            //si l'intance st null on la crée
            if(self :: $instanceDb === null){
                try {
                    self::$instanceDb = new PDO(
                        "mysql:host=". $dbHost. ";dbname=". $dbName. ";charset=utf8mb4",
                    $dbUser, 
                    $dbPassword);
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//lever des exeptions quand il y a des erreurs
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