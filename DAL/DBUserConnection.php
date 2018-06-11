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
use mysqli;

class DBUserConnection
{
    public static function GetUser($UserName, $Password)
    {
        try {
            $conn = new mysqli(DBCredentials::$ServerName . ':' . DBCredentials::$Port, DBCredentials::$UserName, DBCredentials::$Password);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT ID, UserName, Password FROM user where UserName='reindert' and Password='poep'";

            $result = $conn->query($sql);
            $user = new User();
            if (is_object($result)) {
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        $user->setId($row["id"]);
                        $user->setPassword($row["Password"]);
                        $user->setUserName($row["UserName"]);

                    }
                } else {
                    return "Geen gebruiker gevonden met deze combinatie";
                }
            } else {
                return "Database gaf geen resultaten terug";
            }
            $conn->close();
            return $user;
        } catch (Exception $exception) {
            return "Connection failed: " . $exception;
        }
    }
}