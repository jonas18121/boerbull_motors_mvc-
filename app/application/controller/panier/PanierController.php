<?php
//controlleur mettre en relation le model et la vue 

//appel du model
include_once 'model/panier/NewPanierModel.php';
require_once 'model/oneCar/OneCarModel.php';

//appel dans la librairie
include_once 'library/Tools.php';

//appel de la session
require_once 'aSession/AdminSession.php';


//A partir du routeur , il appelera notre function panierAdd()
function panierAdd(){

    if(!isAuthenticatedUser()){
        redirect("index.php?action=user&action2=loginForm");
    }

    $ClassPanier = new PanierModel(); 
    
    //appel des fontions du model
    $ClassPanier->addPanier((int)$_GET['id']);

    //appel de la vue
    require_once 'www/templates/panier/PanierView.phtml';
}



//A partir du routeur , il appelera notre function panierOpen()
function panierOpen(){

    $ClassPanier = new PanierModel(); 
    
         
    //appel des fontions du model
    //avec array_keys() on recupère les clefs des voitures qui sont dans le panier et le retourne en tableau
    $session = array_keys($_SESSION['panier']);

        //selectionne
    $panier = $ClassPanier->PanierView($session);
    $prix_total_ht = $ClassPanier->prixHorsTaxe($session);
    $prix_total_TTC = $ClassPanier->prixTTC($session);
    $TVA = $ClassPanier->TVA($session);
    
    //appel de la vue
    require_once 'www/templates/panier/PanierView.phtml';  
}



function deleteOneArticle(){

    $ClassPanier = new PanierModel(); 

    $ClassPanier->deleteOne((int)$_GET['id']);


    //avec array_keys() on recupère les clefs des voitures qui sont dans le panier et le retourne en tableau
    $session = array_keys($_SESSION['panier']);

    $panier = $ClassPanier->PanierView($session);
    $prix_total_ht = $ClassPanier->prixHorsTaxe($session);
    $prix_total_TTC = $ClassPanier->prixTTC($session);
    $TVA = $ClassPanier->TVA($session);

   redirect('index.php?action=panierView');
} 