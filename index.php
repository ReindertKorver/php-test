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
        $page = $_GET["page"];
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

}


?>
<html>
<head>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/SCSS.css"/>
    <link rel="stylesheet" href="css/animation.css"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
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
<div class="TopBar">
    <?php
    if (isset($UserName)){
        echo "<a href='?page=account'>$UserName</a>";
    }
    else{
        echo "<a href='?page=login'>Login</a>";
    }
    ?>
</div>
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
