<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 20-6-2018
 * Time: 12:47
 */

namespace Entities;


class Element
{
    public $ID;
    public $Data;
    function __construct($id,$data)
    {
        $this->ID = $id;
        $this->Data = $data;
    }
}