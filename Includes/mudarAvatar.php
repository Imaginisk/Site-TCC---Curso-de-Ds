<?php

include "../Crud/conexao.php";
session_start();
$id = $_SESSION['idusuario'];
$fotoMudar = $_GET['img'];

$sql = "UPDATE usuario SET foto_usuario='$fotoMudar' WHERE id = '$id'";
$sql = $pdo->prepare($sql);
$sql->execute();

$sql = "UPDATE comentarios SET foto_usuario='$fotoMudar' WHERE id_usuario = '$id'";
$sql = $pdo->prepare($sql);
$sql->execute();

header('Location: ../perfil.php');

?>