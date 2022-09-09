<?php
  include __DIR__.'/includes/header.php';
   include('./includes/class-autoload.inc.php');
  
  if(!isset($_SESSION['idusuario']) && !isset($_SESSION['idadm']) && !isset($_SESSION['idOng'])){
     header('Location: index.php');
  }
  $idus = $_SESSION['idusuario'];
  $email = $_GET['UserOng'];
    include "Crud/conexao.php";
    $sql = "select * from usuario where email='$email'";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    $dado = $sql->fetch();
    $cont = $sql->rowCount();

    $sql2 = "select * from ongs where email_ong='$email'";
    $sql2 = $pdo->prepare($sql2);
    $sql2->execute();
    $dado2 = $sql2->fetch();
    $cont2 = $sql2->rowCount();
    
?>

    <!-- Fim do Header -->
    <!-- Conteudo principal -->

    <!-- Slide Menu -->
    <!-- Button trigger modal -->

<?php if($cont > 0) : ?>
  
    <div class="cssgrid">
      
      <!-- Perfil -->
      <div class="perfil text-center" style="background-color:white">
        <img
          width="200px"
          height="200px"
          class="mt-3"
          src="<?= $dado['foto_usuario']?>"
          alt="Foto"
          style="border-radius: 50%;"
        />
        <h3 class="mt-3" ><?= $dado['nome'] ?? "" ?> <?= $dado['sobrenome']?? "" ?></h3>
       
        
        <h5 >Ecopoints: <?= $dado['ecopoints']??"" ?> </h5>
        <h4 class="" style="display:inline;"><?= $dado['email'] ?? "" ?></h4>
        <hr />
        <ul>
          <lu>
           
          </lu>
          <lu>Publicações salvas</lu>
          <lu>
            <!-- Button trigger modal -->
             
          </lu>
        </ul>
        <hr />
      </div>
      
      <div class="dadosUsuario mr-3">
        <h3>Ranking</h3>
        <hr />
        <p>Seguidores</p>
        <p>Seguindo</p>
        <hr />
        <p>Ongs</p>
      </div>
        
      </div>
      <?php elseif($cont2 > 0): ?>
        <div class="cssgrid">
      
      <!-- Perfil -->
      <div class="perfil text-center" style="background-color:white">
        <img
          width="200px"
          height="200px"
          class="mt-3"
          src="<?= $dado2['foto_ong']?>"
          alt="Foto"
          style="border-radius: 50%;"
        />
        <h3 class="mt-3" ><?= $dado2['nome_ong'] ?? "" ?></h3>
        
        
        <h5 >Pix: <?= $dado2['pix_ong']??"" ?> </h5>
        <h4 class="" style="display:inline;"><?= $dado2['email_ong'] ?? "" ?></h4>
        <hr />
        <ul>
          <lu>
           
          </lu>
          <lu>Publicações salvas</lu>
          <lu>
            <!-- Button trigger modal -->
             
          </lu>
        </ul>
        <hr />
      </div>
      
      <div class="dadosUsuario mr-3">
        <h3>Ranking</h3>
        <hr />
        <p>Seguidores</p>
        <p>Seguindo</p>
        <hr />
        <p>Ongs</p>
      </div>
        
      </div>
      <?php else : ?>
        <div class="alert alert-danger" role="alert">
          Usuario ou Ong não encontrado!
      </div>
      <?php endif ?>
     <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>

     <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
   
    
  </body>
</html>
