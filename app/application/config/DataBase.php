<?php


class Database
{
    private static $instance = null;

    /** on ce connecte à la base de donnée
     * 
     * @return PDO
     */
    public static function dbConnect(){
        $dsn = 'mysql:host=db;dbname=boerbull_motors;charset=utf8';
        $user = 'root';
        $password = '';

        try {
            // design pattern singleton, pour qu'une seul connexion à la bdd, suffise pour toutes les requètes SQL qu'on va faire dans le site
            if(self::$instance === null){ 
                self::$instance = new PDO($dsn, $user, $password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
               ));
            }            

            return self::$instance;
  
        } catch (PDOException $e) {
            throw $e;
        }
    }
}