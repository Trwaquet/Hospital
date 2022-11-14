<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');

// Nettoyage de l'Id.
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

try {
    $patients = Patient::delete($id);
    header('Location: /controllers/listPatientController.php');
    exit();
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}