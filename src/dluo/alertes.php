<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    traiteDluo($pdo, $id);
}
?>
<section id="listDluoAlerte">
    <?php
    $alerte = $_GET['alerte'];
    switch ($alerte) {
        case 'verte':
            $dluoVert = getAlerteN2Dluo($pdo, $date_Sys);
            if (count($dluoVert) > 0) {
                foreach ($dluoVert as $key => $value) { ?>
                    <form class="itemDluo" method="post" action="#">
                        <div class="card pb-3">
                            <h2 class="card-title bg-success text-white p-3 text-uppercase"><?= $dluoVert[$key]['reference']; ?></h2>
                            <div class="card-body fs-5">
                                <p style="display: none;"><input name="id" type="text" value="<?= $dluoVert[$key]['id']; ?>"></p>
                                <p>Lot numéro : <?= $dluoVert[$key]['numLot']; ?></p>
                                <p>Zone de stock : <?= $dluoVert[$key]['zone']; ?></p>
                                <p>DLUO : <?= $dluoVert[$key]['dluo']; ?></p>
                                <button type="submit" class="btn btn-primary">TRAITER</button>
                            </div>
                        </div>
                    </form>
                <?php
                }
            }
            break;
        case 'orange':
            $dluoOrange = getAlerteN1Dluo($pdo, $date_Sys);

            if (count($dluoOrange) > 0) {
                foreach ($dluoOrange as $key => $value) { ?>

                    <form class="itemDluo" method="post" action="#">
                        <div class="card pb-3">
                            <h2 class="card-title bg-warning p-3 text-uppercase"><?= $dluoOrange[$key]['reference']; ?></h2>
                            <div class="card-body fs-5">
                                <p style="display: none;"><input name="id" type="text" value="<?= $dluoOrange[$key]['id']; ?>"></p>
                                <p>Lot numéro : <?= $dluoOrange[$key]['numLot']; ?></p>
                                <p>Zone de stock : <?= $dluoOrange[$key]['zone']; ?></p>
                                <p>DLUO : <?= $dluoOrange[$key]['dluo']; ?></p>
                                <button type="submit" class="btn btn-primary">TRAITER</button>
                            </div>
                        </div>
                    </form>

                <?php
                }
            }
            break;
        case 'rouge':
            $dluoRouge = getAlerteN0Dluo($pdo, $date_Sys);
            if (count($dluoRouge) > 0) {
                foreach ($dluoRouge as $key => $value) { ?>

                    <form class="itemDluo" method="post" action="#">
                        <div class="card pb-3">
                            <h2 class="card-title bg-danger text-white p-3 text-uppercase"><?= $dluoRouge[$key]['reference']; ?></h2>
                            <div class="card-body fs-5">
                                <p style="display: none;"><input name="id" type="text" value="<?= $dluoRouge[$key]['id']; ?>"></p>
                                <p>Lot numéro : <?= $dluoRouge[$key]['numLot']; ?></p>
                                <p>Zone de stock : <?= $dluoRouge[$key]['zone']; ?></p>
                                <p>DLUO : <?= $dluoRouge[$key]['dluo']; ?></p>
                                <button type="submit" class="btn btn-primary">TRAITER</button>
                            </div>
                        </div>
                    </form>

    <?php
                }
            }
            break;

        default:
            # code...
            break;
    }

    ?>
</section>

<script>
    function alerte() {
        alert("je fais rien pour le moment")
    }
</script>
</body>

</html>