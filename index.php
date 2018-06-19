<?php
/**
 * User: reind
 * Date: 11-6-2018
 * Time: 16:59
 */
require __DIR__ . '/vendor/autoload.php';

use \DAL\DBDefaultConnection;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//test database connection
if (DBDefaultConnection::TestConnection()) {
//connection accomplished
    if (isset($_GET["page"])) {
        if(strtolower($_GET["page"]) !="index")
        {
            $page = $_GET["page"];
        }
        else{
            $page = "home";
        }

    } else {
        $page = "home";
    }
} else {
    $ErrorConnectionMessage = DBDefaultConnection::TestConnection();

}
$rootDir = __DIR__;
//Check if user is logged in
if (isset($_SESSION["LoggedInUser"])) {
    $LoggedInUser = new \Entities\User();
    $LoggedInUser = $_SESSION["LoggedInUser"];
    $UserName = $LoggedInUser->getUserName();

} else {
    $UserName = null;
}


?>
<html>
<head>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/SCSS.css"/>
    <link rel="stylesheet" href="css/animation.css"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
            integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
            crossorigin="anonymous"></script>
</head>
<body>
<!--<video autoplay muted loop id="BackVideo">-->
<!--    <source src="videos/The_Himalayas_from_20_000_ft_(Ultra_HD_Footage).mp4" type="video/mp4">-->
<!--</video>-->
<div id="backgroundAnimation">

</div>
<div style="display: none;">
    <div style="background: #00585E;">#00585E</div>
    <div style="background: #FF5729;">#FF5729</div>
    <div style="background:#454445; ">#454445</div>
    <div style="background:#F5F2DC; ">#F5F2DC</div>
    <div style="background:#009494; ">#009494</div>
</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="home">PHP test</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home">Home </a>
            </li>
            <li class="nav-item">
                <?php
                if (isset($UserName)) {
                    echo "<a class='nav-link' href='account'>$UserName</a>";
                } else {
                    echo "<a class='nav-link' href='login'>Login</a>";
                }
                ?>
            </li>
        </ul>
    </div>
</nav>

<div class="SideBar">

</div>
<div class="MainBody">
    <div class="Page">
        <?php
        if (file_exists($page . ".php") && !isset($ErrorConnectionMessage)) {
            if (isset($page) && $page != "") {
                include("" . $page . ".php");
            } elseif (!isset($page)) {
                include("home.php");
            } else {
                include "404.php";
            }
        } else if (isset($ErrorConnectionMessage)) {
            echo "Fout bij verbinding maken met database " . $ErrorConnectionMessage;
        } else {
            include "404.php";
        }

        ?>
    </div>
</div>
<div class="footer">

</div>
</body>
</html>
