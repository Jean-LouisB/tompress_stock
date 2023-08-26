<?php

include('includes/header.php');
include('includes/function-pdo.php');
echo test;
if (count($_POST) > 0) {
    $userName = Strip_tags($_POST['userName']);
    $userPassword = $_POST['passwordUser'];
    if (isValid($pdo, $userName, $userPassword)) {
        $_SESSION['userName'] = $_POST['userName'];
        if(getUserRight($pdo,$userName) == 3){
            $_SESSION['droit'] = true;
        }
        unset($_POST);
        $logFile = 'logfile.txt';
        $now = date('Y-m-d H:i:s');
        $nowFrench = dateToStringInFrench($now);
        $fileHandle = fopen($logFile, 'a') or die("Impossible d'ouvrir le fichier de log.");
        $logMessage = "Le " . $nowFrench . " " . $userName . " s'est connecté - Temps précis (GMT): " . $now;
        fwrite($fileHandle, $logMessage . PHP_EOL);
        fclose($fileHandle);
        header('Location:/src/index.php');
    } else { ?>

        <section class="container-fluid vh-100 d-flex align-items-center justify-content-center"> <!-- couleur de fond à supprimer -->
            <div class="row w-100">
                <form class="col-12" id="formConnect" action="index.php" method="post" autocomplete="off">
                    <h1 class="text-center mb-5">Connexion échouée, recommencez.</h1>
                    <div class="form-floating mb-3">
                        <input name="userName" id="userName" class="form-control" placeholder="Identifiant">
                        <label id="labelMatricule" for="userName">Identifiant</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input required type="password" name="passwordUser" class="form-control" id="passwordUser" placeholder="Mot de passe">
                        <label id="labelPsw" for="exampleInputPassword1">Mot de passe</label>

                    </div>
                    <button type="submit" class="btn btn-primary w-100 btn-lg">CONNEXION</button>
                </form>
            </div>
        </section>
        <div>

        </div>
    <?php
    }
} else { ?>

    <section class="container-fluid vh-100 d-flex align-items-center justify-content-center"> <!-- couleur de fond à supprimer -->
        <div class="row w-100">
            <form class="col-12" id="formConnect" action="index.php" method="post" autocomplete="off">
                <h1 class="text-center mb-5">Connexion</h1>
                <div class="form-floating mb-3">
                    <input name="userName" id="userName" class="form-control" placeholder="Identifiant">
                    <label id="labelMatricule" for="userName">Identifiant</label>
                </div>
                <div class="form-floating mb-4">
                    <input required type="password" name="passwordUser" class="form-control" id="passwordUser" placeholder="Mot de passe">
                    <label id="labelPsw" for="exampleInputPassword1">Mot de passe</label>

                </div>
                <button type="submit" class="btn btn-primary w-100 btn-lg">CONNEXION</button>
            </form>
        </div>
    </section>
    </body>

    </html>

<?php
}
?>