<?php
  include __DIR__.'/includes/header.php';
 

require_once "Crud/conexao.php";

$erros = [];
?>
<div style="background-color:#DC3545; padding:10px; text-align:center;">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome_ong = $_POST['nome_ong'];
        $email_ong = $_POST['email_ong'];
        $senha_ong = $_POST['senha_ong'];
        $pix_ong = $_POST['pix_ong'];
        $cnpj_ong = $_POST['cnpj_ong'];

        if(!$nome_ong){
            echo $erros[] = "<h5> nome não informado. </h5>";
        }

        if(!$pix_ong){
          echo  $erros[] = "<h5>Pix não informado.</h5>";
        }
            

        if(!$email_ong){
            echo $erros[] = "<h5> Email não informado. </h5>";
        }
        if(!$senha_ong){
           echo $erros[] = "<h5>Senha não informada. </h5>";
        }
        if(!$cnpj_ong){
          echo $erros[] = "<h5>Cnpj não informado. </h5>";
       }

        if(empty($erros)){
            $statement = $pdo->prepare("INSERT INTO ongs (nome_ong,pix_ong,email_ong,senha_ong,foto_ong,cnpj)
            VALUES(:nome,:pix,:email,:senha, :foto, :cnpj)");
            $foto = "img/avatares/avatar_ong.jpg";
            $statement->bindVAlue(':nome', $nome_ong);
            $statement->bindVAlue(':email', $email_ong);
            $statement->bindVAlue(':senha',$senha_ong);
            $statement->bindVAlue(':pix',$pix_ong);
            $statement->bindVAlue(':foto',$foto);
            $statement->bindVAlue(':cnpj',$cnpj_ong);
            $statement->execute();
            header('Location: login.php');
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
        
        <hr />
        <input name="email_ong" placeholder="Número de celular ou email" type="text" />
        <input name="nome_ong"  placeholder="Nome" type="text" />
        
        <input  name="senha_ong" id="password" type="password" placeholder="Senha" onkeyup='check();' onchange='check_pass();' />
        <input  type="password" name="confirm_password" placeholder="Confirme a senha" id="confirm_password" onchange='check_pass();'  onkeyup='check();' /> 
        <span id='message' style="display: block;"></span>

      

        <input name="pix_ong"  placeholder="Pix" type="text" >
        <input name="cnpj_ong" type="text"  placeholder="CNPJ" onblur="validarCNPJ(this)">

        <input  class="btn btn-outline-danger" type="submit" name="submit"  value=" Cadastre-se"  id="submit" disabled/>
       </button>
        
        
        
      </form>
      <div class="loginspace">
        <p>Já tem conta? <a href="login.php">Logar.</a></p>
      </div>
      <!-- Footer -->

      <!-- Button trigger modal -->



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5>As doações serão feitas através da chave pix.</h5>
          </div>
          
      </div>
    </div>
  </div>                                
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

          function _cnpj(cnpj) {
                cnpj = cnpj.replace(/[^\d]+/g, '');
                if (cnpj == '') return false;
                if (cnpj.length != 14)
                return false;
                if (cnpj == "00000000000000" ||
                cnpj == "11111111111111" ||
                cnpj == "22222222222222" ||
                cnpj == "33333333333333" ||
                cnpj == "44444444444444" ||
                cnpj == "55555555555555" ||
                cnpj == "66666666666666" ||
                cnpj == "77777777777777" ||
                cnpj == "88888888888888" ||
                cnpj == "99999999999999")
                return false;
                tamanho = cnpj.length - 2
                numeros = cnpj.substring(0, tamanho);
                digitos = cnpj.substring(tamanho);
                soma = 0;
                pos = tamanho - 7;
                for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                pos = 9;
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(0)) return false;
                tamanho = tamanho + 1;
                numeros = cnpj.substring(0, tamanho);
                soma = 0;
                pos = tamanho - 7;
                for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2)
                pos = 9;
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(1))
                return false;
                return true;
          }
          function validarCNPJ(el){
            if( !_cnpj(el.value) ){
            alert("CNPJinválido!" + el.value);
            // apaga o valor
            el.value = "";
            }
          }
      </script>
    <?php
      include __DIR__.'/includes/footer.php';
    ?>