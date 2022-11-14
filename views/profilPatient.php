<?php
    if ($patients->gender == 1) {
        $gender = 'Homme';
    } else {
        $gender = 'Femme';
    } 
?>
<div class="containerProfilPatient">
    <div class="profilPatient">
        <div class="titleProfilPatient">
            <p>Information sur le Patient</p>
            <span><?= $patients->lastname; ?> <?= $patients->firstname; ?></span>
            <span class="btnModifSup">
                <button><a href="/controllers/modifyPatientController.php?id=<?= $patients->id ;?>">Modifier</a></button>
            </span>
        </div>
        <div class="infosPatient">
            <p><span>Genre : </span><?= $gender; ?></p>
            <p><span>Num sécurité sociale : </span><?= $patients->socialSecureCode ?></p>
            <p><span>Date de naissance : </span><?= date("d/m/Y", strtotime($patients->birthdate)); ?></p>
            <p><span>Adresse : </span><?= $patients->address ?></p>
            <p><span>Code postal : </span><?= $patients->zipCode ?></p>
            <p><span>Adresse mail : </span><?= $patients->mail ?></p>
            <p><span>Téléphone : </span><?= $patients->phone ?></p>
            <?php
                foreach ($appointments as $appointment){
            ?>     
               <p><span>Rendez-vous : </span><?= date("d/m/Y H:i", strtotime($appointment->dateHour)); ?></p>
            <?php } ?>
        </div>
        
    </div>
</div>