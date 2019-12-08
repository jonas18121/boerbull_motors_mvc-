<?php
//controlleur mettre en relation le model et la vue 

//appel du model
require_once 'model/category/CategoryModel.php';

//A partir du routeur , getOneCategory() appelera notre function findCategory
function getOneCategory(){

    //appel de la fontion du model
    $categories = findCategory((int)$_GET['id_category']);

    //appel de la vue
    require_once 'www/templates/category/CategoryView.phtml';
}
