<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

$dluoRouge = getAlerteN0Dluo($pdo, $date_Sys);
$nbRouge = count($dluoRouge);
$dluoOrange = getAlerteN1Dluo($pdo, $date_Sys);
$nbOrange = count($dluoOrange);
$dluoVert = getAlerteN2Dluo($pdo, $date_Sys);
$nbVert = count($dluoVert);


?>


<section>

    <article class="d-flex flex-column justify-content-center px-3">
        <h2 class="text-center mb-5">DLUO :</h2>
        <?php
        if ($nbVert > 0) { ?>
            <a class="btn btn-success btn-lg mb-4" href="alertes.php?alerte=verte"><?= $nbVert; ?> => 90 Jours </a>
            <?php
            ?>
        <?php
        } else { ?>
            <a class="btn disabled btn-lg mb-4" href="#"><?= $nbVert; ?> => 90 Jours </a>
        <?php
        }
        if ($nbOrange > 0) { ?>

            <a class="btn btn-warning btn-lg mb-4" href="alertes.php?alerte=orange"><?= $nbOrange; ?> => 60 Jours </a>
        <?php
        } else { ?>
            <a class="btn disabled btn-lg mb-4" href="#"><?= $nbOrange; ?> => 60 Jours </a>
        <?php
        }
        if ($nbRouge > 0) { ?>
            <a class="btn btn-danger btn-lg mb-4" href="alertes.php?alerte=rouge"><?= $nbRouge; ?> => 30 Jours </a>

        <?php
        } else { ?>
            <a class="btn disabled btn-lg mb-4" href="#"><?= $nbRouge; ?> => 30 Jours </a>
        <?php

        }

        ?>
    </article>
    
    <div class="container-fluid d-flex flex-column">
        <h2 class="mb-3 text-center">Autres actions :</h2>
        <a class="btn btn-outline-secondary btn-lg mb-4" href="addItem.php">Nouvelle entrée</a>
        <a class="btn btn-outline-secondary btn-lg mb-4" href="listdluo.php">Rechercher</a>
    </div>

</section>
</body>

</html>

<script>
    let liElemMenu = document.getElementById('li_dluo');
    let aElementMenu = document.getElementById('a_dluo');
    aElementMenu.classList += " text-white";
    liElemMenu.classList += " bg-dark rounded-top-3";
</script>