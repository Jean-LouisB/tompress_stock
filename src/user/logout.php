<?php
include('../../includes/header.php');
include('../../includes/function-pdo.php');
include('../../includes/navbar.php');

session_destroy();
setcookie(session_name(), '', time() - 3600, '/');
header('location:../../index.php')

?>