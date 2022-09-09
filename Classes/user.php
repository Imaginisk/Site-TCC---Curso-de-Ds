<?php
class Dbh{
    public function connect(){
       $pdo = new PDO("mysql:dbname=site_ecodoor;host=127.0.0.1", "root", "");
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
 class usuario extends Dbh{
     public function login($loginNome, $senhaUsuario){
        global $pdo;
        $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':email', $loginNome);
        $sql->bindValue(':senha', $senhaUsuario);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();

            $_SESSION['idusuario'] = $dado['id'];
            $_SESSION['nome'] = $dado['nome'];
            $_SESSION['sobrenome'] = $dado['sobrenome'];
            $_SESSION['email'] = $dado['email'];
            $_SESSION['foto'] = $dado['nome_imagem'];
            $_SESSION['logado'] = true;
            $_SESSION['ecopoints'] = $dado['vl_ecopoints'];
            return true;
        }else{
            return false;
        }
    }
    public function loginOng($loginNome, $senhaUsuario){
        global $pdo;
        $sql = "SELECT * FROM ongs WHERE email_ong = :email AND senha_ong = :senha";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':email', $loginNome);
        $sql->bindValue(':senha', $senhaUsuario);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();

            $_SESSION['idOng'] = $dado['id_ong'];
            $_SESSION['nome'] = $dado['nome_ong'];
            $_SESSION['email'] = $dado['email_ong'];
            $_SESSION['foto'] = $dado['nome_imagem'];
            $_SESSION['logado'] = true;
            return true;
        }else{
            return false;
        }
    }
     public function criarConta(){
        require_once "conexao.php";
        require_once "DadosUsuario.php";

        $erros = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
                $nome = $_POST['nome'];
                $sobrenome = $_POST['sobrenome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                
                if(!$nome){
                    $erros[] = "nome não informado.";
                }

                if(!$sobrenome){
                    $erros[] = "Sobrenome não informado.";
                }

                if(!$email){
                    $erros[] = "Email não informado.";
                }
                if(!$senha){
                    $erros[] = "Senha não informada.";
                }

                if(empty($erros)){
                    $statement = $pdo->prepare("INSERT INTO usuario (nome,sobrenome,email,senha)
                    VALUES(:nome,:sobrenome,:email,:senha)");

                    $statement->bindVAlue(':nome', $nome);
                    $statement->bindVAlue(':sobrenome', $sobrenome);
                    $statement->bindVAlue(':email', $email);
                    $statement->bindVAlue(':senha',$senha);
                    $statement->execute();
                    $_SESSION['sobrenome'] = $sobrenome;
                    $_SESSION['email'] = $email;
                }
                // Agora fazer aparecer o erro no cadastro. 
        }
       

            }
             public function getUsuario(){
                $sql = "SELECT * FROM usuario ORDER BY vl_ecopoints DESC LIMIT 5";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();

                while($result = $stmt->fetchAll()){
                    return $result;
                }
            }
            public function getEvento(){
                $sql = "SELECT * FROM eventos";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();

                while($result = $stmt->fetchAll()){
                    return $result;
                }
            }
        }
        
 ?>