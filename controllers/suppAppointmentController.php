<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Appointment.php');

// Nettoyage de l'Id.
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

try {
    $isDeleted = Appointment::delete($id);
    if($isDeleted){
        SessionFlash::set('Le rendez-vous a bien été supprimé.');
    } else {
        SessionFlash::set('Une erreur est survenue.');
    }
    header('Location: /controllers/listAppointmentController.php');
    exit();
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}