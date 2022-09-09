<?php

require_once "conexao.php";
session_start();
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
        $nome_panela = $_POST['nome_panela'];
        $descricao = $_POST['descricao'];
         if(isset($_SESSION['idusuario'])) : $autor_pan = $_SESSION['idusuario']; else : $autor_pan = $_SESSION['idOng'];  endif;

       
            $statement = $pdo->prepare("INSERT INTO panela (nome_panela,descricao_panela,autor_panela)
            VALUES(:nome, :descricao, :autor)");

            $statement->bindVAlue(':nome', $nome_panela);
            $statement->bindVAlue(':descricao', $descricao);
            $statement->bindVAlue(':autor', $autor_pan);
            $statement->execute();
            header('Location: ../index.php');
        // Agora fazer aparecer o erro no cadastro. 
}

?>