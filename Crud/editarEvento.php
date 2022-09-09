<?php
    include '../Crud/conexao.php';
    $id = $_GET['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data = $_POST['dataMarcada'];
    $autor = $_POST['autor'];

    $sql = "UPDATE eventos SET titulo='$titulo' WHERE id_evento = $id";
    $sql = $pdo->prepare($sql);
    $sql->execute();

    $sql2 = "UPDATE eventos SET descricao='$descricao' WHERE id_evento = $id";
    $sql2 = $pdo->prepare($sql2);
    $sql2->execute();

    $sql3 = "UPDATE eventos SET dataMarcada='$data' WHERE id_evento = $id";
    $sql3 = $pdo->prepare($sql3);
    $sql3->execute();

    $sql4 = "UPDATE eventos SET autor='$autor' WHERE id_evento = $id";
    $sql4 = $pdo->prepare($sql4);
    $sql4->execute();
    header('Location: ../index.php');
?>

