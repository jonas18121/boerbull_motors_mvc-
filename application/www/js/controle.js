'use strict';


///////////////// SELECTEUR //////////////////////////

/* selectionne les balise html */ 

let mail            = document.getElementById('mail');
let password        = document.getElementById("password");
let firstName       = document.getElementById('firstName');
let lastName        = document.getElementById('lastName');

let msgMail         = document.getElementById("msgMail");
let msgPass         = document.getElementById('msgPass');
let msgName         = document.getElementById('msgName');
let msgFirstName    = document.getElementById('msgFirstName');

let submit          = document.getElementById('confirme');
let form            = document.getElementById('form');
let submitBooking   = document.getElementById('confirmeBooking');


///////////////// FUNCTION //////////////////////////


//popup de confirmation avant de supprimer
function confirmeDelete(param) {
    
    if(param === 'user'){
        return(confirm("Voulez vous vraiment supprimer votre compte ?"));

    }else if(param === 'car'){
        return(confirm("Voulez vous vraiment supprimer ce véhicule ?"));

    }else if(param === 'admin'){
        return(confirm("Voulez vous vraiment supprimer votre compte admin ?"));

    }else if(param === 'adminUser'){
        return(confirm("Voulez vous vraiment supprimer ce compte ?"));

    }else if(param === 'adminBooking' || param === 'userBooking'){
        return(confirm("Voulez vous vraiment supprimer ce rendez-vous ?"));

    }else if(param === 'userPanier'){
        return(confirm("Voulez vous vraiment supprimer ce véhicule du panier ?"));
    }
}

// popup qui demande à l'utilisateur s'il veut vraiment confirmer avant de valider le formulaire pour une connexion
function confirmer(){
    
    if(confirm("Voulez vous vraiment valider ?")){

        //formulaire a été pris dans le name de form
        formulaire.submit();
    }
}


// popup qui demande à l'utilisateur s'il veut vraiment confirmer avant de valider son choix
function seConnecter(){
    return confirm("Vous devez, vous connectez pour ajouter du contenu dans votre panier. Voulez vous, vous connectez ?");
}



//popup qui informe a l'utilisateur que sont rendez-vous à bien été pris en compte
function bokingConfirme() {
    
    alert("Votre rendez-vous est bien enregistrée, nous vous en remercions ")
}




//verification de la longueur du mot de passe saisie
function verifPass(e){

    let pass = e.target.value;// valeur saisie dans le champ

    //couleur et texte par défaut
    let longueur = "faible , il faut minimun 8 caractères pour être valide";
    let color = "red";
    
    //si la longueur du mot de passe est plus grand ou égale à 8
    if(pass.length >= 8){
        longueur = "suffisante";
        color = "green";
    }
    //si la longueur du mot de passe est plus grand ou égale à 4
    else if(pass.length >= 4){
        longueur = "moyen , il faut minimun 8 caractères pour être valide";
        color = "orange";
    }
        
    msgPass.textContent = longueur;//la longueur du texte varira selon la longueur du mot de passe
    msgPass.style.color = color;//la couleur du texte varira selon la longueur du mot de passe
    
}






//verification de la longueur du nom 
function verifName(e){

    let name = e.target.value;// valeur saisie dans le champ

    // par défaut
    let longueur = "";
    let color = "";
    
    //si la longueur du nom sont plus grand ou égale à 2 et plus petit ou égale a 25
    if(name.length >= 2 && name.length <= 25){
        longueur = "bon";
        color = "green";
    }
    //si la longueur du nom sont plus petit que 2 
    else if(name.length < 2){
        longueur = "trop petit , il faut minimum 2 caractères";
        color = "red";
       
    }
    //si la longueur du nom sont plus grand que 25 
    else if(name.length > 25){
        longueur = "trop grand, il faut maximum 25 caractères";
        color = "red";
    }

        
    msgName.textContent = longueur;//la longueur du texte varira selon la longueur du nom 
    msgName.style.color = color;//la couleur du texte varira selon la longueur du nom
    
}






//verification de la longueur du prenom
function verifFirstName(e){

    let fristName = e.target.value;// valeur saisie dans le champ

    // par défaut
    let longueur = "";
    let color = "";
    
    //si la longueur du prenom sont plus grand ou égale à 2 et plus petit ou égale a 25
    if(fristName.length >= 2 && fristName.length <= 25){
        longueur = "bon";
        color = "green";
    }
    //si la longueur du prenom sont plus petit que 2 
    else if(fristName.length < 2){
        longueur = "trop petit , il faut minimum 2 caractères";
        color = "red";
    }
    //si la longueur du prenom sont plus grand que 25 
    else if(fristName.length > 25){
        longueur = "trop grand, il faut maximum 25 caractères";
        color = "red";
    }

        
    msgFirstName.textContent = longueur;//la longueur du texte varira selon la longueur du prenom
    msgFirstName.style.color = color;//la couleur du texte varira selon la longueur du prenom
}





//controle du mail en fin de saisie
function mailControle(e){

    //exemple roi1@gmail.com
    let regex = /^[a-zA-Z][a-zA-Z0-9._/-]{1,19}@[a-z]{4,7}\.[a-z]{2,3}$/;
    let valide = "";

    if(!regex.test(e.target.value)){
        valide = "adresse invalide";
    }
    
    msgMail.textContent = valide;// on ecrit le texte contenue qui est dans valide, dans le span si le mail est invalide
    msgMail.style.color = "red";//le texte sera de couleur rouge
}




//////////////// PROGRAMME //////////////////////////

//DOMContentLoaded attent que la partie HTML soit complètement chargé et analysé pour commencer à fonctionner
document.addEventListener('DOMContentLoaded', function(){
    
    mail.addEventListener("blur", mailControle);//controle du mail en fin de saisie
    password.addEventListener("input", verifPass);//verification de la longueur du mot de passe saisie
        //submit.addEventListener("click", confirmer);// popup pour connexion
    lastName.addEventListener("input", verifName);//controle du nom en fin de saisie
        //submitBooking.addEventListener("click", bokingConfirme);// popup pour connexion
    firstName.addEventListener("input", verifFirstName);//controle du prenom en fin de saisie 
    
});









