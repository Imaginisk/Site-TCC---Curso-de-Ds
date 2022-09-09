<?php

class Dbh{
    public function connect(){
       $pdo = new PDO("mysql:dbname=site_ecodoor;host=127.0.0.1", "root", "");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

}