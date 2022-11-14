<?php

require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

try {
    $patients = Patient::displayAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Nettoyage et validation de la date.
        //Nettoyage
        $date = trim((string) filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT));
        // Validation 
        if (empty($date)) {
            $error['date'] = 'La date est obligatoire.';
        } else {
            $isOk = filter_var($date, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_FOR_DATE . '/')));
            if ($isOk == false) {
                $error['date'] = 'La date n\'est pas conforme.';
            }
        }

    // Nettoyage et validation de time.
        // Nettoyage
        $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_NUMBER_INT);
        // Validation
        if(empty($time)){
            $error['time'] = 'L\'heure est obligatoire.'; 
        } else {
                if ($time < 1 || $time > 6){
                    $error['time'] = 'L\'heure n\'est pas conforme.';
                }
            // Définitions des heure selon les valeur de time.
                if ($time == 1){
                    $time = '09:00:00';
                } else if ($time == 2){
                    $time = '10:00:00';
                } else if ($time == 3){
                    $time = '11:00:00';
                } else if ($time == 4){
                    $time = '14:00:00';
                } else if ($time == 5){
                    $time = '15:00:00';
                }else if ($time == 6){
                    $time = '16:00:00';
                }
        }

    // Nettoyage et validation de patients.
        // Nettoyage
        $idPatients = intval(filter_input(INPUT_POST, 'patients', FILTER_SANITIZE_NUMBER_INT));

    if(empty($error)){
        
                // Concatenation de la date et de l'heure pour la formater au format de la base de données.
                    $dateHour = $date . ' ' . $time ;
        
                // Création d'un nouvel objet PDO.    
                    $appointment = new Appointment($dateHour, $idPatients);
        
                // Appel de la méthode permettant d'ajouter les données dans la base de donnée.
                    $isAddedAppointment = $appointment->add();
    }
}   

} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/templates/sideNav.php');
include(__DIR__ . '/../views/addAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');