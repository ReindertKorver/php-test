<?php
/**
 * User: reind
 * Date: 11-6-2018
 * Time: 23:55
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST["UserName"]) && isset($_POST["Password"])) {
    $UserName = $_POST["UserName"];
    $Password = $_POST["Password"];
    //check in database
    $result = \DAL\DBUserConnection::GetUser($UserName, $Password);

    if (isset($result)&&$result!=null&&!is_string($result)) {
        $NewID = $result->getId();
        $NewPassword = $result->getPassword();
        $NewUserName = $result->getUserName();
        echo "Result = " . $NewID . " " . $NewUserName . " " . $NewPassword;
        //save in user in session because he's logged in.
        $_SESSION["LoggedInUser"] =$result;
        //refresh the page

    }
} else {
    echo "Geen gebruiker gevonden met deze combinatie";

}
?>

<div>
    <div class='PageTitle'>Login</div>
    <div class="PageContent">
        <form id="LoginForm" action="Login" method="POST">
            <input type="text" placeholder="Gebruikersnaam" class="DefaultTextBox" name="UserName" required><br/>
            <input type="password" placeholder="Wachtwoord" class="DefaultTextBox" name="Password" required><br/>
            <input value="Login" class="DefaultButton" type="submit">
        </form>
    </div>
</div>