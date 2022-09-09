<?php
  include __DIR__.'/includes/header.php';
   include('./includes/class-autoload.inc.php');
  
  if(!isset($_SESSION['idusuario']) && !isset($_SESSION['idadm']) && !isset($_SESSION['idOng'])){
     header('Location: index.php');
  }
    if(isset($_SESSION['idusuario'])) : $idus = $_SESSION['idusuario']; else : $idus = $_SESSION['idOng'];  endif;
   
?>

    <!-- Fim do Header -->
    <!-- Conteudo principal -->

    <!-- Slide Menu -->
    <!-- Button trigger modal -->


  
    <div class="cssgrid">
      <?php if(isset($_SESSION['idusuario'])) : ?>
        <?php 
           include "Crud/conexao.php";
          $sql2 = "select * from usuario where id='$idus'";
          $sql2 = $pdo->prepare($sql2);
          $sql2->execute();
          $dado2 = $sql2->fetch();
                
          ?>
      <!-- Perfil -->
      <div class="perfil text-center" style="background-color:white">
        <img
          width="200px"
          height="200px"
          class="mt-3"
          src="<?= $dado2['foto_usuario']?>"
          alt="Foto"
          style="border-radius: 50%;"
        />
        <h3 class="mt-3" ><?= $dado2['nome'] ?? "" ?> <?= $dado2['sobrenome']?? "" ?></h3>
        <a href="editarPerfil.php?id=<?= $idus?>" type="button" class="btn btn-primary" >
              Editar perfil
        </a>
        
        <h5 >Ecopoints: <?= $dado2['ecopoints']??"" ?> </h5>
        <h4 class="" style="display:inline;"><?= $dado2['email'] ?? "" ?></h4>
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
      <?php else : ?>
         <?php 
          include "Crud/conexao.php";
          $sql2 = "select * from ongs where id_ong='$idus'";
          $sql2 = $pdo->prepare($sql2);
          $sql2->execute();
          $dado2 = $sql2->fetch();
                
          ?>
        <div class="perfil text-center" style="background-color:white">
        <img
          width="200px"
          height="200px"
          class="mt-3"
          src="<?= $dado2['foto_ong']?>"
          alt="Foto"
          style="border-radius: 50%;"
        />
        <h3 class="mt-3" ><?= $dado2['nome_ong']  ?> </h3>
        <a href="editarPerfil.php?id=<?= $idus?>" type="button" class="btn btn-primary" >
              Editar perfil
        </a>
        
        <h5 >Ecopoints: <?= $dado2['email_ong']??"" ?> </h5>
        <h4 class="" style="display:inline;">Pix: <?= $dado2['pix_ong'] ?? "" ?></h4>
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
      <?php endif ?>
       <!-- Modal -->
        <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Editar perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="alterar.php" method="POST">                                                            
                        <div class="form-gourp">
                            <label for="nomeUsuario">Alterar Nome de usuário: </label><br>
                           <label  for="alt" class="radio-inline"><input type="radio" name="alterar" value=1 id="alt" > novo nome de usuário </label>
                            <input type="text" class="form-control" name="nome" id="nomeUsuario"><br>
                        </div>
                        <div class="form-gourp">
                            <label for="senha">Alterar Senha: </label><br>
                             <label  for="alt" class="radio-inline"><input type="radio" name="alterar" value=2 id="alt" > nova senha:</label>
                            <input type="password" class="form-control" name="senha" id="senha"><br>
                        </div>
                        <div class="form-gourp">                           
                            <label for="email">Alterar Email: </label><br>
                             <label  for="alt" class="radio-inline"><input type="radio" name="alterar" value=3 id="alt" > novo email:</label>
                            <input type="text" class="form-control" name="email" id="email"><br>
                        </div>
                        <form action="Crud/proc_upload.php" method="post" enctype="multipart/form-data">
                        <input type="file" class="btn btn-primary" name="image">
                          <input type="submit" value="Alterar foto">
                        </form>
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
