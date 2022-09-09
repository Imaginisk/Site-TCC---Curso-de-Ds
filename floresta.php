<?php
  include __DIR__.'/includes/header.php';
   require_once "Crud/conexao.php";
        global $pdo;
        
        $sql = "select sum(vl_ecopoints) from usuario";
        $sql = $pdo->prepare($sql);
        $sql->execute();
        $dado = $sql->fetch();
        $ecopointsSoma = $dado[0];

        
         
         
          $sql4 = "select count(nome) from usuario";
          $sql4 = $pdo->prepare($sql4);
          $sql4->execute();
          $dado4 = $sql4->fetch();
          $usuarioSoma = $dado4[0];
          $idus = $_SESSION['idusuario']??"";
?>

    <!-- Fim do Header -->
    <!-- Conteudo principal -->
   
      <!-- floresta -->  
      <div class="container-fluid">
        <div id="floresta">
          <h1 style="text-align: center; ">Floresta Virtual</h1> 
          <button type="button" style="margin-left: 80%; border-radius: 10px; display: inline;" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
            Sobre a floresta
          </button>
          <?php if(isset($_SESSION['idusuario'])) : ?>
            <button type="button" style="margin-right: 80%; border-radius: 10px; display: inline;" class="btn btn-info" data-toggle="modal" data-target="#LojaModal">
              Lojinha da floresta <i class="bi bi-cart-plus-fill"></i>
            </button>
          <?php endif ?>
          <hr />
          <?php if($usuarioSoma < 1000) :?>
            <img src="img/chão.png" alt="">
          <!-- <img src="img/floresta.jpg" alt="" style="width: 80%; height: 80%; border: 2px solid black; border-radius: 10px;"> -->
          <?php elseif($usuarioSoma > 1000):?>
            <!-- <img src="img/solo.jpg" alt=""> -->
            <img src="img/arvore.png" alt="">
            <!-- <img src="img/arvores.jpeg" alt=""> -->
            <?php else:?>
              <img src="img/arvores.jpg" alt="">
          <?php endif; ?>
      </div>
      <div class="dadosFloresta">
        <h5>Dados floresta </h5>
        <hr />
        
        <h5>Total de usuários <?php echo $dado4[0]?></h5>
        <h5>Estação</h5>
      </div>
      
      <!-- Button trigger modal -->

      <!-- Modal loja -->
              <div class="modal fade text-center" id="LojaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center" style="text-align: center" id="exampleModalLabel">Lojinha Avatares</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <img width="150px" height="150px" src="img/avatares/avatar1.jpg" alt="Avatar1">
              <a style="display: block; " onclick="return confirm('Tem certeza que deseja comprar esse avatar?');" href="includes/avatar1.php?id=<?= $idus?>">comprar</a>
              <p>100 ecopoints</p>
              <img width="150px" height="150px" src="img/avatares/avatar2.jpg" alt="Avatar2">
              <a style="display: block;"  onclick="return confirm('Tem certeza que deseja comprar esse avatar?');" href="includes/avatar2.php?id=<?= $idus?>">comprar</a>
              <p>200 ecopoints</p>
              <img width="150px" height="150px" src="img/avatares/avatar3.jpg" alt="Avatar3">
              <a style="display: block;"  onclick="return confirm('Tem certeza que deseja comprar esse avatar?');" href="includes/avatar3.php?id=<?= $idus?>">comprar</a>
              <p>300 ecopoints</p>
            </div>
            
          </div>
        </div>
      </div>
      <!-- Modal Floresta -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Floresta</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             Esta é a página da floresta virtual, aqui se concentram os ecopoints computados por todos os usuários do site, é importante demonstrarmos isso porque representa o quanto os usuários estão interagindo com os assuntos disponibilizados no site. A imagem da floresta cresce conforme os Ecopoints aumentam também. Continue engajado e aumente a floresta conosco.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php
        include __DIR__.'/includes/footer.php';
      ?>
      </div>
      
      
    