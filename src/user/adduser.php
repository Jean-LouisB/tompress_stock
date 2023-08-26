<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

if(isset($_POST['userNameInput'])){
    $username = $_POST['userNameInput'];
    $userPass = $_POST['userPass'];
    newUser($pdo,$username,$userPass);
}


?>
<section>
    <form action="adduser.php" method="post">
        <div>
            <label for="userNameInput">identifiant du nouvel utilisateur :</label>
            <input type="text" placeholder="identifiant" id="userNameInput" name="userNameInput">
        </div>
        <div>
            <label for="userPass">Créez un mot de passe:</label>
            <input type="password" placeholder="Mot de passe" id="userPass" name="userPass" minlength=8 required pattern="[A-Za-z0-9]{8,}">
            <p>Mélangez majuscules, minuscules, chiffres sur 8 caractères minimum.</p>
        </div>
        <p>Le mot de passe iniital est créé par l'administrateur puis l'utilisateur est invité à le personnaliser.</p>
        <div>
            <button type="submit">VALIDER</button>
        </div>
    </form>
</section>