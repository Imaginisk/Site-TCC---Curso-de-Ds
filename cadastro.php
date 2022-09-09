<?php
  include __DIR__.'/includes/header.php';
 

require_once "Crud/conexao.php";

$erros = [];
?>
<div style="background-color:#71B371; padding:10px; text-align:center;">


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if(!$nome){
            echo $erros[] = "<h5> nome não informado. </h5>";
        }

        if(!$sobrenome){
          echo  $erros[] = "<h5>Sobrenome não informado.</h5>";
        }
            

        if(!$email){
            echo $erros[] = "<h5> Email não informado. </h5>";
        }
        if(!$senha){
           echo $erros[] = "<h5>Senha não informada. </h5>";
        }

        if(empty($erros)){
            $statement = $pdo->prepare("INSERT INTO usuario (nome,sobrenome,email,senha,foto_obtida0,foto_usuario)
            VALUES(:nome,:sobrenome,:email,:senha,:foto,:foto_usuario)");
            $fotoCaminho = "img/avatares/seed.jpg";

            $statement->bindVAlue(':nome', $nome);
            $statement->bindVAlue(':sobrenome', $sobrenome);
            $statement->bindVAlue(':email', $email);
            $statement->bindVAlue(':senha',$senha);
            $statement->bindVAlue(':foto',$fotoCaminho);
            $statement->bindVAlue(':foto_usuario',$fotoCaminho);
            $statement->execute();

        }
        
        // Agora fazer aparecer o erro no cadastro. 
}


?>
</div>
    <!-- Fim do Header -->
    <!-- Conteudo principal -->

    <!-- Slide Menu -->
    <div class="cssgrid">
      <!-- Posts -->

      <!-- Cadastro -->

      <form class="cadastroform " method="POST">
        <img src="img/LogoEcodoor2.png" alt="" />
        <p>Cadastre-se e venha ser uma semente na nossa comunidade.</p>
        <a href="cadastroOng.php">Desejar criar uma conta ONG?</a>
        <hr />
        <input name="email" placeholder="Número de celular ou email" type="text" />
        <input name="nome"  placeholder="Nome" type="text" />
        <input name="sobrenome"  placeholder="Sobrenome" type="text" />
        <input  name="senha" id="password" type="password" placeholder="Senha" onkeyup='check();' onchange='check_pass();' />
        <input  type="password" name="confirm_password" placeholder="Confirme a senha" id="confirm_password" onchange='check_pass();'  onkeyup='check();' /> 
        <span id='message'></span>

       <input  class="btn btn-outline-danger" type="submit" name="submit"  value=" Cadastre-se"  id="submit" disabled/>
        
      </form>
      <div class="loginspace">
        <p>Já tem conta? <a href="login.php">Logar.</a></p>
      </div>
      <!-- Footer -->
      <script>
        var check = function() {
            if (document.getElementById('password').value ==
              document.getElementById('confirm_password').value) {
              document.getElementById('message').style.color = 'green';
              document.getElementById('message').innerHTML = 'Senhas são iguais';
            } else {
              document.getElementById('message').style.color = 'red';
              document.getElementById('message').innerHTML = 'Senha não são iguais';
            }
          }

          function check_pass() {
              if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
                  document.getElementById('submit').disabled = false;
              } else {
                  document.getElementById('submit').disabled = true;
              }
          }
      </script>
    <?php
      include __DIR__.'/includes/footer.php';
    ?>