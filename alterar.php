<?php
 
 session_start();

$id = $_SESSION['idusuario'];
$alt = $_POST['alterar'];
$user = $_POST['nome'];
$senha = $_POST['senha'];
$email = $_POST['email'];

require_once "Crud/conexao.php";
 $conn = new mysqli ('localhost', 'root', '');
  mysqli_select_db($conn, 'site_ecodoor');

//   "select nome_usuario, senha from tb_usuarios where nome_usuario='$user' and senha='$pass'";
// "update tb_usuarios  set nome_usario where id= '$user' and senha='$pass'";
//UPDATE Usuario SET nome=(:nome) WHERE id=(:id)"

switch ($alt) {
    case 1:
       $sql = "UPDATE usuario SET nome='$user' WHERE id='$id'";
       $_SESSION['nome'] = $user;
        break;
    case 2:
       $sql = "UPDATE usuario SET senha='$senha' WHERE email='$email'";
        break;
    case 3:
       $sql = "UPDATE usuario SET email='$user' WHERE id='$id'";
       $_SESSION['email'] = $email;
        break;
}


if ($conn->query($sql) === TRUE) {
   header('Location: perfil.php');
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();

?>