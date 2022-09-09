<?php

class adm extends usuario{


     public function loginAdm($loginNome,$senhaUsuario){
        global $pdo;
        $sql = "SELECT * FROM adm WHERE email = :email AND senha = :senha";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':email', $loginNome);
        $sql->bindValue(':senha', $senhaUsuario);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();

            $_SESSION['idadm'] = $dado['id'];
            $_SESSION['nome'] = $dado['email'];
            $_SESSION['logado'] = true;
            return true;
        }else{
            return false;
        }
    }
}   