<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 20-6-2018
 * Time: 19:12
 */

namespace DAL;


use Entities\DBCredentials;
use Entities\Right;
use Entities\User;
use mysqli;

class DBRoleConnection
{
    public function GetUserRights($user)
    {
        $paramClass = get_class($user);
        if ($paramClass == User::class) {
            $conn = new mysqli(DBCredentials::$ServerName, DBCredentials::$UserName, DBCredentials::$Password, DBCredentials::$DatabaseName);

            if ($conn->connect_error) {
                throw new \Exception( "Fout bij verbinding met database");
            }
            $stmt = $conn->prepare("SELECT rights.ID, rights.Enabled, rights.RightDescription from user_role join role_right on role_right.roleid=user_role.roleid join rights on rights.ID=role_right.rightid where user_role.userid=?");
            $userid = $user->getId();
            $stmt->bind_param("s",$userid );
            $stmt->execute();
            $result = $stmt->get_result();
            $rights =[];
            if ($result != null) {
                if (is_object($result)) {
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $right =new Right($row["ID"],$row["Enabled"],$row["RightDescription"]);
                            array_push($rights,$right);
                        }
                    }
                }
            }
            $conn->close();
            return $rights;
        }
        else{
            throw new \Exception("Parameter is not of class User");
        }
    }
}