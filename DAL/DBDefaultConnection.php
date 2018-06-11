<?php
/**
 * User: reind
 * Date: 11-6-2018
 * Time: 21:32
 */


namespace DAL;

use Entities\DBCredentials;
use mysqli;


class DBDefaultConnection
{
    public static function TestConnection()
    {
        try {
        $conn = new mysqli(DBCredentials::$ServerName . ':' . DBCredentials::$Port, DBCredentials::$UserName, DBCredentials::$Password);

            if ($conn->connect_error) {
                return "Connection failed: " . $conn->connect_error;
            } else {
                return true;
            }
        } catch (Exception $exception) {
            return "Connection failed: " .$exception;
        }
    }

}