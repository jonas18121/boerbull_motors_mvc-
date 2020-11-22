<?php
require_once 'model/admin/car/add/AdminAddCarsModel.php';
require_once 'aSession/AdminSession.php';
require_once 'library/Tools.php';


//en GET
//affiche le formulaire d'ajout de voiture
function adminAddFormCars(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    // cette fonction permet de choisir une categorie pour les voitures qu'on va ajouter dans la base de donnée
    $category = category();

    require_once 'www/templates/admin/car/add/AdminAddCarsView.phtml';
} 


//en POST
//admin ajoute une voiture
function adminAddCars(){

    //si le admin n'est pas connecter au le renvois a l'accueil
    if(!isAuthenticatedAdmin()){
        redirect("index.php");
    }

    //controle de formulaire en php
    if(!empty($_POST)){
        if(array_key_exists('marque',$_POST) && isset($_POST['marque']) && ctype_alpha($_POST['marque']) && strlen($_POST['marque']) >= 2 && strlen($_POST['marque']) <= 25){
            
            if(array_key_exists('modele',$_POST) && isset($_POST['modele']) && strlen($_POST['modele']) >= 2 && strlen($_POST['modele']) <= 35){
                
                if(array_key_exists('annee',$_POST) && isset($_POST['annee']) && ctype_digit($_POST['annee']) && strlen($_POST['annee']) === 4){
                    
                    if(array_key_exists('conso',$_POST) && isset($_POST['conso']) && ctype_digit($_POST['conso']) && strlen($_POST['conso']) < 4){
                        
                        if(array_key_exists('color',$_POST) && isset($_POST['color']) && ctype_alpha($_POST['color'])){
                            
                            if(array_key_exists('prix_trois_jours',$_POST) && isset($_POST['prix_trois_jours']) && ctype_digit($_POST['prix_trois_jours']) && strlen($_POST['prix_trois_jours']) < 5){
                                
                                if(array_key_exists('puissance',$_POST) && isset($_POST['puissance']) && ctype_digit($_POST['puissance']) && strlen($_POST['puissance']) < 5){
                                    
                                    if(array_key_exists('moteur',$_POST) && isset($_POST['moteur'])){
                                        
                                        if(array_key_exists('carburant',$_POST) && isset($_POST['carburant']) && ctype_alpha($_POST['carburant'])){
                                            
                                            if(array_key_exists('cent',$_POST) && isset($_POST['cent']) && ctype_digit($_POST['cent'])){
                                                
                                                if(array_key_exists('nombre_de_place',$_POST) && isset($_POST['nombre_de_place']) && ctype_digit($_POST['nombre_de_place']) && strlen($_POST['nombre_de_place']) === 1){
                                                    
                                                    if(array_key_exists('id_category',$_POST) && isset($_POST['id_category']) && ctype_digit($_POST['nombre_de_place']) && strlen($_POST['nombre_de_place']) === 1){
                                                        
                                                        // if(array_key_exists('image_url',$_POST) && isset($_POST['image_url'])){
                                                        if(array_key_exists('image_url',$_FILES) && isset($_FILES['image_url']) && !empty($_FILES['image_url'])){

                                                            // Upload and Rename File
                                                            $filename = $_FILES["image_url"]["name"];
                                                            
                                                            $good_img = upload_file($filename);
                                                            if (empty($good_img)) {
                                                                redirect("index.php?action=admin&action2=car&action3=addForm");
                                                            }


                                                            addCars((string)$_POST['marque'], (string)$_POST['modele'], (int)$_POST['annee'], (int)$_POST['conso'], (string)$_POST['color'], (int)$_POST['prix_trois_jours'], (int)$_POST['puissance'], $_POST['moteur'], (string)$_POST['carburant'], (int)$_POST['cent'], (int)$_POST['nombre_de_place'], (int)$_POST['id_category'], (string) $good_img);

                                                        
                                                            //on redirectionne l'admin vers la liste des users
                                                            redirect("index.php?action=admin&action2=car&action3=get");
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
                            

    redirect("index.php?action=admin&action2=car&action3=addForm");
}

function upload_file($filename){

    $file_basename = substr($filename, 0, strripos($filename, '.')); // on récupère que le nom du fichier sans l'extention

    $file_ext = substr($filename, strripos($filename, '.')); // on récupère l'extention sans le nom du fichier

    $filesize = $_FILES["image_url"]["size"];

    $rand = rand(0, 100000000);
    $rand2 = rand(0, 100000000);

    $allowed_file_types = array('.doc','.docx','.rtf','.pdf', '.gif', '.jpg', '.png', '.PNG', '.jpeg');	

    if (in_array($file_ext, $allowed_file_types) && ($filesize < 200000))
    {	
        $first_filename = $file_basename . $file_ext;
        
        $date = new DateTime('now');
        $date = $date->format('Y_m_d_H_i_s');

        if (file_exists("www/imgBoerbullMotors/" . $first_filename))
        {
            
            // si le fichier existe déjà, on renomme le fichier
            $change         = "change {$date} {$rand2} and {$file_basename} plz";
            $new_filename   = md5($change) . $file_ext;
            $good_img       = $rand . '_' . $date . $new_filename;
            
            move_uploaded_file($_FILES["image_url"]["tmp_name"], "www/imgBoerbullMotors/" . $good_img );
            echo "success le fichier a été renomé et ajouter car il existe déjà dans ce dossier.";
        }
        else
        {		
            $good_img = $first_filename;
            move_uploaded_file($_FILES["image_url"]["tmp_name"], "www/imgBoerbullMotors/" . $good_img);
            echo "success le fichier est bien ajouter.";		
        }
        return $good_img;
    }
    elseif ($filesize > 200000)
    {	
        echo "Le fichier est trop large";
    }
    else
    {
        echo "Le fichier doit avoir l'un de ces extentions : " . implode(', ',$allowed_file_types);
        unlink($_FILES["image_url"]["tmp_name"]);
    }

    return $good_img = '';
}