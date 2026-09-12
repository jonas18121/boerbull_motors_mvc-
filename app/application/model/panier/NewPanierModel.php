<?php
require_once 'config/DataBase.php';

class panierModel{

    private $pdo;

    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }

        if (!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }

        $db = new Database;
        $this->pdo = $db->dbConnect(); 
    }




    //compter le nombre d'élément présent dans le panier
    public function countt(){
        
        return array_sum($_SESSION['panier']);
    }





    /**
     * calcul le total des prix hors taxe des élément présent dans le panier
     * 
     * @param array $session
     * @return int|string
     */
    public function prixHorsTaxe(array $session)
    {
        $total = 0;

        if(empty($session)){

            $products = implode(array());
            return $products;

        }else {

            //implode() va convertir le tableau $session en chaine de caractère pour les utilisés dans la requète
            $sql = 'SELECT id, prix_trois_jours FROM car WHERE id IN ('.implode(',',$session).')';
        
            $products = $this->pdo->prepare($sql);
            $products->execute(array('id' => implode(',' , $session)));
            $products = $products->fetchAll(PDO::FETCH_OBJ); // PDO::FETCH_OBJ pour recupéré le résultat sous forme d'objet

            foreach($products as $product){
                //prix hors taxes , fois le nombres de voiture avec le même id
                $total += $product->prix_trois_jours * $_SESSION['panier'][$product->id];
            }
            return $total;
        }
    }




    /** calculer la TVA qui s'ajoutera au prix hors taxes 
     * 
     * @param array $session
     * 
     * @return int|string
    */
    public function TVA(array $session)
    {
        $total = 0;

        if(empty($session)){

            $products = implode(array());
            return $products;

        }else {
            // on calcule la TVA pendant la requête
            $sql = 'SELECT id, round(SUM(prix_trois_jours)*(0.2),2) AS TVA FROM car WHERE id IN ('.implode(',',$session).')';

            $TVA = $this->pdo->prepare($sql);
            $TVA->execute(array('id' => implode(',' , $session)));
            $TVA = $TVA->fetchAll(PDO::FETCH_OBJ);


            foreach($TVA as $product){
                //TVA , fois le nombres de voiture avec le même id
                $total += $product->TVA * $_SESSION['panier'][$product->id];
            }

            return $total;
        }
    }





    /** calculer le prix TTC 
     * 
     * @param array $session
     * 
     * @return int|string
    */
    public function prixTTC(array $session)
    {
        $total = 0;

        if(empty($session)){
            $products = implode(array()); 
            return $products;

        }else {
            $sql = 'SELECT id, SUM(prix_trois_jours)*(1.2) AS prixTTC FROM car WHERE id IN ('.implode(',',$session).')';

            $session = implode(',',$session);

            $prixTTC = $this->pdo->prepare($sql);
            $prixTTC->execute(array('id' => $session));
            $prixTTC = $prixTTC->fetchAll(PDO::FETCH_OBJ);

            foreach($prixTTC as $product){
                //TVA , fois le nombres de voiture avec le même id
                $total += $product->prixTTC * $_SESSION['panier'][$product->id];
            }
            return $total;
        }
    }









    /** ajouter un element au panier
     * 
     * @param int $product_id
     * 
     */
    public function addPanier(int $product_id) 
    {
        if(isset($product_id)){

            $sql = 'SELECT id FROM car WHERE id = :id';

            $products = $this->pdo->prepare($sql);
            $products->execute(array('id' => $product_id));
            $products = $products->fetchAll(PDO::FETCH_OBJ); // PDO::FETCH_OBJ pour recupéré le résultat sous forme d'objet
        }


        // $products[0]->id est l'id de la voiture qu'on a ajouter au panier
        if(isset($_SESSION['panier'][$products[0]->id])){

            $_SESSION['panier'][$products[0]->id] = '1';
        }else {
        
            $_SESSION['panier'][$products[0]->id] = '1' ;
        }

        redirect("index.php?action=panierView");
    }







    /** effacer un élément du panier
     * 
     * @param int $product_id
     * @return void
     */
    public function deleteOne(int $product_id) : void
    {
        unset($_SESSION['panier'][$product_id]);
    }


    /** effacer tous les éléments du panier
     * 
     * @return void
     */
    public function deleteAll() :void
    {
        unset($_SESSION['panier']);
        
    }





    /** selectonner les voitures qui sont dans le panier
     * 
     * @param array $session
     * @return array|string
     */
    public function PanierView(array $session)
    {
        if(!empty($session)){

            //implode() va convertir le tableau $session en chaine de caractère pour les utilisés dans la requète
            $sql = "SELECT id, marque, modele, puissance, prix_trois_jours, nombre_de_voiture FROM car WHERE id IN (".implode(',',$session).")";

            $session = implode(',',$session);

            $PanierView = $this->pdo->prepare($sql);
            $PanierView->execute(array(
                ':id' => $session,
            ));
            $PanierView = $PanierView->fetchAll();
           
            return $PanierView;
            
        }else{
            $PanierView = implode(array());
            return $PanierView;
        } 
         
    }
}