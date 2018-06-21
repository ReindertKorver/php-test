<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 20-6-2018
 * Time: 12:14
 */

namespace DAL;


use Entities\AdminPageItem;
use Entities\DBCredentials;
use Entities\Element;
use Entities\Page;
use mysqli;

class DBPageConnection
{
    public static function GetPages()
    {

    }

    public static function GetPage($pageName)
    {
        $page = null;
        $conn = new mysqli(DBCredentials::$ServerName, DBCredentials::$UserName, DBCredentials::$Password, DBCredentials::$DatabaseName);

        if ($conn->connect_error) {
            return "Fout bij verbinding met database";
        }
        $stmt = $conn->prepare("SELECT page.ID,page.ElementID,page.PageName, element.ID,element.Data FROM page join element on element.ID=page.ID where PageName=?");
        $stmt->bind_param("s", $pageName);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result != null) {
            if (is_object($result)) {
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $page = new Page($row["ID"], new Element($row["ElementID"], $row["Data"]), $row["PageName"]);

                    }
                }
            }
        }
        $conn->close();
        return $page;
    }

    public static function GetAdminPageItems()
    {
        $pageItems = [];
        $conn = new mysqli(DBCredentials::$ServerName, DBCredentials::$UserName, DBCredentials::$Password, DBCredentials::$DatabaseName);

        if ($conn->connect_error) {
            return "Fout bij verbinding met database";
        }
        $stmt = $conn->prepare("SELECT ID,Item,Content from adminpageitems");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result != null) {
            if (is_object($result)) {
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $pageItem = new AdminPageItem($row["ID"], $row["Item"], $row["Content"]);
                        array_push($pageItems, $pageItem);
                    }
                }
            }
        }
        $conn->close();
        return $pageItems;
    }
}