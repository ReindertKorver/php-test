<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 20-6-2018
 * Time: 19:24
 */

namespace Entities;


class Right
{
    public $ID;
    public $Enabled;
    public $Description;

    function __construct($id, $enabled, $description)
    {
        $this->ID = $id;
        $this->Enabled = $enabled;
        $this->Description = $description;
    }
}