<?php $title = 'Rendez-vous client'; ?>
<!-- demarre une tamporisation de sortie -->
<?php ob_start(); ?>

<section class='sectionUniversel'>
    
    <h2>Ajouter un rendez-vous pour <?= htmlspecialchars(utf8_encode($user['first_name'])) . ' ' . htmlspecialchars(utf8_encode($user['last_name'])) ?></h2>

    <form action="index.php?action=admin&action2=users&action3=bookingAdd" method="post">

        <div>
            <input type="hidden" name="user_i" value="<?= htmlspecialchars(htmlentities($_GET['id'])) ?>">
        </div>

        <div>
            <label for="booking_date_debut">Date de debut</label>
            <input type="date" name="booking_date_debut" id="booking_date_debut" placeholder="20.06.2019" required>
        </div>

        <div>
            <label for="booking_time_debut">Heure de debut</label>
            <input type="text" name="booking_time_debut" id="booking_time_debut" placeholder="09:19" min="09:00" max="18:00" required>
        </div>    

        <div>
            <label for="booking_date_fin">Date de fin</label>
            <input type="date" name="booking_date_fin" id="booking_date_fin" placeholder="30.06.2019" required>
        </div>    

        <div>
            <label for="booking_time_fin">Heure de fin</label>
            <input type="text" name="booking_time_fin" id="booking_time_fin" placeholder="09:19" min="09:00" max="18:00" required>
        </div>

        <div>
            <label for="number_of_seats">Nombre de personne</label>
            <select name="number_of_seats" id="number_of_seats" required>
                <option value="">Selectionné le nombre de personnes</option>

                <!-- on peut choisir entre 0 et 3 personne pour aller chercher la voiture -->
                <?php for($numberOfSeats = 0; $numberOfSeats <=3; $numberOfSeats++) : ?>
                    <option value="<?= $numberOfSeats ?>">
                        <?= $numberOfSeats ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div>
            <input type="submit" value="Enregistrer" class="myValid">
        </div>    
    </form>
    
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"
        charset="utf-8"></script>

    <script>
        $(function () {

            let today = new Date();

            //la localité sera française pour les heures
            $.datetimepicker.setLocale('fr');

            $('#datetimepicker').datetimepicker({

                type: 'datetime',
                firstDayOfWeek: 0,
                monthFirst: false,

                //Toutes les langues supportées ici
                i18n: {
                    //on transforme et affiche les dates en français dans le calendrier
                    fr: {
                        months: [
                            'Janvier', 'Février', 'Mars', 'Avril',
                            'Mai', 'Juin', 'Julliet', 'Aout',
                            'Septembre', 'Octobre', 'Novembre', 'Decembre',
                        ],
                        dayOfWeek: [
                            "Dim", "Lu", "Ma", "Me",
                            "Je", "Ve", "Sa",
                        ]
                    }
                },
                // affiche les heures ou nous somme disponible pour un RDV dans le calendrier
                allowTimes: [
                    '09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'
                ],
                //format de la date et les heures
                format: 'd.m.Y H:i',

                /*date minimun pour reserver une voiture , qui est la date d'aujourd'hui avec today, mais la date de reservation devra être pris 2 heures après l'heure qu'ils on cliquer sur reserver aujourd'hui(uniquement, si le RDV est pour aujourd'hui) grace au 2 de today.getHours() + 2*/
                minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate(), today
                    .getHours() + 2, today.getMinutes()),

                /* date maximal pour reserver une voiture, on a jusqu'a 15 jours (pas plus) à partir d'aujourd'hui. grace au 15 de today.getDate() + 15 */
                maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 15, today
                    .getHours())
            });
        });
    </script>

</section>

<!-- fermer la tamporisation de sortie et le mettre dans une variable -->
<?php $content = ob_get_clean(); ?>
<?php require_once 'www/layout/layoutView.phtml'; ?>