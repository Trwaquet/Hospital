<?php

session_start();
require_once(__DIR__ . '/../helpers/SessionFlash.php');

define('DSN', 'mysql:host=localhost;dbname=hospitale2n;charset=utf8');
define('USER', 'Ziguzi');
define('PWD', 'shgcRRN0MUy8h3qm');

// Définition des regex.
    // Regex pour le nom et prénom.
    define('REGEX_FOR_NAME', "^[a-zA-ZÀ-ÿ '-]+$");

    // Regex pour le numéro de sécuriter sociale.
    define('REGEX_FOR_SOCIALECODE', "[1-2][0-9]{2}(0[1-9]|1[0-2])(2[AB]|[0-9]{2})[0-9]{3}[0-9]{3}([0-9]{2})");

    // Regex pout les dates.
    define('REGEX_FOR_DATE', "^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$");

    // Regex pour l'adresse.
    define('REGEX_FOR_ADDRESS', "\d+[ ](?:[A-Za-z0-9.-]+[ ]?)+");
    
    // Regex pour le code postale.
    define('REGEX_FOR_ZIPCODE', "^[0-9]{5}$");
    
    // Regex Pour l'e-mail.
    define('REGEX_FOR_EMAIL', "^[a-zA-Z0-9\._-]+@[a-z0-9\.-]+\.[a-z]{2,}$");
    
    // Regex pour le numéros de téléphone.
    define('REGEX_FOR_PHONENUMBER', "^(0|\+33)[1-9]([-. ]?[0-9]{2}){4}$");