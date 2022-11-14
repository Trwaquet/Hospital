<?php

require_once(__DIR__ . '/../helpers/database.php');

// Class gérant les rendez-vous.
class Appointment {

    // Attribut de la class Appointment.
        private int $_id;
        private string $_dateHour;
        private int $_idPatients;

    // Fonction construct.
        public function __construct(string $dateHour, int $idPatients){
            $this->pdo = Database::getInstance();
            $this->_dateHour = $dateHour;
            $this->_idPatients = $idPatients;
        }

    // Get & Set.
        // Recupére la valeur de l'id.
        public function getId():int {
            return $this->_id;
        }
        // Hydrate (définis) la valeur d'Id.
        public function setId(int $id):void {
            $this->_id = $id;
        }

        // Recupére la valeur de dateHour.
        public function getDateHour():string{
            return $this->_dateHour;
        }
        // Hydrate (definis) la valeur de dateHour.
        public function setDateHour(string $dateHour):void{
            $this->_dateHour = $dateHour;
        }

        // Recupére la valeur de idPatients.
        public function getIdPatients():string{
            return $this->_idPatients;
        }
        // Hydrate (definis) la valeur de idPatients.
        public function setIdPatients(string $idPatients):void{
            $this->_idPatients = $idPatients;
        }

    // Méthode d'ajout de rendez-vous.
        public function add(){

        // Ecriture de la requête.
            $myRequest = 'INSERT INTO `appointments`(`dateHour`, `idPatients`) VALUE (:dateHour, :idPatients);';

        // Préparation.
            $myRequest = $this->pdo->prepare($myRequest);

        // Affectation des valeurs au marqueur nommé.
            $myRequest->bindValue(':dateHour', $this->getDateHour());
            $myRequest->bindValue(':idPatients', $this->getIdPatients(), PDO::PARAM_INT);
    
        // Exécution, les données sont envoyés en base de données.            
            if($myRequest->execute()){
                return ($myRequest->rowCount() >= 1) ? true : false ;
            }
    
        }

    // Méthode pour afficher tout les appointments.
        public static function displayAll(){
            $sql = 'SELECT `appointments`.id, `appointments`.dateHour, `patients`.lastname, `patients`.firstname, `patients`.phone, `patients`.mail FROM `appointments` INNER JOIN `patients` ON `appointments`.idPatients = `patients`.id ORDER BY `appointments`.`dateHour`;';
            $sth = Database::getInstance()->query($sql);
            $appointments = $sth->fetchAll(PDO::FETCH_OBJ);
            return $appointments;
        }

    // Méthode pour afficher les infos sur un rendez-vous.
        public static function displayOne(int $id){
            $sth = Database::getInstance()->prepare(' SELECT `appointments`.`id` AS appId, `appointments`.`idPatients`, `appointments`.`dateHour`, `patients`.`lastname`, `patients`.`firstname`, `patients`.`id` AS patId FROM `appointments` 
            INNER JOIN `patients` 
            ON `appointments`.`idPatients` = `patients`.`id` 
            WHERE `appointments`.`id` = :id;');
            $sth -> bindValue(':id', $id, PDO::PARAM_INT);
            if($sth->execute()){
                return $sth->fetch(PDO::FETCH_OBJ);
            }
        } 

    // Méthode pour afficher les appointments d'un patient.
        public static function displayAllForPatient(int $id){
            $sth = Database::getInstance()->prepare('SELECT `dateHour` FROM `appointments` INNER JOIN `patients` ON `appointments`.idPatients = `patients`.id WHERE `patients`.`id` = :id ORDER BY `dateHour`;');
            $sth->bindValue(':id', $id);
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_OBJ);
        }
    
    // Méthode pour modifier un rendez-vous.
        public function modify($id = ''){
            $sql = 'UPDATE `appointments` SET `dateHour` = :dateHour, `idPatients`=:idPatients WHERE `appointments`.`id` = :id;';
            
            $sth = Database::getInstance()->prepare($sql);

            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            $sth->bindValue(':dateHour', $this->getDateHour());
            $sth->bindValue(':idPatients', $this->getIdPatients(), PDO::PARAM_INT);

            if ($sth->execute()){
                $result = $sth->rowCount();
                return ($result >= 1) ? true : false ;
            }
        }

    // Méthode pour supprimer un rendez-vous.
        public static function delete(int $id){
            $sql = 'DELETE FROM `appointments` WHERE `id` = :id';
            $sth = Database::getInstance()->prepare($sql);
            $sth->bindValue(':id', $id, PDO::PARAM_INT);
            if ($sth->execute()){
                if($sth = $sth->rowCount() == 1){
                    return true;
                }
                
            }
            return false;
        }

}