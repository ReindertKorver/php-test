<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 19-6-2018
 * Time: 22:58
 */
if (isset($_SESSION["LoggedInUser"])) {
    if(isset($_POST["logout"])){
        $_SESSION["LoggedInUser"]=null;
        header("location: login");
    }
}
else {
    header("location: login");
}
?>

<div class="Page" >
    <div class='PageTitle'>Account</div>
    <div class="PageContent">

        <form id="Logout" class="Form50center" method="post" action="account">
        <input class="DefaultButton" value="Logout" name="logout" type="submit" >
        </form>
    </div>
</div>