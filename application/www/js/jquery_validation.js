'use strict';

$(function(){

    jQuery.validator.setDefaults({
        debug: true, // avec true le formulaire n'est pas soumis
        success: "valid"
    }); 

    // validation car
    $("#form_car").validate({

        submitHandler: function(form) {
            form.submit();
        },

        invalidHandler: function(event, validator)
        {
            let errors = validator.numberOfInvalids();

            if (errors) {
                
                let message = (errors == 1) ? 'Vous avez ' + errors + ' erreur à corriger' : 'Vous avez ' + errors + ' erreurs à corriger';
                $('div#error span').html(message); 
                $('div#error').show();
            }
            else{
                $('div#error').hide();
            }
        },

        rules:{
            marque : {
                required: true,
                minlength: 2,
                maxlength: 25,
            },
            modele: {
                required: true,
                minlength: 2,
                maxlength: 25
            },
            annee: {
                required: true,
                minlength: 4,
                maxlength: 4,
                number: true
            },
            conso: {
                required: true,
                maxlength: 3,
                number: true
            },
            color:{
                required: true,
            },
            prix_trois_jours: {
                required: true,
                maxlength: 4,
                number: true
            },
            puissance: {
                required: true,
                maxlength: 4,
                number: true
            },
            moteur:{
                required: true,
            },
            carburant:{
                required: true,
            },
            cent: {
                required: true,
                number: true
            },
            nombre_de_place: {
                required: true,
                maxlength: 1,
                number: true
            },
            id_category: {
                required: true,
                maxlength: 1,
                number: true
            },
            image_url: {
                required: true
            },
        },

        messages:{
            marque : {
                required: 'Ce champ ne doit pas rester vide',
                minlength: jQuery.validator.format('Il faut minimun 2 caractères !'),
                maxlength: jQuery.validator.format('Il faut maximun 25 caractères !'),
            },
            modele: {
                required: 'Ce champ ne doit pas rester vide',
                minlength: jQuery.validator.format('Il faut minimun 2 caractères !'),
                maxlength: jQuery.validator.format('Il faut maximun 25 caractères !'),
            },
            annee: {
                required: 'Ce champ ne doit pas rester vide',
                minlength: jQuery.validator.format('Il faut minimun 4 caractères !'),
                maxlength: jQuery.validator.format('Il faut maximun 4 caractères !'),
                number: 'Seul les chiffres sont accepter dans ce champ'
            },
            conso: {
                required: 'Ce champ ne doit pas rester vide',
                maxlength: jQuery.validator.format('Il faut maximun 3 caractères !'),
                number: 'Seul les chiffres sont accepter dans ce champ'
            },
            color:{
                required: 'Ce champ ne doit pas rester vide',
            },
            prix_trois_jours: {
                required: 'Ce champ ne doit pas rester vide',
                maxlength: jQuery.validator.format('Il faut maximun 4 caractères !'),
                number: 'Seul les chiffres sont accepter dans ce champ'
            },
            puissance: {
                required: 'Ce champ ne doit pas rester vide',
                maxlength: jQuery.validator.format('Il faut maximun 4 caractères !'),
                number: 'Seul les chiffres sont accepter dans ce champ'
            },
            moteur:{
                required: 'Ce champ ne doit pas rester vide',
            },
            carburant:{
                required: 'Ce champ ne doit pas rester vide',
            },
            cent: {
                required: 'Ce champ ne doit pas rester vide',
                number: 'Seul les chiffres sont accepter dans ce champ'
            },
            nombre_de_place: {
                required: 'Ce champ ne doit pas rester vide',
                maxlength: jQuery.validator.format('Il faut maximun 1 caractères !'),
                number: 'Seul les chiffres sont accepter dans ce champ'
            },
            id_category: {
                required: 'Ce champ ne doit pas rester vide',
                maxlength: jQuery.validator.format('Il faut maximun 1 caractères !'),
                number: 'Selectionner une valeur'
            },
            image_url: {
                required: 'Ce champ ne doit pas rester vide'
            },
        }

    });
});