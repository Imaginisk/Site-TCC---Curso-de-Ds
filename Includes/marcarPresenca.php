<?php

include "../Crud/conexao.php";
session_start();

$id = $_GET['id'];
$idConfirm = $_SESSION['idusuario'];
global $pdo;
$sql4 = "SELECT * FROM eventos WHERE id_evento=$id";
$sql4 = $pdo->prepare($sql4);
$sql4->execute();
$dado4 = $sql4->fetch();

$sql5 = "SELECT count(*) FROM information_schema.columns WHERE table_name = 'eventos'";
        $sql5 = $pdo->prepare($sql5);
        $sql5->execute();
        $dado5 = $sql5->fetch();
        $eventosSoma = $dado5[0] - 10;
        $n = $eventosSoma + 1;

for($i=1;$i<$n;$i++){
     if($dado4['id_usuario' . $i] == $idConfirm){
        header("location: ../eventos.php?id=$id");
         exit();
      }
      
}
// +1 confirmado
$sql2 = "select confirmados from eventos where id_evento=$id;";
$sql2 = $pdo->prepare($sql2);
$sql2->execute();
$dado2 = $sql2->fetch();
$dado2[0] += 1;
$sql6 = "UPDATE eventos SET confirmados =$dado2[0] WHERE id_evento = $id";
$sql6 = $pdo->prepare($sql6);
$sql6->execute();

//Ecopoints ganhos
$sql2 = "select vl_ecopoints from usuario where id=$idConfirm";
$sql2 = $pdo->prepare($sql2);
$sql2->execute();
$dado2 = $sql2->fetch();
$dado2[0] += 20;  
$sql3 = "UPDATE usuario SET vl_ecopoints = $dado2[0] WHERE id = $idConfirm";
$sql3 = $pdo->prepare($sql3);
$sql3->execute();

$statement1 = $pdo->prepare("ALTER TABLE eventos ADD COLUMN id_usuario$n int");
$statement1->execute();
$statement2 = $pdo->prepare("UPDATE eventos SET id_usuario$n='$idConfirm' WHERE id_evento='$id'");
$statement2->execute();






header("location: ../eventos.php?id=$id");

