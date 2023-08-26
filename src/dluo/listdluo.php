<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');


if (isset($_POST['rechercheRef'])) {
    $recherche = $_POST['rechercheRef'];
    $listDluo = searchRefDluo($pdo, $recherche);
} else {
    $listDluo = getAllDluo($pdo);
}

?>

<section class="container-fluid">


    <form action="" method="post" class="mb-5">
        <div class="input-group">
            <input type="text" name="rechercheRef" class="form-control fs-1 " placeholder="Rechercher">
            <button class="btn btn-primary btn-lg" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
        </div>
    </form>
    
    <div class="row">
        <?php
        foreach ($listDluo as $article) {
            $firstAlerte = dateToStringInFrench($article['alerteNiveau2']);

        ?>

        <div class="col-12 col-md-6 col-lg-4 shadow-lg mb-4">
            <div class="card pb-3">
                <h2 class="card-title bg-dark text-white p-3"><?= $article['reference']; ?></h2>
                <div class="card-body fs-5">
                    <p>Zone : <?= $article['zone']; ?></p>
                    <p>Lot : <?= $article['numLot']; ?></p>
                    <p>DLUO : <?= $article['dluo']; ?></p>
                    <p>Première alerte le :<?= $firstAlerte; ?></p>
                    <a class="btn btn-primary" href="traite.php?id=<?= $article['id']; ?>">STOCK VIDE</a>
                </div>
            </div>
        </div>
    

    <?php
    }
    ?>
    </div>
</section>