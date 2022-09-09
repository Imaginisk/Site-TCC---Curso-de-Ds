<?php
include "Crud/conexao.php";
$id = $_GET['id'];

$sql = "UPDATE usuario SET foto_usuario='img/fotoAmaro.jpg' WHERE id = '$id'";
$sql = $pdo->prepare($sql);
$sql->execute();
header('Location: index.php');