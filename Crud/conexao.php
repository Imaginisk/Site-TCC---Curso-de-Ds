<?php



global $pdo;

try{
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=site_ecodoor', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOexception $e){
    echo "ERRO: " .$e->getMessage();
    exit;
    
}