<?php
//surveille la connexion :
if (!isset($_SESSION['userName'])) {
    header('location:/index.php');
} else {
?>

    <body>
        <header class="navbar navbar-expand-md navbar-light bg-light px-3 h-auto sticky-top">
            <button class="navbar-toggler ms-auto p-0 w-25 border-0" style="height:50px; width:50px;" data-bs-toggle="collapse" data-bs-target="#navContent">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <img class="m-0 p-0" style="height:100%" src="/images/hamburger.svg" alt="hamberger menu">
            </button>
            <nav class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav ms-auto mt-3 h-auto">
                    <li id="li_surstock" class="nav-item h2 d-flex align-items-center justify-content-center mb-5 mb-md-1"><a id="a_surstock" class="w-100 h-100 nav-link text-center border-bottom border-top" href="/src/surstock/index.php">Surstock</a></li>
                    <li id="li_dluo" class="nav-item h2 d-flex align-items-center justify-content-center mb-5 mb-md-1"><a id="a_dluo" class="w-100 h-100 nav-link text-center border-bottom border-top" href="/src/dluo/index.php">DLUO</a></li>
                    <li id="li_dluotodo" class="nav-item h2 d-flex align-items-center justify-content-center mb-5 mb-md-1"><a id="a_dluotodo" class="w-100 h-100 nav-link text-center border-bottom border-top" href="/src/dluo/listdluo_todo.php">DLUO à Remplir</a></li>
                    <li class="nav-item h2 d-flex align-items-center justify-content-center mb-5 mb-md-1"><a class="w-100 h-100 nav-link text-center border-bottom border-top" href="/src/user/logout.php">Logout</a></li>
                </ul>

            </nav>
        </header>

    <?php
} // ferme le else qui surveille la connexion à la session 
    ?>
