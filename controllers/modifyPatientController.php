<?php

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../models/Patient.php');


try {
    $id = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $patient = Patient::displayOne($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Nettoyage et validation du nom.
        // Nettoyage
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
        // Validation
        if (empty($lastname)) {
            $error['lastname'] = 'Le nom est obligatoire.';
        } else {
            $isOk = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_FOR_NAME . '/')));
            if ($isOk == false) {
                $error['lastname'] = 'Le nom n\'est pas conforme.';
            }
        }

    // Nettoyage et validation du prénom.
        // Nettoyage
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
        // Validation
        if (empty($firstname)) {
            $error['firstname'] = 'Le prénom est obligatoire.';
        } else {
            $isOk = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_FOR_NAME . '/')));
            if ($isOk == false) {
                $error['firstname'] = 'Le prénom n\'est pas conforme.';
            }
        }

    // Nettoyage et validation du genre.
        // Nettoyage
        $genders = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_NUMBER_INT, FILTER_REQUIRE_ARRAY) ?? [];
        // Validation
        if(empty($genders)){
            $error['gender'] = 'Le genre est obligatoire.'; 
        } else {
            foreach ($genders as $key => $gender) {
                if ($gender < 1 || $gender > 2){
                    $error['gender'] = 'Le genre n\'est pas conforme.';
                }
            }
        }

    // Nettoyage et validation du numéros de securiter sociale.
        // Nettoyage
        $socialSecureCode = filter_input(INPUT_POST, 'socialSecureCode', FILTER_SANITIZE_NUMBER_INT) ?? [];
        // Validation
        if(empty($socialSecureCode)){
            $error['socialSecureCode'] = 'Le Numéros de sécuriter sociale est obligatoire.'; 
        } else {
            $isOk = filter_var($socialSecureCode, FILTER_VALIDATE_REGEXP, array("options"=> array("regexp" => '/' . REGEX_FOR_SOCIALECODE . '/')));
            if ($isOk == false) {
                $error['socialSecureCode'] = 'Le numéros de sécuriter sociale n\'est pas conforme.';
            }
        }

    // Nettoyage et validation de la date de naissance.
        //Nettoyage
        $dateOfBirth = trim((string) filter_input(INPUT_POST, 'dateOfBirth', FILTER_SANITIZE_SPECIAL_CHARS));
        // Validation 
        if (empty($dateOfBirth)) {
            $error['dateOfBirth'] = 'La date de naissance est obligatoire.';
        } else {
            $isOk = filter_var($dateOfBirth, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_FOR_DATE . '/')));
            if ($isOk == false) {
                $error['dateOfBirth'] = 'La date de naissance n\'est pas conforme.';
            }
        }
        
    // Nettoyage et validation de l'adresse.
        // Nettoyage 
        $address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_SPECIAL_CHARS));
        // Validation
        if (empty($address)) {
            $error['address'] = 'L\'adresse est obligatoire.';
        } else {
            $isOk = filter_var($address, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_FOR_ADDRESS . '/')));
            if ($isOk == false) {
                $error['address'] = 'L\'adresse n\'est pas conforme.';
            }
        }
        
    // Nettoyage et validation du code postale.
        // Nettoyage
        $zipCode = filter_input(INPUT_POST, 'zipCode', FILTER_SANITIZE_NUMBER_INT);
        // Validation
        if (empty($zipCode)) {
            $error['zipCode'] = 'Le code postale est obligatoire.'; 
        } else {
            $isOk = filter_var($zipCode, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_FOR_ZIPCODE . '/')));
            if ($isOk == false) {
                $error['zipCode'] = 'Le code postale n\'est pas conforme.';
            }
        }        
        
    // Nettoyage et validation de l'e-mail.
        // Nettoyage 
        $mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
        if (Patient::exist($mail) == true && $mail != $patient->mail) {
            header('Location: /controllers/addPatientController.php');
            exit();
        }
        Patient::exist($mail);
        // Validation
        if (empty($mail)) {
            $error['email'] = 'Le mail est obligatoire.';
        } else {
            $isOk = filter_var($mail, FILTER_VALIDATE_EMAIL);
            if ($isOk == false) {
                $error['email'] = 'Le mail n\'est pas conforme.';
            }
        }
        
    // Nettoyage et validation du numéros de téléphone.
        // Nettoyage 
        $phoneNumber = trim(filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_SPECIAL_CHARS));
        // Validation
        if (empty($phoneNumber)) {
            $error['phoneNumber'] = 'Le numéros de téléphone est obligatoire.';
        } else {
            $isOk = filter_var($phoneNumber, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_FOR_PHONENUMBER . '/')));
            if ($isOk == false) {
                $error['phoneNumber'] = 'Le numéros de téléphone n\'est pas conforme.';
            }
        }
    
    if (empty($error)) {
            
        $updatedPatient = new Patient;
        $updatedPatient->setLastName($lastname);
        $updatedPatient->setFirstName($firstname);
        $updatedPatient->setDateOfBirth($dateOfBirth);
        $updatedPatient->setPhoneNumber($phoneNumber);
        $updatedPatient->setMail($mail);
        $updatedPatient->setSocialSecureCode($socialSecureCode);
        $updatedPatient->setGender($gender);
        $updatedPatient->setAddress($address);
        $updatedPatient->setZipCode($zipCode);
        $updatedPatient->setId($id);

        $isUpdatedPatient = $updatedPatient->modify();
        if ($isUpdatedPatient == true) {
            $updateMessage = 'Données mises à jour';
            $patient = Patient::displayOne($id);
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
include(__DIR__ . '/../views/modifyPatient.php');
include(__DIR__ . '/../views/templates/footer.php');