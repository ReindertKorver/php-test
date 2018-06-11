<?php
/**
 * User: reind
 * Date: 11-6-2018
 * Time: 16:59
 */
require  __DIR__.'/vendor/autoload.php';
use \DAL\DBDefaultConnection;

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
$rootDir=__DIR__;
?>
<html>
<head>
    <link rel="stylesheet" href="css/style.css"/>
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
<div class="TopBar">

</div>
<div class="SideBar">

</div>
<div class="MainBody">
    <div class="Page text-center">
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
            echo "Fout bij verbinding maken met database ".$ErrorConnectionMessage;
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
