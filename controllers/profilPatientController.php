<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');
require_once(__DIR__ . '/../models/Appointment.php');

    // Nettoyage de l'Id.
        $id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

try {
    $patients = Patient::displayOne($id);
    $appointments = Appointment::displayAllForPatient($id);
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/templates/sideNav.php');
include(__DIR__ . '/../views/profilPatient.php');
include(__DIR__ . '/../views/templates/footer.php');