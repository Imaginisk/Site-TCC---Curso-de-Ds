<?php

require_once "conexao.php";
session_start();
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $autor = $_POST['autor'];
        $dataMarcada = $_POST['dataMarcada'];
        $autor_evento = $_SESSION['idOng'];
        function RandomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $n; $i++) {
	        $index = rand(0, strlen($characters) - 1);
            $randstring .= $characters[$index];
        }
        return $randstring;
    }
        if(!$titulo){
            $erros[] = "titulo não informado.";
        }

        if(!$descricao){
            $erros[] = "Sobrenome não informado.";
        }

        if(!$autor){
            $erros[] = "autor não informado.";
        }
     
        $image = $_FILES['imagemEve'] ?? null;
        $imagePath = '';

        if (!is_dir('img')) {
             mkdir('img');
        }
        

        if ($image && $image['tmp_name']) {
            $imagePath = 'img/' . RandomString(8) . '/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
        echo '<pre>';

        if(empty($erros)){
            $statement = $pdo->prepare("INSERT INTO eventos (titulo,descricao,autor,dataMarcada,imagemEvento,autor_evento)
            VALUES(:titulo,:descricao,:autor,:diaMarcado,:imagemEvento,:autor_evento)");

            $statement->bindVAlue(':titulo', $titulo);
            $statement->bindVAlue(':descricao', $descricao);
            $statement->bindVAlue(':autor', $autor);
            $statement->bindVAlue(':imagemEvento', $imagePath);
            $statement->bindVAlue(':diaMarcado', $dataMarcada);
            $statement->bindVAlue(':autor_evento', $autor_evento);
            $statement->execute();
            header('Location: ../index.php');
        }
        // Agora fazer aparecer o erro no cadastro. 
}

?>