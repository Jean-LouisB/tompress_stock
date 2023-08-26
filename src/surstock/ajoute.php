<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

if (isset($_POST['ref'])) {

    $a=7;
    $reference = $_POST['ref'];
    $zone = $_POST['adresse'];
    $mvt = $_POST['qte'];
    $aujourdhui = date("Y-m-d H:i:s");
    ajouteFlux($reference, $zone, $mvt, $aujourdhui, $pdo);
}

?>
<section class="container-fluid vh-100">
    <form action="ajoute.php" method="post" class="d-flex flex-column h-75 justify-content-center">
        <input class="form-control mb-3" type="text" placeholder="Scanner la Réference" name="ref" id="ref" onchange="stringtouppercase()">
        <input class="form-control mb-3" type="text" placeholder="Adresse du type B01-4" name="adresse" id="adresse" onchange="controlePoint()">
        <!--la fonction javascript "controlePoint", contrôle la présence d'un point au début de la chaine de caractère de l'adresse saisie (scan etiquettes dépôt) et l'enlève si besoin-->
        <input class="form-control mb-5" type="number" placeholder="Quantité" name="qte">
        <!--<input type="text" placeholder="Commentaire" name="com">-->
        <button type="submit" class="btn btn-primary btn-lg">Valider</button>
    </form>
</section>

<script type="text/javascript">
    //ce script permet de surveiller la saisie de l'adresse. Si elle commence par un ".", le script le supprime.

    function controlePoint() {
        let adresseSaisie = document.getElementById("adresse").value;
        let premierCaractere = adresseSaisie.substr(0, 1);
        if (premierCaractere == ".") {
            let long = document.getElementById("adresse").length;
            document.getElementById("adresse").value = adresseSaisie.substr(1, long);
        }


    }

    function stringtouppercase() {
        //Permet de mettre la référence saisie en majuscule 
        let reference = document.getElementById("ref").value;
        let refMaj = (reference.toUpperCase());
        console.log(refMaj);
        document.getElementById("ref").value = refMaj


    }
</script>
</body>

</html>