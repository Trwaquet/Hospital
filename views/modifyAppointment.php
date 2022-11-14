<div class="containerAppointment">
    <form method="post" class="appointmentForm">
        <p>Ajouter un nouveau rendez-vous</p>
        <label for="">Patient :
            <span><?= $updateMessage ?? '' ;?></span>
            <input type="hidden" name="patients" value="<?= $appointments->idPatients ; ?>">
            <select disabled>
                <option value="">
                    <?= $appointments->lastname . ' ' . $appointments->firstname ;?>
                </option>
            </select>
        </label>
        <label for="">Date :
            <span></span>
            <input type="date" name="date" value="<?= date("Y-m-d", strtotime($appointments->dateHour)) ;?>" required>
        </label>
        <label for="">Heure :
            <span></span>
            <select name="time">
                <option value=""><?= date("H:i", strtotime($appointments->dateHour)) ;?></option>
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