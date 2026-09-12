'use strict';

$(function(){

    jQuery.validator.setDefaults({
        debug: false, // avec true le formulaire n'est pas soumis
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

    // validation user
    $("#form_user").validate({

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
            last_name: {
                required: true,
                minlength: 2,
                maxlength: 40
            },

            first_name: {
                required: true,
                minlength: 2,
                maxlength: 40
            },

            mail: {
                required: true,
                email: true
            },

            password: {
                required: true,
                minlength: 2
            },

            password_verif: {
                required: true,
                equalTo: '#password'
            }
        },

        messages:{
            last_name: {
                required: 'Ce champ ne doit pas rester vide',
                minlength: jQuery.validator.format('Il faut minimun 2 caractères !'),
                maxlength: jQuery.validator.format('Il faut maximun 40 caractères !'),
            },

            first_name: {
                required: 'Ce champ ne doit pas rester vide',
                minlength: jQuery.validator.format('Il faut minimun 2 caractères !'),
                maxlength: jQuery.validator.format('Il faut maximun 40 caractères !'),
            },

            mail: {
                required: 'Ce champ ne doit pas rester vide',
                email: ' Votre email doit ressembler a ceci xx@xxxx.xx au minimun de caractères'
            },

            password: {
                required: 'Ce champ ne doit pas rester vide',
                minlength:jQuery.validator.format('Il faut minimun 2 caractères !'),
            },

            password_verif: {
                required: 'Ce champ ne doit pas rester vide',
                equalTo: 'Le mot de passe de comfirmation ne doit pas être différent du champs mot de passe'
            }
        }
    });

    // validation reservation
    $("#form_reservation").validate({

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
            datetimepicker: {
                required: true,
                // dateISO: true
            },

            datetimepicker2: {
                required: true,
                //dateISO: true
            },

            numberOfSeats: {
                required: true,
            },
        },

        messages:{
            datetimepicker: {
                required: 'Ce champ ne doit pas rester vide',
                // dateISO: jQuery.validator.format('Le format de la date doit être dd/mm/yyyy hh:mm'),
            },

            datetimepicker2: {
                required: 'Ce champ ne doit pas rester vide',
                // dateISO: jQuery.validator.format('Le format de la date doit être dd/mm/yyyy hh:mm'),
            },

            numberOfSeats: {
                required: 'Ce champ ne doit pas rester vide',
            },
        }
    });
});