<?php

require_once(__DIR__ . '/../helpers/database.php');
require_once(__DIR__ . '/../models/Appointment.php');

try {
    $appointments = Appointment::displayAll();
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/templates/sideNav.php');
include(__DIR__ . '/../views/listAppointment.php');
include(__DIR__ . '/../views/templates/footer.php');