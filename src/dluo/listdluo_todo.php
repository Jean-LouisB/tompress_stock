<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

if (isset($_POST['refArticle'])) {

    $post = $_POST;
    $dluo = date('Y-m-d', strtotime($_POST['dluo']));
    if($_POST['num_de_lot'] != ""){
        addItemDluo($pdo, $_POST['refArticle'], $_POST['zone'], $_POST['num_de_lot'], $dluo, $date_Sys, $niveau0, $niveau1, $niveau2);
        
    }
    if (isset($_POST['checkToDo']) && $_POST['checkToDo'] == "on") {
        
        function checkAddedRef($pdo, $refArticle)
        {
            $stm = $pdo->prepare("UPDATE to_complete SET added=1 where ref_article = ?");
            $stm->bindvalue(1, $refArticle);
            $stm->execute();
            $rows = $stm->fetchALL(PDO::FETCH_ASSOC);
            return $rows;
        }
        checkAddedRef($pdo, $_POST['refArticle']);
    }
    unset($_POST);
}



$listDluo = getDluoToDo($pdo);
//var_dump($listDluo);
$nbItem = count($listDluo);

?>

<section class="container-fluid mt-120">
    <p class="h2 text-danger">Il reste <?= $nbItem; ?> articles à traiter.</p>

    <div class="row">

        <?php
        /*     var_dump($post); */

        foreach ($listDluo as $article) {

        ?>

            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <form action="#" method="post">
                    <div class="card pb-3">
                        <input class="card-title bg-dark text-white p-3 text-uppercase h2" name="refArticle" id="refArticle" value="<?= $article['ref_article']; ?>">
                        <div class="card-body fs-5">
                            <input class="input border-0 text-center w-100 fs-3 mb-3" type="text" readonly name="zone" id="zone" value="<?= $article['zone']; ?>">
                            <p><?= $article['designation']; ?></p>
                            <div class="form-group mb-3">
                                <input class="form-control fs-3 mb-3" type="text" placeholder="Numéro de lot" name="num_de_lot" id="num_de_lot">
                                <input class="form-control fs-3" type="date" name="dluo" id="dluo">
                            </div>
                            <div class="d-flex flex-column justify-content-center align-item-center">
                                <button type="submit" class="btn btn-primary btn-lg d-flex align-item-center justify-content-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 20 20">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                </button>
                                
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="checkToDo" id="checkToDo" type="checkbox" value="on">
                                        Dernier lot
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>



        <?php
        }
        ?>
    </div>
</section>
<script>
    let liElemMenu = document.getElementById('li_dluotodo');
    let aElementMenu = document.getElementById('a_dluotodo');
    aElementMenu.classList += " text-white";
    liElemMenu.classList += " bg-dark rounded-top-3";
</script>