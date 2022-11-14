<div class="containerListPatient">
    <div class="listPatient">
        <?php if (SessionFlash::exist()) { ?>
            <?= SessionFlash::get(); ?>
        <?php } ?>
        <p>Patients</p>
        <form method="get" class="search">
            <input type="text" class="liveSearch" name="search">
            <button type="submit"><img src="/public/assets/img/chercher.png" alt=""></button>
        </form>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Genre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($patients as $patient) {
                    if ($patient->gender == 1) {
                        $gender = 'Homme';
                    } else {
                        $gender = 'Femme';
                    } ?>
                    <tr>
                        <td><a href="/controllers/profilPatientController.php?id=<?= $patient->id; ?>">Voir le patient</a></td>
                        <td><?= $patient->lastname ?></td>
                        <td><?= $patient->firstname ?></td>
                        <td><?= date("d/m/Y", strtotime($patient->birthdate)) ?></td>
                        <td><?= $gender ?></td>
                        <td><a href="/controllers/suppPatientController.php?id=<?= $patient->id; ?>" class="btnSupp">Supprimer</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>