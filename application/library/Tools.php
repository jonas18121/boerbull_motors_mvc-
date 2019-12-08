<?php

// je refactorise la fonction header()
function redirect($url){

    header('Location: ' . $url);
    exit();
}