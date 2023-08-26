<?php



//--------------------- paramètres -----------------------------------
setlocale(LC_TIME, "FR_fr");
$date_Sys = date('Y-m-d');

function getParams($pdo){
    $sql=$pdo->query("SELECT * from param");
    $tabParam = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $tabParam;
}
$parametres = getParams($pdo);
for($i = 0;$i < count($parametres); $i++){
    if($parametres[$i]['nomParam'] == "alerteNiveau0"){
        $niveau0 = intval($parametres[$i]['valeurParam']);
    }else if($parametres[$i]['nomParam'] == "alerteNiveau1"){
        $niveau1 = intval($parametres[$i]['valeurParam']);
    }else if($parametres[$i]['nomParam'] == "alerteNiveau2"){
        $niveau2 = intval($parametres[$i]['valeurParam']);
    }else{
        echo 'rien trouvé';
    }
}

//--------------------- utilisateurs -----------------------------------


//check mdp à la connexion :
function isValid($pdo,$userName, $userPassword){
    $stmt=$pdo->prepare("SELECT * from userstock Where userName=?");
    $stmt->bindValue(1,$userName);
    $stmt->execute();
    $user = $stmt->fetchall(PDO :: FETCH_ASSOC);
    if(count($user)>0){
        if(password_verify($userPassword,$user[0]['userPassword'])){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function getUserRight($pdo,$userName){
    $stmt=$pdo->prepare("SELECT * from userstock Where userName=?");
    $stmt->bindValue(1,$userName);
    $stmt->execute();
    $user = $stmt->fetchall(PDO :: FETCH_ASSOC);
    return $user[0]['droit'];
}

//Nouvel utilisateur --> function vérifiée OK.
function newUser($pdo,$userName,$passWord){
    $sql="INSERT INTO userstock (username,userPassword, droit) values(?,?,0)";
    $stmt = $pdo->prepare($sql)->execute([$userName,password_hash($passWord, PASSWORD_BCRYPT)]);
    return $stmt;
}


//---------------------------------------------- Gestion de Surstock----------------------------------------- 
// la fonction getMouvements récupére l'ensemble des flux d'un article défini.
function getMouvements($refArticle,$pdo){

    $sql ="SELECT * FROM flux
            WHERE article = :refArticle
            ORDER BY dateMouvement desc";
    $params =['refArticle' => $refArticle];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
    return $result;
    }

// La fonction detailArticle récupére le détail des stocks (qté totale par emplacement) pour un article défini. il fait référence é une vue.
function detailArticle($refArticle,$pdo){

    $sql ="SELECT * FROM stockpararticle
    WHERE article = :refArticle
    ORDER BY Zone";
    $params =['refArticle' => $refArticle];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
    return $result;
    }

//Objet => $listeRef => la fonction listeArticles récupére la liste des références et des désignations pour l'affichage (liste déroulante ...)
function listeArticles($pdo){
    $sql ="SELECT article FROM flux
            GROUP BY article
            ORDER BY article";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
    return $result;
    

    }

    $listeRef = listeArticles($pdo);


function ajouteFlux($reference,$zone,$mvt,$aujourdhui,$pdo){

    $sql ="INSERT INTO flux (codeAgent,article,adresseFlux,qteMouvement,dateMouvement,Commentaire) VALUES ('FK',:reference,:zone,:mvt,:aujourdhui,'via appli')";
    $params = ['reference' => $reference, 'zone' => $zone, 'mvt' => $mvt, 'aujourdhui'=> $aujourdhui];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
    header('location:index.php');
    return $result;

}

function erreurStock($pdo){

    $sql ="SELECT * FROM stockpararticle
    Where stock < 0 
    and article <>'#N/A'
    ORDER BY article";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchall(PDO :: FETCH_ASSOC);
    return $result;
    }

//--------------------------------- Gestion des DLUO --------------------------------

function getAllDluo($pdo){
    $sql = $pdo->query("SELECT * FROM dluo where traitee = 0 order by alerteNiveau2, reference");
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getAlerteN0Dluo($pdo,$date_Sys){//rouge
    $stm = $pdo->prepare("SELECT * FROM dluo where alerteNiveau0 <=? and traitee = 0");
    $stm->bindValue(1,$date_Sys);
    $stm->execute();
    $rows = $stm->fetchALL(PDO::FETCH_ASSOC);
    return $rows;
}
function getAlerteN1Dluo($pdo,$date_Sys){//orange
    $stm = $pdo->prepare("SELECT * FROM dluo 
                        where alerteNiveau1 <=? 
                        and alerteNiveau0 >?
                        and traitee = 0");
    $stm->bindValue(1,$date_Sys);
    $stm->bindValue(2,$date_Sys);
    $stm->execute();
    $rows = $stm->fetchALL(PDO::FETCH_ASSOC);
    return $rows;
}
function getAlerteN2Dluo($pdo,$date_Sys){//verte
    $stm = $pdo->prepare("SELECT * FROM dluo 
                        where alerteNiveau2 <=? 
                        and alerteNiveau1 >?
                        and traitee = 0
                        ORDER BY dluo");
    $stm->bindValue(1,$date_Sys);
    $stm->bindValue(2,$date_Sys);
    $stm->execute();
    $rows = $stm->fetchALL(PDO::FETCH_ASSOC);
    return $rows;
}

function addItemDluo($pdo,$refArticle,$zoneStock,$numLot,$dluo,$date_Sys,$niveau0,$niveau1,$niveau2){
    $dl30 = date('Y-m-d',strtotime($dluo)-($niveau0*24*3600));
    $dl60 = date('Y-m-d',strtotime($dluo)-($niveau1*24*3600));
    $dl90 = date('Y-m-d',strtotime($dluo)-($niveau2*24*3600));
    $sql="INSERT INTO dluo (reference, numLot, dluo, dateEntree, traitee, zone, alerteNiveau0,alerteNiveau1,alerteNiveau2) VALUES (?,?,?,?,0,?,?,?,?)";
    $rows = $pdo->prepare($sql)->execute([$refArticle,$numLot,$dluo,$date_Sys,$zoneStock,$dl30,$dl60,$dl90]);
    
    return $rows;

}

function traiteDluo($pdo,$id){
    $stm= $pdo->prepare("UPDATE dluo set traitee = 1 Where id=?");
    $stm->bindValue(1,$id);
    $stm->execute();
    $rows = $stm->fetchALL(PDO::FETCH_ASSOC);
}

function forExemple($x){
    return $x*2;
}

function dateToStringInFrench($uneDate){

    $frenchDateDay = date('d',strtotime($uneDate));
    $frenchDateMonth = date('m',strtotime($uneDate));
    $frenchDateYear = date('Y',strtotime($uneDate));

    return $frenchDateDay."/".$frenchDateMonth."/".$frenchDateYear;

}

function searchRefDluo($pdo,$stringRef){
    $stm = $pdo->prepare("SELECT * FROM dluo where traitee = 0 AND reference LIKE CONCAT('%', ?, '%') order by dluo desc ");
    $stm->bindValue(1,$stringRef);
    $stm->execute();
    $rows = $stm->fetchALL(PDO::FETCH_ASSOC);
    return $rows;

}

//--DLUO à compléter --------------

function getDluoToDo($pdo){
    $sql = $pdo->query("SELECT * FROM to_complete where added = 0 order by zone");
    $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


?>