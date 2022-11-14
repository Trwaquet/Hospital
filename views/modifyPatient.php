<div class="containerForm">
    <form method="post" class="addUserForm">
            <p>Modifier une fiche patient</p>
            <span><?= $updateMessage ?? '' ?></span>
        <label for="">Nom :
            <span><?= $error['lastname'] ?? '' ;?></span>
            <input type="text" name="lastname" pattern="<?= REGEX_FOR_NAME ?>" placeholder="ex : Waquet" value="<?= $patient->lastname ; ?>" required>
        </label>

        <label for="">Prénom :
            <span><?= $error['firstname'] ?? '' ;?></span>
            <input type="text" name="firstname" pattern="<?= REGEX_FOR_NAME ?>" placeholder="ex : Tristan" value="<?= $patient->firstname ; ?>" required>
        </label>

        <div class="checkboxGender">
            <span class="spanGender"><?= $error['gender'] ?? '' ;?></span>
            <label for="male">
                Homme
                <input type="radio" name="gender[]" value="1">
            </label>

            <label for="woman">
                Femme
                <input type="radio" name="gender[]" value="2">
            </label>
        </div>

        <label for="">Numéros Sécuriter Sociale :
            <span><?= $error['socialSecureCode'] ?? '' ;?></span>
        <input type="number" name="socialSecureCode" pattern="<?= REGEX_FOR_SOCIALECODE ?>" placeholder="0 00 00 00 000 000 00" value="<?= $patient->socialSecureCode ; ?>" required>
        </label>

        <label for="">Date De Naissance :
            <span><?= $error['dateOfBirth'] ?? '' ;?></span>
        <input type="date" name="dateOfBirth" value="<?= $patient->birthdate ; ?>" required>
        </label>

        <label for="">Adresse :
            <span><?= $error['address'] ?? '' ;?></span>
        <input type="text" name="address" pattern="<?= REGEX_FOR_ADDRESS ?>" placeholder="ex : 000 ma rue" value="<?= $patient->address ; ?>" required>
        </label>

        <label for="">Code Postale :
            <span><?= $error['zipCode'] ?? '' ;?></span>
        <input type="text" name="zipCode" pattern="<?= REGEX_FOR_ZIPCODE ?>" placeholder="ex : 00000" value="<?= $patient->zipCode ; ?>" required>
        </label>

        <label for="">Adresse Mail :
            <span><?= $error['mail'] ?? '' ;?></span>
        <input type="email" name="mail" placeholder="ex : Exemple@exemple.fr" value="<?= $patient->mail ; ?>" required>
        </label>

        <label for="">Téléphone :
            <span><?= $error['phoneNumber'] ?? '' ;?></span>
            <input type="text" name="phoneNumber" pattern="<?= REGEX_FOR_PHONENUMBER ?>" placeholder="ex : 0000000000" value="<?= $patient->phone ; ?>" required>
        </label>
        <button type="submit">Confirmer</button>
    </form>
</div>