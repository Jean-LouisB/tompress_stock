
<footer>


<?php

    $alertErreur = count(erreurStock($pdo));

?>
<style>

footer{
    width : 100%;

}
.piedDePage{
    
    display: flex;
    flex-direction:column;
    align-items: center; 
    width:100%;
    

}    
.exportButton{
    width : 100%;
    
    height:auto;
    padding : 10px;
    margin-top: 50px;

    
}

a{
    width : 100%;

}
.erreurBoutton{
    width : 100%;
    height:auto;
    padding : 10px;
    margin-top: 50px;
  
}

.alerte{

    background-color:yellow;
    color:red;

}

@media (max-width: 576px) {
    
                .exportButton{
                    visibility:hidden;
                  }

}

</style>
<div class= "piedDePage">
    <a href="erreur.php"><button class="erreurBoutton" >Consulter les <span style="font-size:1.5em;color:red;"><?=$alertErreur;?></span> erreur(s) <br> (références en négatif)</button></a>
    <a href="sauvegarde.php"><button class="exportButton">Export de la table <br> des flux pour sauvegarde.</button></a>
</div>
</footer>

