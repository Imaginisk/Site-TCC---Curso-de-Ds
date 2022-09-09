<?php
session_start();
global $pdo;
require_once "conexao.php";
$id = $_GET['id'];
$comentario = $_POST['comentario'];

if(isset($_SESSION['idusuario'])){
    $id_usuario = $_SESSION['idusuario'];
    $autor_comentario = $_SESSION['nome'] . " " . $_SESSION['sobrenome']??"";
}else{
    $id_ong = $_SESSION['idOng'];
    $autor_comentario = $_SESSION['nome'] ;
}



           

            if(isset($_SESSION['idusuario'])){
                
                $statement = $pdo->prepare("INSERT INTO comentarios (conteudo_comentario,autor_comentario,id_publicacao,id_usuario)
                VALUES(:comentario, :autor,:id_publicacao,:id_usuario)");
                $statement->bindVAlue(':comentario', $comentario);
                $statement->bindVAlue(':autor', $autor_comentario);
                $statement->bindVAlue(':id_publicacao', $id);
                $statement->bindVAlue(':id_usuario', $id_usuario);
                $statement->execute();

                    $sql2 = "SELECT * from usuario WHERE id = '$id_usuario'";
                    $sql2 = $pdo->prepare($sql2);
                    $sql2->execute();
                    $dado2 = $sql2->fetch();
                    $fotoAt = $dado2['foto_usuario'];

                    $sql = "UPDATE comentarios SET foto_usuario='$fotoAt' WHERE id_usuario = '$id_usuario'";
                    $sql = $pdo->prepare($sql);
                    $sql->execute();  
                    //Ecopoints ganhos
                    $sql2 = "select vl_ecopoints from usuario where id=$id_usuario";
                    $sql2 = $pdo->prepare($sql2);
                    $sql2->execute();
                    $dado2 = $sql2->fetch();
                    $dado2[0] += 10;  
                    $sql3 = "UPDATE usuario SET vl_ecopoints = $dado2[0] WHERE id = $id_usuario";
                    $sql3 = $pdo->prepare($sql3);
                    $sql3->execute();
            }else{
                
                $statement = $pdo->prepare("INSERT INTO comentarios (conteudo_comentario,autor_comentario,id_publicacao,id_ong)
                VALUES(:comentario, :autor,:id_publicacao,:id_ong)");
                $statement->bindVAlue(':comentario', $comentario);
                $statement->bindVAlue(':autor', $autor_comentario);
                $statement->bindVAlue(':id_publicacao', $id);
                $statement->bindVAlue(':id_ong', $id_ong);
                $statement->execute();

                
                $sql2 = "SELECT * from ongs WHERE id_ong = '$id_ong'";
                $sql2 = $pdo->prepare($sql2);
                $sql2->execute();
                $dado2 = $sql2->fetch();
                $fotoAt = $dado2['foto_ong'];


                $sql = "UPDATE comentarios SET foto_usuario='$fotoAt' WHERE id_ong = '$id_ong'";
                $sql = $pdo->prepare($sql);
                $sql->execute();  
            }
          

            
           
            header("location: ../ComentarioForm.php?id=$id");