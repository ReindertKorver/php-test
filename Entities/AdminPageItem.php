<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 20-6-2018
 * Time: 23:13
 */

namespace Entities;


class AdminPageItem
{
    public $ID;
    public $Item;
    public $Content;
    public function __construct($id,$item,$content)
    {
        $this->ID=$id;
        $this->Item=$item;
        $this->Content=$content;
    }
}