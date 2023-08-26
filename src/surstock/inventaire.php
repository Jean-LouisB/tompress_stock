<?php
include('includes/header.php');
include('includes/function-pdo.php');



?>
<!--Tout le css est géré inline et adapté à un ecran mobile uniquement-->
<!--Il n'y a que la table qui fait référence au css bootstrap-->

<body style="width:90%; margin-top:10px; display:flex; flex-direction:column;margin-left:auto; margin-right:auto;">


<H3 style="text-align:center;">Inventaire à faire</H3>
<table class = "table"><!-- référence à bootstrap -->
  <thead>
    <tr>
      <th scope="col" style="text-align:center;">Adresse</th>
      <th scope="col" style="text-align:center;">référence</th>
      <th scope="col" style="text-align:center;">qté théorique</th>
      <th scope="col" style="text-align:center;">Modifier la quantité</th>
      <th scope="col" style="text-align:center;">Valider</th>


    </tr>
  </thead>
  <tbody>

<?php

  for($i=0;$i< count($inventaire);$i++){
    
 
?>
 
  <tr>

      <td style="text-align:center;"><?=$inventaire[$i]['zonesstk']?></td>
      <td style="text-align:center;"><?=$inventaire[$i]['reference']?></td>
      <td style="text-align:center;"><?=$inventaire[$i]['qt_sstk']?></td>
      <td style="text-align:center;"><a style="button" href="corriger.php?idligne=<?= $inventaire[$i]['idligne'];?>" class="btn btn-primary">Modifier</button></td>
      <td style="text-align:center;"><a style="button" href="ctrlok.php?idligne=<?= $inventaire[$i]['idligne'];?>" class="btn btn-primary">Valider</button></td>
         


    </tr>
  
<?php 
}
?>
</tbody>
</table>

</body>

</html>