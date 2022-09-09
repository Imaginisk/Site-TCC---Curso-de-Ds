<?php
    require ('../Crud/conexao.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM eventos
    WHERE id_evento='$id';";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    header('Location: ../index.php');
?>