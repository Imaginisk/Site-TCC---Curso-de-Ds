<?php
    require ('../Crud/conexao.php');

    $id = $_GET['id'];
    $comentarioConteudo = $_POST['ComentarioConteudo'];
    $sql = "DELETE FROM comentarios
    WHERE id_comentario='$id';";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    header("location: ../index.php");
?>