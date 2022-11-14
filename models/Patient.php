<?php

require_once(__DIR__ . '/../helpers/database.php');

// Class gérant la fiche patient.
class Patient{
    
    // Attribut de la class Patient.    
        private int $_id;
        private string $_lastname;
        private string $_firstname;
        private string $_dateOfBirth;
        private string $_phoneNumber;
        private string $_mail;
        private int $_socialSecureCode;
        private int $_gender;
        private string $_address;
        private string $_zipCode;

    // Fonction construct.
        public function __construct(){

        }

    // Get & Set.
        // Récupère la valeur de l'Id.
        public function getId():int {
            return $this->_id;
        }
        // Hydrate (définis) la valeur d'Id.
        public function setId(int $id):void {
            $this->_id = $id;
        }

        // Récupère la valeur de lastname.
        public function getLastname():string{
            return $this->_lastname;
        }
        // Hydrate (définis) la valeur de lastname.
        public function setLastname(string $lastname):void{
            $this->_lastname = $lastname;
        }

        // Récupère la valeur de firstname.
        public function getFirstname():string{
            return $this->_firstname;
        }
        // Hydrate (définis) la valeur de firstname.
        public function setFirstname(string $firstname):void{
            $this->_firstname = $firstname;
        }

        // Récupère la valeur de dateOfBirth.
        public function getDateOfBirth():string{
            return $this->_dateOfBirth;
        }
        // Hydrate (définis) la valeur de dateOfBirth.
        public function setDateOfBirth(string $dateOfBirth):void{
            $this->_dateOfBirth = $dateOfBirth;
        }

        // Récupère la valeur de phoneNumber.
        public function getPhoneNumber():string{
            return $this->_phoneNumber;
        }
        // Hydrate (définis) la valeur de phoneNumber.
        public function setPhoneNumber(string $phoneNumber):void{
            $this->_phoneNumber = $phoneNumber;
        }

        // Récupère la valeur de mail.
        public function getMail():string{
            return $this->_mail;
        }
        // Hydrate (définis) la valeur de mail.
        public function setMail(string $mail):void{
            $this->_mail = $mail;
        }

        // Récupère la valeur de socialSecureCode.
        public function getSocialSecureCode():string{
            return $this->_socialSecureCode;
        }
        // Hydrate (définis) la valeur de socialSecureCode.
        public function setSocialSecureCode(string $socialSecureCode):void{
            $this->_socialSecureCode = $socialSecureCode;
        }

        // Récupère la valeur de gender.
        public function getGender():string{
            return $this->_gender;
        }
        // Hydrate (définis) la valeur de gender.
        public function setGender(string $gender):void{
            $this->_gender = $gender;
        }

        // Récupère la valeur de address.
        public function getAddress():string{
            return $this->_address;
        }
        // Hydrate (définis) la valeur de address.
        public function setAddress(string $address):void{
            $this->_address = $address;
        }

        // Récupère la valeur de zipCode.
        public function getZipCode():string{
            return $this->_zipCode;
        }
        // Hydrate (définis) la valeur de zipCode.
        public function setZipCode(string $zipCode):void{
            $this->_zipCode = $zipCode;
        }

    // Méthode d'ajout de patient.
        public function add(){

        // Ecriture de la requête.
            $sql = 'INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`, `socialSecureCode`, `gender`, `address`, `zipCode`) VALUES (:lastname, :firstname, :dateOfBirth, :phoneNumber, :mail, :socialSecureCode, :gender, :address, :zipCode);';

        // Préparation.
            $pdo = Database::getInstance();
            $sth = $pdo->prepare($sql);

        // Affectation des valeurs au marqueur nommé.
            $sth->bindValue(':lastname', $this->getLastname());
            $sth->bindValue(':firstname', $this->getFirstname());
            $sth->bindValue(':dateOfBirth', $this->getDateOfBirth());
            $sth->bindValue(':phoneNumber', $this->getPhoneNumber());
            $sth->bindValue(':mail', $this->getMail());
            $sth->bindValue(':socialSecureCode', $this->getSocialSecureCode(), PDO::PARAM_INT);
            $sth->bindValue(':gender', $this->getGender(), PDO::PARAM_INT);
            $sth->bindValue(':address', $this->getAddress());
            $sth->bindValue(':zipCode', $this->getZipCode());

        // Exécution, les données sont envoyés en base de données.            
            return $sth->execute();
        
        }

