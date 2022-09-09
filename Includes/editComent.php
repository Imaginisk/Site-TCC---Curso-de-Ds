<link rel="stylesheet" href="../css/main.css" />
<?php
    require ('../Crud/conexao.php');

    $id = $_GET['id'];
    $comentarioConteudo = $_POST['ComentarioConteudo'];
    $sql = "UPDATE comentarios SET conteudo_comentario='$comentarioConteudo' WHERE id_comentario = '$id'";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    header('Location: ../index.php');
?>

