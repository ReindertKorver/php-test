<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 12-6-2018
 * Time: 00:16
 */

namespace DAL;


use Entities\DBCredentials;
use Entities\User;
use function MongoDB\BSON\toJSON;
use mysqli;

class DBUserConnection
{
    public static function GetUser($UserName, $Password)
    {
        $conn = new mysqli(DBCredentials::$ServerName, DBCredentials::$UserName, DBCredentials::$Password, DBCredentials::$DatabaseName);

        if ($conn->connect_error) {
            return "Fout bij verbinding met database";
        }
        $stmt = $conn->prepare("SELECT ID, UserName, Password FROM user where UserName=? and Password=?");
        $stmt->bind_param("ss", $UserName, $Password);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = new User();
        if ($result != null) {


            if (is_object($result)) {
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        $user->setId($row["ID"]);
                        $user->setPassword($row["Password"]);
                        $user->setUserName($row["UserName"]);

                    }
                } else {
                    return "Geen gebruiker gevonden met deze combinatie";
                }
            } else {
                return "Geen gebruiker gevonden met deze combinatie";
            }
        }
        else{
            return "Geen gebruiker gevonden met deze combinatie";
        }
        $conn->close();
        return $user;
    }
}