    // Méthode d'ajout de patient que s'il n'existe pas.
        public static function exist(string $mail){
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare('SELECT * FROM `patients` WHERE `mail` = :mail;');
            $stmt->bindValue(':mail', $mail);
            $stmt->execute();
            if($stmt->fetch() == false){
                return false;
            } else {
                return true;
            }
        }

    // Méthode pour afficher tout les patients avec une barre de recherche.
        public static function displayAll($search = ''){
            if (empty($search)) {
                $sql = 'SELECT * FROM `patients`;';
                $sth = Database::getInstance()->query($sql);
                    $patients = $sth->fetchAll(PDO::FETCH_OBJ);
                    return $patients;
            } else {
                $sql = 'SELECT * FROM `patients` 
                WHERE `lastname` = :search 
                OR `firstname` = :search 
                OR `birthdate` = :search 
                OR `phone` = :search 
                OR `mail` = :search 
                OR `socialSecureCode` = :search;';
                $sth = Database::getInstance()->prepare($sql);
                $sth->bindValue(':search', $search);
                if ($sth->execute()) {
                    $patients = $sth->fetchAll(PDO::FETCH_OBJ);
                    return $patients;
                }    
            }
        }

    // Méthode pour calculé le nombre de patients par page.
        public static function count(){
            $sql = 'SELECT COUNT(*) FROM `patients`;';
            $sth = Database::getInstance()->query($sql);
            $count = $sth->fetchColumn();
            return $count;
        }

    // Méthode pour calculé le nombre de page.
        public static function pagination($limit, $offset){
            $sql = 'SELECT * FROM `patients` LIMIT :limit OFFSET :offset;';
            $sth = Database::getInstance()->prepare($sql);
            $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
            $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
            $sth->execute();
            $patients = $sth->fetchAll(PDO::FETCH_OBJ);
            return $patients;
        }

    // Méthode pour afficher un seul patient.
        public static function displayOne($id){
            $sth = Database::getInstance()->prepare('SELECT * FROM `patients` WHERE `id` = :id;');
            $sth -> bindValue(':id', $id);
            $sth->execute();
            return $sth->fetch(PDO::FETCH_OBJ);
        } 

    // Méthode pour modifier le profil du patient.
        public function modify(){
            $modifyPatient = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname,`birthdate` = :birthdate, `phone` = :phone, `mail` = :mail,  `socialSecureCode` = :socialSecureCode, `gender` = :gender, `address` = :addr, `zipCode` = :zipCode WHERE `id` = :id ;';  
            
            $sth = Database::getInstance()->prepare($modifyPatient);

            $sth->bindValue(':lastname', $this->getLastName());
            $sth->bindValue(':firstname', $this->getFirstName());
            $sth->bindValue(':birthdate', $this->getDateOfBirth());
            $sth->bindValue(':phone', $this->getPhoneNumber());
            $sth->bindValue(':mail', $this->getMail());
            $sth->bindValue(':socialSecureCode', $this->getSocialSecureCode(), PDO::PARAM_INT);
            $sth->bindValue(':gender', $this->getGender(), PDO::PARAM_INT);
            $sth->bindValue(':addr', $this->getAddress());
            $sth->bindValue(':zipCode', $this->getZipCode());
            $sth->bindValue(':id', $this->getId(), PDO::PARAM_INT);

            if ($sth->execute()){
                $result = $sth->rowCount();
                return ($result >= 1) ? true : false ; 
            };
            
        } 

    // Méthode pour supprimer un patient avec ses rendez-vous.
        public static function delete(int $id){
            $sql = 'DELETE FROM `patients` WHERE `patients`.`id` = :id';
            $sth = Database::getInstance()->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            if ($sth->execute()){
                $result = $sth->rowCount();
                return ($result >= 1) ? true : false ;
            }
        }
}