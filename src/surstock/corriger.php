<?php
include('includes/header.php');
include('includes/function-pdo.php');

$idligne = $_GET['idligne'];

if (count($_POST)==0){
        echo "indiquez la nouvelle quantité";

}else{

    $newQte = $_POST['newQte'];
    $idligne = $_POST['idligne'];
    
   //LA fonction modifieLigne corrige la qté existante par la qté entrée par le formulaire ci-dessous, et change la désignation par "corrigé"
        function modifieLigne($idligne,$newQte,$pdo){
            $sql ="UPDATE inventairesstk 
                    SET nvlleQte = :newQte , 
                    ctrlOK = 1
                    WHERE idligne = :idligne";
            $params = ['idligne' => $idligne,'newQte'=> $newQte];
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
            return $result;
        
        }
        
        $corrige = modifieLigne($idligne,$newQte,$pdo);

        header('location:inventaire.php');
       

}//ferme le else


?>
<!--Tout le css est géré inline et adapté à un ecran mobile uniquement-->
<!--Il n'y a que la table qui fait référence au css bootstrap-->

<body style="width:90%; margin-top:10px; display:flex; flex-direction:column;margin-left:auto; margin-right:auto;">

    <form action="corriger.php" method="post">

            <input type="number" id="newQte" name="newQte">
            <input type="hidden" id="idligne" name="idligne" value="<?=$idligne;?>"> <!--Récupère l'idligne pour l'envoyer dans le post-->
            <br>
            <br>    
            <button type="submit">VALIDER</button>

    </form>

</body>

</html>