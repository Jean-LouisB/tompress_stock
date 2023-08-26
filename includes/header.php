<?php

$rootPath = $_SERVER['DOCUMENT_ROOT'];
require_once $rootPath.'/config/config.php';



//connection à la base de données :

session_start();
$dsn='mysql:host='.DB_HOST.':'.DB_PORT.';dbname='.DB_NAME;
$nomSession ="Session distante";
$pdo = new \PDO($dsn, DB_USER, DB_PASSWORD);
$pdo->exec("SET CHARACTER SET utf8"); 

?>

<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex"> <!--refuse le passage des robots-->
  <title>Accueil</title> <!--Le titre de chaque page est défini dans chacune par la variable $titre--> 
  <script
			  src="https://code.jquery.com/jquery-3.6.4.js"
			  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
			  crossorigin="anonymous"></script>
  <script src="/css/menu.js" defer></script> <!-- Pour toutes les pages -->
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <script src="../../js/bootstrap.bundle.min.js" defer></script>
</head>


