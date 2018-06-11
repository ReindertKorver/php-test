<?php
/**
 * User: reind
 * Date: 11-6-2018
 * Time: 23:55
 */

if (isset($_POST["UserName"]) && isset($_POST["Password"])) {
    $UserName = $_POST["UserName"];
    $Password = $_POST["Password"];
    $result = \DAL\DBUserConnection::GetUser($UserName, $Password);
    echo $result;
    if (isset($result)&&$result!=null&&!is_string($result)) {
        $NewID = $result->getId();
        $NewPassword = $result->getPassword();
        $NewUserName = $result->setUserName();
        echo "Result = " . $NewID . " " . $NewUserName . " " . $NewPassword;
    }
} else {

}
?>

<div>
    <div class='PageTitle'>Login</div>
    <div class="PageContent">
        <form id="LoginForm" action="Login" method="POST">
            <input type="text" placeholder="Gebruikersnaam" class="DefaultTextBox" name="UserName"><br/>
            <input type="password" placeholder="Wachtwoord" class="DefaultTextBox" name="Password"><br/>
            <input value="Login" class="DefaultButton" type="submit">
        </form>
    </div>
</div>