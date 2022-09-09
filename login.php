<?php
  include __DIR__.'/includes/header.php';
  // require_once 'vendor/autoload.php'
 
?>
  <?php if(isset($_SESSION['loginTF'])) : ?>
    <div style="text-align:center; background-color:#DC3545; padding:10px;">
      <h5>Email ou senha errados.</h5>
    </div>
    <?php session_destroy(); ?>
  <?php endif ?>
  <body>
    
    <!-- Conteudo principal -->

    <!-- Grid -->
    <div class="cssgrid">
      <!-- Login campos -->
      <div class="logoEnome">
        <img src="img/LogoEcodoor2.png" alt="" />
        <h1>Ecodoor</h1>
        <p>
          O ecodoor ajuda você a se conectar e compartilhar com as pessoas que
          fazem parte da sua vida.
        </p>
      </div>
      <form class="campos" method="POST" action="Crud/validarLogin.php">
        <label for="">Email</label>
        <input name="nomeLogin" type="text" />
        <label for="">Senha</label>
        <input name="senhaLogin" type="password" />
        <p>
          <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Esqueceu a senha?
        </a>
        </p>
        <hr />
        <div class="center">
          <button class="btn btn-outline-danger" type="submit">Entrar</button>
        </div>
      </form>
      <div class="criarcontaspace">
        <p>Não tem conta ainda? <a href="cadastro.php">Criar conta.</a></p>
        
       <input type="button" onclick="logIn()" value="Entrar com Facebook" class="btn btn-primary" >
      </div>

    <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alterar senha</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             <form action="alterar.php" method="POST">                                                            
                         <div class="form-gourp">
                            
                            <input placeholder="Seu Email" type="text" class="form-control" name="email" id="nomeUsuario"><br>
                        </div>
                        <div class="form-gourp">
                            <label for="senha">Alterar Senha: </label><br>
                             <label  for="alt" class="radio-inline"><input type="radio" name="alterar" value=2 id="alt" checked> nova senha:</label>
                            <input type="password" class="form-control" name="senha" id="senha"><br>
                        </div>
                          <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                          <div class="form-gourp">
                              <button type="submit" class="btn btn-primary">Salvar alterações</button>
                            </div>
                        </div>
                    </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- Footer -->
<script
            src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script>
        var person = { userID: "", name: "", accessToken: "", picture: "", email: ""};

        function logIn() {
            FB.login(function (response) {
                if (response.status == "connected") {
                    person.userID = response.authResponse.userID;
                    person.accessToken = response.authResponse.accessToken;

                    FB.api('/me?fields=id,name,email,picture.type(large)', function (userData) {
                        person.name = userData.name;
                        person.email = userData.email;
                        person.picture = userData.picture.data.url;

                        $.ajax({
                           url: "login.php",
                           method: "POST",
                           data: person,
                           dataType: 'text',
                           success: function (serverResponse) {
                               console.log(person);
                               //if (serverResponse == "success")
                                   //window.location = "index.php";
                           }
                        });
                    });
                }
            }, {scope: 'public_profile, email'})
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId            : '113852546010164',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v2.11'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
<?php
  include __DIR__.'/includes/footer.php';
?>
