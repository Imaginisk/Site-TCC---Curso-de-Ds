<?php
session_start();

if (isset($_POST['nomeLogin']) && !empty($_POST['nomeLogin']) && isset($_POST['senhaLogin']) && !empty($_POST['senhaLogin'])){
    
    require_once "conexao.php";
    require_once "../classes/user.php";
    require_once "../classes/adm.php";
    
    $u = new usuario;
    $loginNome = addslashes($_POST["nomeLogin"]);
    $senhaUsuario = addslashes($_POST["senhaLogin"]);
    
    if($loginNome == 'adm@hotmail.com'){
        $a = new adm;
        if($a->loginAdm($loginNome,$senhaUsuario) == true){
        if(isset($_SESSION['idadm'])){
            header("location: ../home.php");
        }else{
            header("location: ../login.php");
        }
        
        }else{
            header("location: ../login.php");
        }
    }else{
        if(($u->login($loginNome,$senhaUsuario) == true) || ($u->loginOng($loginNome,$senhaUsuario) == true)){
        if(isset($_SESSION['idusuario']) || isset($_SESSION['idOng'])){
            header("location: ../home.php");
        }else{
            header("location: ../login.php");
        }
        
        }else{
            header("location: ../login.php");
            
        }
    }
    

}else{

    header ('location: ../login.php');  
    $_SESSION['loginTF'] = "a";
}

?>