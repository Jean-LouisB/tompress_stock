<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');


if (isset($_POST['refArticle']) || isset($_GET['article'])) {


  $refArticle = isset($_POST['refArticle']) ? $_POST['refArticle'] : $_GET['article']; // récupère la référence saisie ou scannée par l'utilisateur dans le formuulaire.
  $stockDeLArticle = detailArticle($refArticle, $pdo); //cette fonction récupère le détail des stocks par emplacement de l'article voulu.
  $detailMouvements = getMouvements($refArticle, $pdo); //cette fonction récupère le détail des mouvements de l'article.

?>
  <section>
    <div>
      <div>
        <a href="ajoute.php" class="link d-flex justify-content-center mt-3" style="text-decoration:none;"><button class="btn btn-danger btn-lg">ajouter
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
              <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z" />
            </svg>
          </button></a>
      </div>
      <hr class="m-5">
      <form action="index.php" class="m-3" method="post">
        <div class="input-group">
          <input class="form-control" type="text" name="refArticle" autocomplete="off">
          <button type="submit" class="btn btn-success btn-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
          </button>
        </div>
      </form>

    </div>
    <hr class="m-3">
    <table class="table table-striped table-hover table-sm">
      <p class="h3 text-center">Détail des stocks de la référence <span class="text-uppercase fs-1"><?= $refArticle; ?></span></p>
      <thead>
        <tr class="row mx-3">
          <th scope="col" class="col-5 d-flex justify-content-center align-items-center">Zone</th>
          <th scope="col" class="col-5 d-flex justify-content-center align-items-center">Qté</th>
          <th scope="col" class="col-2 d-flex justify-content-center align-items-center"></th>

        </tr>
      </thead>
      <tbody>

        <?php

        for ($i = 0; $i < count($stockDeLArticle); $i++) {

        ?>
          <tr class="row mx-3">
            <td class="col-5 d-flex justify-content-center align-items-center"><?= $stockDeLArticle[$i]['Zone'] ?></td>
            <td class="col-5 d-flex justify-content-center align-items-center"><?= $stockDeLArticle[$i]['stock'] ?></td>
            <td class="col-2 d-flex justify-content-center align-items-center"><a class="btn btn-outline-primary btn d-flex justify-content-center align-items-center" href="mouvement.php?ref=<?= $refArticle ?>&amp;zone=<?= $stockDeLArticle[$i]['Zone'] ?>&amp;Qte=<?= $stockDeLArticle[$i]['stock'] ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-slash-minus" viewBox="0 0 16 16">
                  <path d="m1.854 14.854 13-13a.5.5 0 0 0-.708-.708l-13 13a.5.5 0 0 0 .708.708ZM4 1a.5.5 0 0 1 .5.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2A.5.5 0 0 1 4 1Zm5 11a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5A.5.5 0 0 1 9 12Z" />
                </svg></a></td>
          </tr>

        <?php
        }
        ?>
      </tbody>
    </table>
    <table class="table table-striped table-hover table-sm">
      <p class="h3 text-center">Détail des mouvements :</p>
      <thead>
        <tr class="row mx-3">
          <th scope="col" class="col-6 d-flex justify-content-center align-items-center">Date</th>
          <th scope="col" class="col-3 d-flex justify-content-center align-items-center">Adresse</th>
          <th scope="col" class="col-3 d-flex justify-content-center align-items-center">Quantité</th>

        </tr>
      </thead>
      <tbody>
        <?php
        for ($i = 0; $i < count($detailMouvements); $i++) {
        ?>
          <tr class="row mx-3">
            <td class="col-6 d-flex justify-content-center align-items-center"><?= $detailMouvements[$i]['dateMouvement'] ?></td>
            <td class="col-3 d-flex justify-content-center align-items-center"><?= $detailMouvements[$i]['adresseFlux'] ?></td>
            <td class="col-3 d-flex justify-content-center align-items-center">
              <?php //Lorsque la quantité mouvementée est positive, je rajoute "+" devant pour faciliter la lecture
              if ($detailMouvements[$i]['qteMouvement'] < 0) {

                echo $detailMouvements[$i]['qteMouvement'];
              } else {
                echo "+" . $detailMouvements[$i]['qteMouvement'];
              }
              ?>
            </td>
          </tr>
        <?php
        } //termine la boucle "for".
        ?>
      </tbody>
    </table>
    <?php
    $alertErreur = count(erreurStock($pdo));
    if ($alertErreur > 0) {
    ?>
      <div class="container-fluid d-flex flex-column">
        <a href="erreur.php"><button class="btn btn-warning w-100 mb-2">Consulter les <span style="font-size:1.5em;color:red;"><?= $alertErreur; ?></span> erreur(s) <br> (références en négatif)</button></a>
        
       
    <?php
    }
    ?> 
  </div>

  </section>

<?php
} else {
?>
  <div>
    <div>
      <a href="ajoute.php" class="link d-flex justify-content-center mt-3" style="text-decoration:none;"><button class="btn btn-danger btn-lg">ajouter
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
            <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z" />
          </svg>
        </button></a>
    </div>
    <hr class="m-5">
    <form action="index.php" class="m-3" method="post">
      <div class="input-group">
        <input class="form-control" type="text" name="refArticle" autocomplete="off">
        <button type="submit" class="btn btn-success btn-lg">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
          </svg>
        </button>
      </div>
    </form>

  </div>
  <hr class="m-3">
  <?php
  $alertErreur = count(erreurStock($pdo));
  if ($alertErreur > 0) {
  ?>
    <div class="container-fluid d-flex flex-column">
      <a href="erreur.php"><button class="btn btn-warning w-100 mb-2">Consulter les <span style="font-size:1.5em;color:red;"><?= $alertErreur; ?></span> erreur(s) <br> (références en négatif)</button></a>
    </div>
  <?php
  }
    if(isset($_SESSION['droit'])){
      ?>
      <div class="container-fluid d-flex justify-content-center">
         <a href="sauvegarde.php"><button class="btn btn-outline-primary">Export</button></a>
      </div>
     
    <?php
    }
    ?>

<?php
}

?>

<script>
    let liElemMenu = document.getElementById('li_surstock');
    let aElementMenu = document.getElementById('a_surstock');
    aElementMenu.classList += " text-white";
    liElemMenu.classList += " bg-dark rounded-top-3";
</script>
</body>
<footer>
</footer>

</html>