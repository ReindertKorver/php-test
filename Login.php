<?php
/**
 * User: reind
 * Date: 11-6-2018
 * Time: 23:55
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<div class="Page">
    <div class='PageTitle'>Login</div>
    <div class="PageContent">
        <form id="LoginForm" class="Form50center" action="Login" method="POST">
            <input type="text" placeholder="Gebruikersnaam" class="DefaultTextBox" name="UserName" required><br/>
            <input type="password" placeholder="Wachtwoord" class="DefaultTextBox" name="Password" required><br/>
            <input value="Login" class="DefaultButton" type="submit">
            <div class="Message">
                <?php
                if (isset($_POST["UserName"]) && isset($_POST["Password"])) {
                    $UserName = $_POST["UserName"];
                    $Password = $_POST["Password"];
                    //check in database
                    $result = \DAL\DBUserConnection::GetUser($UserName, $Password);

                    if (isset($result) && $result != null && !is_string($result)) {
                        $NewID = $result->getId();
                        $NewPassword = $result->getPassword();
                        $NewUserName = $result->getUserName();
                        echo "Result = " . $NewID . " " . $NewUserName . " " . $NewPassword;
                        //save in user in session because he's logged in.
                        $_SESSION["LoggedInUser"] = $result;
                        //refresh the page
                        header("location: account");
                    } else {
                        $_SESSION["LoggedInUser"] = null;
                        ShowMessage("Geen gebruiker gevonden met deze combinatie", "Fout");
                    }
                } else {
                    $_SESSION["LoggedInUser"] = null;

                }
                function ShowMessage($text, $title)
                {
                    echo "<div class='MessageTitle'>$title</div><hr/><div class='MessageText'>$text</div>";
                }

                ?>
            </div>
        </form>

    </div>
</div>