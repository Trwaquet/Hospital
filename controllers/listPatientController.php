<?php

require_once(__DIR__ . '/../helpers/database.php');
require_once(__DIR__ . '/../models/Patient.php');

try {
    // On détermine sur quelle page on se trouve
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = (int) strip_tags($_GET['page']);
        }else{
            $currentPage = 1;
        }     

    

    // Nettoyage et validation du nom.
        // Nettoyage
        $search = trim((string) filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS));

    $patients = Patient::displayAll($search);
} catch (Exception $e) {
    $error = $e->getMessage();
} catch (PDOException $e) {
    die('ERREUR :' . $e->getMessage());
}

include(__DIR__ . '/../views/templates/header.php');
include(__DIR__ . '/../views/templates/sideNav.php');
include(__DIR__ . '/../views/listPatient.php');
include(__DIR__ . '/../views/templates/footer.php');