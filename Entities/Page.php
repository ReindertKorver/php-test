<?php
/**
 * User: reind
 * Date: 20-6-2018
 * Time: 12:24
 */
//
//$page =  new Page(123);
//$page->ID;
namespace Entities;


use DAL\DBPageConnection;

class Page
{
    public  $ID;
    public $Element;
    public $PageName;
    function __construct($id,$element,$pagename)
    {
        $this->ID = $id;
        $this->Element = $element;
        $this->PageName = $pagename;
    }
    function getPage($pageName){
        return DBPageConnection::GetPage($pageName);
    }
}


