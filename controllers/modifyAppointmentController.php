<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');



try {
    
    // Nettoyage de l'Id.
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));    
    
    $appointments = Appointment::displayOne($id);
    
    
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
        
        // Nettoyage de l'Id.
        $idPatients = intval(filter_input(INPUT_POST, 'patients', FILTER_SANITIZE_NUMBER_INT));
        
        if(empty($error)){        
            // Concatenation de la date et de l'heure pour la formater au format de la base de données.
            $dateHour = $date . ' ' . $time ;
            
            // Appel de la méthode permettant d'ajouter les données dans la base de donnée.
            
            $Appointment = new Appointment($id, $dateHour, $idPatients); 
 
            $isUpdated = $Appointment->modify(); 
            
            if ($isUpdated == true) {
                $updateMessage = 'Données mises à jour';
                $appointments = Appointment::displayOne($id);
            } else {
                $updateMessage = 'Une erreur est survenue';
            };
        }
    }  
    
    
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/templates/sideNav.php');
include(__DIR__ . '/../views/modifyAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');