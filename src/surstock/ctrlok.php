<?php
include('includes/header.php');
include('includes/function-pdo.php');

$idligne = $_GET['idligne'];


function ctrlOK($idligne,$pdo){
    $sql ="UPDATE inventairesstk 
            SET ctrlOK = 1, 
            nvlleQte = qt_sstk
            WHERE idligne = :idligne";
    $params = ['idligne'=>$idligne];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
    return $result;

}

$valide = ctrlOK($idligne,$pdo);
header('location:inventaire.php');



?>
<!--Tout le css est géré inline et adapté à un ecran mobile uniquement-->
<!--Il n'y a que la table qui fait référence au css bootstrap-->

<body style="width:90%; margin-top:10px; display:flex; flex-direction:column;margin-left:auto; margin-right:auto;">



</body>

</html>