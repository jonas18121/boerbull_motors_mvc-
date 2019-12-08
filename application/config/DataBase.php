<?php


class Database{


    private static $instance = null;

    /** on ce connecte à la base de donnée
     * 
     * @return PDO
     */
    public static function dbConnect(){
        $dsn = 'mysql:host=localhost;dbname=boerbull_motors';
        $user= 'root';
        $password = '';

        try {
            // design pattern singleton, pour qu'une seul connexion à la bdd, suffise pour toutes les requètes SQL qu'on va faire dans le site
            if(self::$instance === null){ 

                self::$instance = new PDO($dsn, $user, $password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ));
            }

            return self::$instance;
  
        } catch (PDOException $e) {
            echo ' Erreur : ' . $e->getMessage();
        }
    }
}