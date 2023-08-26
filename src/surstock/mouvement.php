<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');
?>

<head>


</head>
<section class="container-fluid">


    <div class="form-group">
        <input type="" id="ref" name="ref" value="<?= $_GET['ref']; ?>" class="form-control mb-3 fs-1 text-center border-0 text-uppercase">
        <input type="" id="zone" name="zone" value="<?= $_GET['zone']; ?>" class="form-control fs-1 text-center border-0">
    </div>
    <div class="form-group">
        <input type="qtestock" id="qtestock" name="qtestock" value="Stock actuel : <?= $_GET['Qte']; ?>" class="form-control mb-3 fs-1 text-center border-0 text-uppercase">
    </div>


    <div class="container-fluid d-flex justify-content-around" id="choixSens">
        <div class="input-group">
            <input type="number" name="qteMvt" id="qteMvt" class="form-control fs-1 texte-center" placeholder="Quantité">
            <button class="btn btn-warning" onclick="simuleSFplus()" id="bouttonPlus">mouvementer</button>
        </div>

    </div>

    <div class="container-fluid d-flex flex-column justify-content-around">
        <label class="text-center" for="nvxSolde">Stock après le mouvement :</label>
        <input type="text" id="nvxSolde" name="nvxSolde" class="form-control mb-3 fs-1 text-center border-0">
        <button class="btn btn-success btn-lg mb-3" onclick="validerMvt()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
            </svg>
        </button>

        <button class="btn btn-danger btn-lg" onclick="annuler()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </button>

    </div>
    <script type="text/javascript">
        function simuleSFplus() {
            let tabSI = document.getElementById('qtestock').value.split(':') 
            let soldeInitial = tabSI[1];
            let flux = document.getElementById('qteMvt').value;
            let soldeFinal = parseInt(soldeInitial) + parseInt(flux);
            document.getElementById('nvxSolde').value = soldeFinal;
            console.log("si = "+soldeInitial+" de type :"+typeof soldeInitial) 
            console.log("flux = "+flux+" de type :"+typeof flux) 
            console.log("sf = "+soldeFinal+" de type :"+typeof soldeFinal) 
        }


        function validerMvt() {
            let reference = document.getElementById("ref").value;
            let zone = document.getElementById("zone").value;
            let qteMvt = document.getElementById("qteMvt").value;
            location.href = 'nvxmouvement.php?ref=' + reference + '&zone=' + zone + '&mvt=' + qteMvt;
        }

        function annuler() {
            location.href = 'index.php';

        }
    </script>
</section>
</body>

</html>