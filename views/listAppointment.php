<div class="containerListPatient">
    <div class="listPatient">
    <?php if(SessionFlash::exist()){ ?>
        <?= SessionFlash::get(); ?>
        <?php } ?>
    <table>
        <thead>
            <p>Rendez-vous</p>
            <tr>
                <th></th>
                <th>Heure</th>
                <th>Date</th>
                <th>Patient</th>
                <th>Téléphone</th>
                <th>Adresse Mail</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($appointments as $appointment) { 
            ?>
            <tr>
                <td><a href="/controllers/profilAppointmentController.php?id=<?= $appointment->id ;?>">Voir le rendez-vous</a></td>
                <td><?= date("H:i", strtotime($appointment->dateHour)) ?></td>
                <td><?= date("d/m/Y", strtotime($appointment->dateHour)) ?></td>
                <td><?= $appointment->lastname . ' ' . $appointment->firstname ?></td>
                <td><?= $appointment->phone ?></td>
                <td><?= $appointment->mail ?></td>
                <td><a href="/controllers/suppAppointmentController.php?id=<?= $appointment->id ;?>" class="btnSupp">Supprimer</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</div>