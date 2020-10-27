<?php
//controlleur mettre en relation le model et la vue 


require_once 'model/category/CategoryModel.php';//appel du model
require_once 'library/Tools.php';


//A partir du routeur , getOneCategory() appelera notre function findCategory
function getOneCategory()
{
    $id_category = (int)$_GET['id_category'];
    //pre_var_dump($current_page);

    ///////////// pagination
    $current_page       = get_current_page($_GET['page']);
    $nb_car             = nb_xxx($id_category);
    $nb_car_par_page    = 6;
    $nb_pages           = (int) ceil($nb_car / $nb_car_par_page);
    $premier            = ($current_page * $nb_car_par_page) - $nb_car_par_page;
    
    //appel de la fontion du model
    $categories = findCategory($id_category, $premier, $nb_car_par_page);
    
    // pre_var_dump($categories, null, true);

    //appel de la vue
    require_once 'www/templates/category/CategoryView.phtml';
}



