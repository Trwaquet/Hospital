<div class="containerAppointment">
    <form method="post" class="appointmentForm">
        <p>Ajouter un nouveau rendez-vous</p>
        <label for="">Patient :
            <span></span>
            <select name="patients">
                <option>Choisissez un patient</option>
            <?php
                foreach ($patients as $patient) { 
            ?>
                <option value="<?= $patient->id ; ?>">
                    <?= $patient->lastname . ' ' . $patient->firstname ;?>
                </option>
            <?php } ?>
            </select>
        </label>
        <label for="">Date :
            <span></span>
            <input type="date" name="date" required>
        </label>
        <label for="">Heure :
            <span></span>
            <select name="time">
                <option>Choisissez un créneaux</option>
                <option value="1">09:00</option>
                <option value="2">10:00</option>
                <option value="3">11:00</option>
                <option value="4">14:00</option>
                <option value="5">15:00</option>
                <option value="6">16:00</option>
            </select>
        </label>
        <button type="submit">Comfirmer</button>
    </form>
</div>