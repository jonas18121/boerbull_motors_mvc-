<?php

// je refactorise la fonction header()
function redirect($url){

    header('Location: ' . $url);
    exit();
}

//////////////////////////////////////////////////////////////////////

// boite à outils php 

/**
 * var_dump avec < pre >< / pre > pour le debogage de code
 * 
 * @param mixed $param1 - Tous les types de param sont accepter
 * @param mixed $param2 - (facultative) Tous les types de param sont accepter
 * @param bool $param3  - activer ou pas, la function die()
 * 
 * @return void - retourn la valeur de var_dump
 */
function pre_var_dump($param1, $param2 = null, $param3 = false) : void
{
    if ($param3 === false) {
        
        if ($param2 === null) {
            echo '<pre>';
            var_dump($param1);
            echo '</pre>';
        }
        else{
            echo '<pre>';
            var_dump($param1, $param2);
            echo '</pre>';
        }
    }else{
        if ($param2 === null) {
            echo '<pre>';
            var_dump($param1);die;
            echo '</pre>';
        }
        else{
            echo '<pre>';
            var_dump($param1, $param2);die;
            echo '</pre>';
        }
    }
}


/**
 * Controller si la session de l'user est authentifier ou pas via son mail
 * 
 * @return bool - retourne true si l'user est authentifier ou false si l'user n'est pas authentifier
 */
function is_authenticated_user() : bool
{
    if(array_key_exists('email', $_SESSION)) {
        if (!empty($_SESSION['email']) && isset($_SESSION['email'])) {
            return true;
        }
    }
    return false;
}

/**
 * retourne un tableau de string
 * 
 * @param string $erreur
 * 
 * @return string $erreur 
 */
function get_erreur($erreur)
{
    if(isset($erreur)){
        for ($i=0; $i < count($erreur); $i++) { 
            echo $erreur[$i];
        }
    }
}


/**
 * faire une redirection
 * 
 * @param string $url - url de destination
 * @param bool $bool 
 * 
 * @return void
 */
function header_location(string $url, bool $bool = true) : void
{
    if($bool === false){
        header("Location: {$url}");
    }
    else{
        header("Location: {$url}");
        exit();
    }
}

/**
 * connexion à la base de donnée
 * 
 * @param string $host - nom d'hôte ou une adresse IP, exemple : "127.0.0.1"
 * @param string $username - nom d'utilisateur MySQL
 * @param string $password - mot de passe
 * @param string $database - nom de la base de données par défaut à utiliser lors de l'exécution de requêtes
 * 
 * @return $link
 */
function connect_bdd(string $host, string $username, string $password, string $database)
{
    $link = mysqli_connect($host, $username, $password, $database);

    if (!$link) {
        echo "Erreur : Impossible de se connecter à MySQL." . PHP_EOL;
        echo "Errno de débogage : " . mysqli_connect_errno() . PHP_EOL;
        echo "Erreur de débogage : " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}


////////////////////////// pagination //////////////////////////////////////////

/**
 * On détermine sur quelle page on se trouve
 * 
 * @param int $get
 * 
 * @return int $current_page
 */
function get_current_page(int $get) : int
{
    if(isset($get) && !empty($get))
    {
        $current_page = (int) strip_tags($get);   
    }
    else{
        $current_page = 1;
    }

    return $current_page;
}



////////////////////////// fin de pagination //////////////////////////////////////////