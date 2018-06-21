<?php
/**
 * Created by PhpStorm.
 * User: reind
 * Date: 12-6-2018
 * Time: 00:21
 */

namespace Entities;


class User
{
    private $id;
    private $userName;
    private $password;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }


}