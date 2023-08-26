<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');


$stockAlerte = erreurStock($pdo);

?>

<section id="surStockSection">
  <table class="table">
    <thead>
      <tr>
        <th scope="col" style="text-align:center;">Références</th>
        <th scope="col" style="text-align:center;">Adresse</th>
        <th scope="col" style="text-align:center;">Quantité</th>
        <th scope="col" style="text-align:center;">voir</th>

      </tr>
    </thead>
    <tbody>
      <?php

      for ($i = 0; $i < count($stockAlerte); $i++) {

      ?>

        <tr>
          <td style="text-align:center;"><?= $stockAlerte[$i]['article'] ?></td>
          <td style="text-align:center;"><?= $stockAlerte[$i]['Zone'] ?></td>
          <td style="text-align:center;"><?= $stockAlerte[$i]['stock'] ?></td>
          <td style="text-align:center;"><a class="lienButton" href="index.php?article=<?= $stockAlerte[$i]['article']; ?>" class="btn btn-primary">Voir</button></td>

        </tr>

      <?php
      }
      ?>
    </tbody>
  </table>
</section>
</body>
</html>
