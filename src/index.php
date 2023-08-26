<?php
include('../includes/header.php');
include('../includes/function-pdo.php');
include('../includes/navbar.php');
$dluoRouge = getAlerteN0Dluo($pdo,$date_Sys);
$nbRouge = count($dluoRouge);
$dluoOrange = getAlerteN1Dluo($pdo,$date_Sys);
$nbOrange = count($dluoOrange);
$dluoVert = getAlerteN2Dluo($pdo,$date_Sys);
$nbVert = count($dluoVert);
$listDluo = getDluoToDo($pdo);
$nbItem = count($listDluo);

?>



<section>

<article class="d-flex flex-column justify-content-center px-3">
    <h2 class="text-center mb-5">Alertes DLUO :</h2>
    <?php
    if($nbVert>0){?>
       <a class="btn btn-success btn-lg mb-4" href="dluo/alertes.php?alerte=verte"><?=$nbVert;?> => 90 Jours </a>
        <?php
        ?>
<?php
    }else{?>
        <a class="btn disabled btn-lg mb-4" href="#"><?=$nbVert;?> => 90 Jours </a>
    <?php
    }
    if($nbOrange>0){?>
    
       <a class="btn btn-warning btn-lg mb-4" href="dluo/alertes.php?alerte=orange"><?=$nbOrange;?> => 60 Jours </a>
<?php
    }else{?>
        <a class="btn disabled btn-lg mb-4" href="#"><?=$nbOrange;?> => 60 Jours </a>
 <?php
    }
    if($nbRouge>0){?>
       <a class="btn btn-danger btn-lg mb-4" href="dluo/alertes.php?alerte=rouge"><?=$nbRouge;?>  => 30 Jours </a>

<?php
    }else{?>
        <a class="btn disabled btn-lg mb-4" href="#"><?=$nbRouge;?>  => 30 Jours </a>
  <?php

    }

?>
    <a class="btn btn-secondary btn-lg" href="dluo/listdluo_todo.php"><?= $nbItem;?> DLUO à renseigner </a>
</article>
    
    

</section>
</body>
</html>