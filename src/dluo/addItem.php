<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

if(isset($_POST['articleRef'])){

    addItemDluo($pdo,$_POST['articleRef'],$_POST['zoneStock'],$_POST['numLot'],$_POST['dluo'],$date_Sys,$niveau0,$niveau1,$niveau2);
    unset($_POST);
    //var_dump(getAllDluo($pdo));
}

?>

<section id="addItemSection">
    <form action="#" method="post" autocomplete="off">
        <input type="text" id="articleRef" name="articleRef" placeholder="Référence" require>
        <input type="text" id="zoneStock" name="zoneStock" placeholder="Zone" require>
        <input type="text" id="numLot" name="numLot" placeholder="Numéro de lot" require>
        <input type="date" id="dluo" name="dluo" require>
        <button type="submit">VALIDER</button>
    </form>
</section>
</body>
</html>