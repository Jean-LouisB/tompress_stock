<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

$id = $_GET['id'];
traiteDluo($pdo,$id);
header('location:listdluo.php');