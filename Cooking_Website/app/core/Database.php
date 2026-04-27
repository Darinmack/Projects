<?php

namespace app\core;

Trait Database
{

    private function connect()
    {
        $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
        $con = new \PDO($string,DBUSER,DBPASS);
        return $con;
    }

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stm = $con->prepare($query);
/*
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Echo out the submitted values to verify if PHP can read them
            echo "Submitted Name: " . $_POST['name'] . "<br>";
            echo "Submitted Email: " . $_POST['email'] . "<br>";
            echo "Submitted Feedback: " . $_POST['Feedback'] . "<br>";
        }
      */
       
        $check = $stm->execute($data);
        if($check)
        {
            $result = $stm->fetchAll(\PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }

        return false;
        
    }
    

}


