<?php

require_once "conexao.php";

$erros = [];
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
        $comentario = $_POST['comentario'];
        $autor_comentario = $_SESSION['nome'];
        if(!$comentario){
            $erros[] = "comentario não informado.";
        }

        if(empty($erros)){
            $id = $_GET['id'];
            //$num++;
            // $sql = "SELECT comentario FROM posts where id=$id";
            // $stmt = $this->connect()->prepare($sql);
            // $stmt->execute();

            // while($result = $stmt->fetchAll()){
            //     return $result;
            // }
           
            $sql4 = "SELECT count(*) FROM information_schema.columns WHERE table_name = 'comentarios'";
            $sql4 = $pdo->prepare($sql4);
            $sql4->execute();
            $dado4 = $sql4->fetch();
            $usuarioSoma = $dado4[0] - 4;


           $n = 1 + $usuarioSoma;

           $statement1 = $pdo->prepare("ALTER TABLE comentarios ADD COLUMN comentario$n VARCHAR(515)");
           $statement1->execute();
            //  $_SESSION['nome'] preciso pegar isso e dar um jeito de enviar como campo do bd
            // tipo criar um campo do comentario e dar update pondo o valor da session
           $statement2 = $pdo->prepare("UPDATE comentarios SET comentario$n='$comentario' ");
            //$statement->bindValue(':comentario', $comentario);
            $statement2->execute();

            $statement3 = $pdo->prepare("ALTER TABLE comentarios ADD COLUMN autor_comentario0 VARCHAR(515)");
            $statement3->execute();
            $statement4 = $pdo->prepare("UPDATE Comentários SET autor_comentario0='abacate' where Comentários=$id");
            $statement4->execute();

            $idUs = $_SESSION['idusuario'];
            $sql = $pdo->prepare("SELECT nome from usuario Where id=$idUs");
            $sql->execute();
            
            $userComent = $sql->fetch();
            $_SESSION['comentuser'] = $userComent[0];

            if(isset($_SESSION['idusuario'])){
                
                $sql2 = "select vl_ecopoints from usuario where id=$idUs";
                $sql2 = $pdo->prepare($sql2);
                $sql2->execute();
                $dado2 = $sql2->fetch();
                $dado2[0] += 10;  
                $sql3 = "UPDATE usuario SET vl_ecopoints = $dado2[0] WHERE id = $idUs";
                $sql3 = $pdo->prepare($sql3);
                $sql3->execute();
            }
           
            header("location: ../ComentarioForm.php?id=$id");
           
        // Agora fazer aparecer o erro no cadastro. 
        }
    }
?>