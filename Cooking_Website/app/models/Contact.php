<?php

namespace app\models;
use app\core\Database;

class Contact
{
    use  Database;
/*
    public function findAll()
    {
        $query = "select * from $this->table";
        return $this->query($query);
    }

    */

// Save a new post
public function saveContact($inputData)
{
    $query = "insert into feed (name, email, Feedback) values (:name, :email, :Feedback)";
    return $this->query($query, $inputData);
}

public function theNewRecipes($inputData)
{
    $query = "insert into newrecipes (name, category, time, servingSize, ingredients, instructions) values (:name, :category, :time, :servingSize, :ingredients, :instructions)";
    return $this->query($query, $inputData);
}


public function saveFavoriteRecipe($inputData)
{
    $query = "insert into favorites (name, category) values (:name,  :category)";
    return $this->query($query, $inputData);
}


}