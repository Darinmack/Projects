<?php

namespace app\models;
use app\core\Model;

class Main

{


    use Model;

    protected $table = 'users';

    public function getAllUsers() {
        return $this->findAll();
    }

    
}