<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

    // Nettoyage de l'Id.
        $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

try {
    $appointments = Appointment::displayOne($id);
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/templates/sideNav.php');
include(__DIR__ . '/../views/profilAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');