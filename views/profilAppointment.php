<div class="containerProfilPatient">
    <div class="profilPatient">
        <div class="titleProfilPatient">
            <p>Information sur le Rendez-vous</p>
            <span class="btnModifSup">
                <button><a href="/controllers/modifyAppointmentController.php?id=<?= $appointments->appId ?>">Modifier</a></button>
            </span>
        </div>
        <div class="infosPatient">
            <p><span>Patient : </span><?= $appointments->lastname . ' ' . $appointments->firstname ; ?></p>
            <p><span>Heure : </span><?= date("H:i", strtotime($appointments->dateHour)); ?></p>
            <p><span>Date : </span><?= date("d/m/Y", strtotime($appointments->dateHour)); ?></p>
        </div>
    </div>
</div>