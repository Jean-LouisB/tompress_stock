<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

$reference = $_GET['ref'];
$zone = $_GET['zone'];
$mvt = $_GET['mvt'];
$aujourdhui = date("Y-m-d H:i:s");

ajouteFlux($reference,$zone,$mvt,$aujourdhui,$pdo);




?>