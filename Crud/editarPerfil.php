<?php
    require ('../Crud/conexao.php');

    $id = $_GET['id'];
   
    if(isset($_SESSON['idusuario'])){
         $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "UPDATE usuario SET nome='$nome' WHERE id = '$id'";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $sql = "UPDATE usuario SET sobrenome='$sobrenome' WHERE id = '$id'";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $sql = "UPDATE usuario SET email='$email' WHERE id = '$id'";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $sql = "UPDATE usuario SET senha='$senha' WHERE id = '$id'";
        $sql = $pdo->prepare($sql);
        $sql->execute();
    }else{
        $nome = $_POST['nome'];
        $pix = $_POST['sobrenome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "UPDATE ongs SET nome_ong='$nome' WHERE id_ong = '$id'";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $sql = "UPDATE ongs SET pix_ong='$pix' WHERE id_ong = '$id'";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $sql = "UPDATE ongs SET email_ong='$email' WHERE id_ong = '$id'";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        $sql = "UPDATE ongs SET senha_ong='$senha' WHERE id_ong = '$id'";
        $sql = $pdo->prepare($sql);
        $sql->execute();
    }
    

    header('Location: ../perfil.php');
?>