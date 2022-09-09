<?php
    require_once('./includes/header.php');
    include("./includes/class-autoload.inc.php");
    require_once "Crud/conexao.php";
    include('Classes/eventos.php');

    

    $post = new POSTS;
    $post = $post->editPost($_GET['id']);
    $title = $post['titulo'];
    $body = $post['conteudo'];
    $id = $post['id'];
    $author = $post['autor'];

   

    
    
    global $pdo;
    global $num, $id;
    $sql = "select count(*) from posts Where id=$id";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    $dado2 = $sql->fetch();
    $comentario3 = $dado2[0];
        
    $sql4 = "select count(id_publicacao) from comentarios Where id_publicacao=$id";
    $sql4 = $pdo->prepare($sql4);
    $sql4->execute();
    $dado4 = $sql4->fetch();
    $comentarioSoma = $dado4[0];
    
?>

<div class="text-center my-4" >
    <h5><?php 
    ?></h5>
     <div class="row" id="publicacoes" >
                <?php for($i=0; $i < $comentario3; $i++) : ?>
                    <div class="row" style=" width: 100%;">
                      <div class="col-md-6 mt-4">
                        <div id="card" class="card mx-2" >
                          <div class="card-body">
                            <h5 class="card-title"><?=$post['titulo']?></h5>
                            <?php if($post['imagemPublicao']=="") : ?>
                             
                              <?php else : ?>
                                 <img style="border-radius: 10px;  height: 500px; object-fit: contain;" src="<?= $post['imagemPublicao']?>">
                            <?php endif ?>
                            <p class="card-text text-justify">
                              <?=$post['conteudo']?>
                            </p>
                            <div class="cardBottom">
                              <h6 class="card-subtitle text-muted text-left"><?=$post['date_criacao']?></h6>
                              <h6 class="card-subtitle text-muted text-right">Autor: <?=$post['autor']?></h6>
                              
                            </div>
                              <div class="comentarios">
                                <?php
                                  $sql = "select * from comentarios Where id_publicacao=$id";
                                  $sql = $pdo->prepare($sql);
                                  $sql->execute();
                                  $dado = $sql->fetchAll();
                                  $count = $sql->rowCount();
                                  
                                ?>
                                <?php if($count > 0) : ?>
                                  <button onclick="dropComents(),visualizarMelhor1()"  class="btn btn-sucess" id="verComent" >Ver comentários</button>
                                  <button onclick="upComents()" class="btn btn-sucess"  id="ocultarComent" style=" ">Ocultar</button>
                                <?php else: ?>
                                 <div class="alert alert-success" role="alert">
                                  Ainda não há comentários nessa publicação. 
                                </div>
                                  <?php endif ?>

                              <?php  foreach($dado as $item) : ?>
                              <?php
                                global $pdo;
                                global $num, $id;
                                  $sql = "select conteudo_comentario from comentarios Where id_publicacao=$id";
                                  $sql = $pdo->prepare($sql);
                                  $sql->execute();
                                  $dado = $sql->fetch();
                                  $comentario2 = $dado[0]??null;
                              ?>
                               
                            <?php  if(isset($comentario2)) : ?>
                                
                                <?php include "includes/ComentarioCard.php"; ?>
                            <?php endif; ?>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
      <?php  endforeach; ?>
                              </div>
    <?php $post = new Posts();?>
    <!-- <?php $post->getPost()?> -->
    <?php if($post->getPost()) :?>
      
       
      
    <?php else :?>
      <p>Post is empty</p>
      
    <?php endif; ?>
   

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endfor; ?>
            </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seu comentário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
            <div class="col-md-7 mx-auto">
                <!-- Form input -->
                <form action="Crud/insertComent2.php? id=<?= $id?>" method="POST">
                        <div class="form-group">
                            <label>Conteudo: </label>
                            <textarea class="form-control" name="comentario" type="text" required></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="button" style="display: inline; margin-left: 10px;" class="btn btn-secondary" data-dismiss="modal" >Fechar</button>
                              <button onclick="showMesage()" style="display: inline;" type="submit" name="update" class="btn btn-primary ">Adicionar comentário</button>
                            </div>
                          
                </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
    <?php if(isset($_SESSION['idusuario']) || isset($_SESSION['idadm']) || isset($_SESSION['idOng'])) :
           
       ?>
         <a href="ComentarioForm.php" id="BtnComentVoltar" style="margin-left: 50px;" type="button" class="btn btn-secondary"  >Voltar</a>
        <button type="button" id="BtnComent"  style="margin-left: 50px;" class="btn btn-primary text-center" data-toggle="modal" data-target="#exampleModal">
              Fazer um comentário
        </button>
       <?php endif ?>

<script src="scripts/dropComents.js"></script>
<script>
  let btnVoltar = document.getElementById("BtnComentVoltar");
  let btnComent = document.getElementById("BtnComent");

function visualizarMelhor1() {
  btnVoltar.style.visibility = "hidden";
  btnComent.style.visibility = "hidden";
}
</script>
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
