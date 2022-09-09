<?php
  include __DIR__.'/includes/header.php';
  include('./includes/class-autoload.inc.php');
  include('Classes/user.php');
  include('Classes/posts.class.php');
  
?>

    <!-- Fim do Header -->
    <!-- Conteudo principal -->

    <!-- Slide Menu -->
    <div class="cssgrid">
      <!-- Posts -->
      <div id="conteudo" class="post">
        <div class="container">
            <!-- Button trigger modal -->
           <?php 
              if(isset($_SESSION['idadm']) || isset($_SESSION['idOng'])){
              
               include('./includes/buttonPub.php');
              }else if(isset($_SESSION['idadm']) || isset($_SESSION['idOng']) || isset($_SESSION['idusuario'])){
                include('./includes/buttonPub.php');
              }
            ?> 
            <!-- Modal Publicação-->
            <div class="modal fade" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar nova publicação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                   <!-- Publicação form -->
                    <form id="publicacaoForm" method="POST" action="post.process.php?id_panela=<?= $_GET['id_panela'] ?>" enctype="multipart/form-data">
                        <div class="text-left">
                          <label for="">Titulo</label>
                            <input placeholder="Titulo" name="postTitulo" type="text" />
                              <textarea
                                      name="postConteudo"
                                      class="mt-2"
                                      placeholder="Conteudo"
                                      
                                      id=""
                                      cols="60"
                                      rows="10"
                                ></textarea>
                              <hr />
                              <label for="">Autor</label>
                              <input placeholder="Autor" name="postAutor" type="text">
                              <hr>
                              <div class="dropdown">
                                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Marcação da publicação
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                    <div class="form-check">
                                          <input class="form-check-input" type="radio" value="Meio-ambiente" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                          <label class="form-check-label" for="flexRadioDefault1">
                                            Meio-ambiente
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" value="Ecologia" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                          <label class="form-check-label" for="flexRadioDefault2">
                                            Ecologia
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input class="form-check-input" value="Reciclagem" type="radio" name="flexRadioDefault" id="flexRadioDefault3" >
                                          <label class="form-check-label" for="flexRadioDefault3">
                                            Reciclagem
                                          </label>
                                        </div>
                                    </ul>
                                  </div>
                              <h5 class="mt-2">Adicionar imagem a sua publicação</h5>
                              <input type="file" class="btn btn-primary" name="imagemPub">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                          <button type="submit" name="submit" class="btn btn-primary">Adicionar publicação</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Marcar evento -->
              <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Marcar novo evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="publicacaoForm" method="POST" action="Crud/insertEvento.php" enctype="multipart/form-data">
                        <div class="text-left">
                          <label for="">Titulo</label>
                            <input placeholder="título" name="titulo" type="text" />
                            
                              <textarea
                                      name="descricao"
                                      class="mt-2"
                                      placeholder="Descrição"
                                      
                                      id=""
                                      cols="60"
                                      rows="10"
                                ></textarea>
                              <hr />
                              <label for="">Autor</label>
                              <input placeholder="autor" name="autor" type="text">
                              <input name="dataMarcada" type="date">
                              <hr>
                              <h5 class="mt-2">Adicionar imagem</h5>
                              <input type="file" class="btn btn-primary" name="imagemEve">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                          <button type="submit" name="submit" class="btn btn-primary">Adicionar seu evento</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>
           <div id="layoutPub" >
           
           <div class="row" id="publicacoes">
              <?php $posts = new Posts();?>
              <!-- Por pesquisa -->
              <?php if(isset($_GET['q'])) : ?>
                <?php 
                global $pdo;
                include "Crud/conexao.php";
                  $q = $_GET['q'];
                   $sql2 = "select * from posts where titulo='$q'";
                   $sql2 = $pdo->prepare($sql2);
                   $sql2->execute();
                   $dado2 = $sql2->fetch();
                ?>
                     <div class="row">
                        <div class="col-md-6 mt-4" >
                          <div id="card" class="card mx-1" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="card-body">
                            <h5 class="card-title"><?=$item4['titulo']?></h5>
                              
                              <img style="max-width: 100%; width: 100%; height: 500px; object-fit: cover;" src="<?=$item4['imagemPublicao']?>">
                              <p class="card-text">
                              </p>
                              <div class="cardBottom">
                                <h6 class="card-subtitle text-muted text-left"><?=$item4['date_criacao']?></h6>
                                <h6 class="card-subtitle text-muted text-right">Autor: <?=$item4['autor']?></h6>
                                <a href="comentarioForm.php?id=<?= $item4['id']?>" type="button" class="btn btn-primary">Acessar publicação</a>
                                  <?php 
                                  // Acessos editar e excluir publicação
                                   if(isset($_SESSION['idOng']) && $_SESSION['idOng'] == $post['autor_pub'] || isset($_SESSION['idusuario']) && $_SESSION['idusuario'] == $post['autor_pub']  || isset($_SESSION['idadm'])) : ?>
                                      <a href="editform.php?id=<?= $item4['id']?>"  class="btn btn-warning" >Editar</a>
                                      <a onclick="return confirm('Tem certeza que deseja exclui a publicação?');" href="post.process.php?id=<?= $post['id']?>&send=del" class="btn btn-danger">Deletar</a>
                                    <?php endif?> 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
              <!-- Por tag -->
                <?php elseif(isset($_GET['tag'])): ?>    
                  <?php 
                global $pdo;
                include "Crud/conexao.php";
                  $tag = $_GET['tag'];
                   $sql2 = "select * from posts where tag_post='$tag'";
                   $sql2 = $pdo->prepare($sql2);
                   $sql2->execute();
                   $dado2 = $sql2->fetchAll();
                ?>
                <?php  foreach($dado2 as $item4) : ?>
                      <div class="row">
                        <div class="col-md-6 mt-4" style="">
                          <div id="card" class="card mx-1">
                            <div class="card-body">
                            <h5 class="card-title"><?=$item4['titulo']?></h5>
                              
                              <img style="max-width: 100%; width: 100%; height: 500px; object-fit: cover;" src="<?=$item4['imagemPublicao']?>">
                              <p class="card-text">
                                <!-- <?=$item4['conteudo']?> -->
                              </p>
                              <div class="cardBottom">
                                <h6 class="card-subtitle text-muted text-left"><?=$item4['date_criacao']?></h6>
                                <h6 class="card-subtitle text-muted text-right">Autor: <?=$item4['autor']?></h6>
                                <a href="comentarioForm.php?id=<?= $item4['id']?>" type="button" class="btn btn-primary">Acessar publicação</a>
                                  <?php 
                                  // Acessos editar e excluir publicação
                                   if(isset($_SESSION['idOng']) && $_SESSION['idOng'] == $post['autor_pub'] || isset($_SESSION['idusuario']) && $_SESSION['idusuario'] == $post['autor_pub']  || isset($_SESSION['idadm'])) : ?>
                                      <a href="editform.php?id=<?= $item4['id']?>"  class="btn btn-success" >Editar</a>
                                      <a onclick="return confirm('Tem certeza que deseja exclui a publicação?');" href="post.process.php?id=<?= $post['id']?>&send=del" class="btn btn-success">Deletar</a>
                                    <?php endif?> 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  <?php  endforeach; ?>
              <!-- Publicações padrão -->
                <?php else: ?>
                  <?php if($posts->getPost()) :?>
                    <?php 
                        include "Crud/conexao.php";
                        $id_panela = $_GET['id_panela'];
                        $sql2 = "select * from posts where id_panela=$id_panela";
                        $sql2 = $pdo->prepare($sql2);
                        $sql2->execute();
                        $dado2 = $sql2->fetchAll();      
                    ?>
                  <?php foreach($dado2 as $post) : ?>
                      <div class="row">
                        <div class="col-md-6 mt-4" >
                          <div id="card" class="card mx-1" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="card-body">
                            <h4 class="card-title"><?=$post['titulo']?></h4>
                              <p class="card-text">
                              </p>
                              <?php if($post['imagemPublicao']=="") : ?>
                               
                               <?php else : ?>
                                <img style="width: 100%; height: 400px; object-fit: contain;"src="<?=$post['imagemPublicao']?>">
                                <?php endif ?>
                              <div class="cardBottom">
                                <h6 class="card-subtitle text-muted text-left"><?=$post['date_criacao']?></h6>
                                <h6 class="card-subtitle text-muted text-right">Autor: <?=$post['autor']?></h6>
                                <a href="comentarioForm.php?id=<?= $post['id']?>" type="button" class="btn btn-success">Acessar publicação</a>
                                  <?php 
                                  // Acessos editar e excluir publicação
                                    if(isset($_SESSION['idOng']) && $_SESSION['idOng'] == $post['autor_pub'] || isset($_SESSION['idusuario']) && $_SESSION['idusuario'] == $post['autor_pub']  || isset($_SESSION['idadm'])) : ?>
                                      <a href="editform.php?id=<?= $post['id']?>"  class="btn btn-warning" >Editar</a>
                                      <a onclick="return confirm('Tem certeza que deseja exclui a publicação?');" href="post.process.php?id=<?= $post['id']?>&send=del" class="btn btn-danger">Deletar</a>
                                    <?php endif?> 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                <?php else :?>
                  <p>Não há publicações.</p>
                <?php endif; ?>
                <?php endif ?>
            </div>
        </div>
        </div>
     
      </div>
      <!-- Ranking -->
      <div id="ranking" class="mt-2">
        <h4 class="text-center">Ranking</h4>
             <div class="row">
              <?php $usuarios = new Usuario();?>
              <?php if($usuarios->getUsuario()) :?>
                <?php foreach($usuarios->getUsuario() as $usuario) : ?>
                    <div class="row">
                      <div class="col-md-6 mt-1 ml-4 mr-4" >
                        <div id="card" class="card mx-2">
                          <div class="card-body">
                            <h5 class="card-title"><?=$usuario['nome'] . " " . $usuario['sobrenome']?></h5>
                            <p class="card-text">
                              <h5><?=$usuario['vl_ecopoints']?></h5>
                              <h5>Ecopoints</h5>
                            </p>
                            <div class="cardBottom">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
              <?php else :?>
                <p>Post is empty</p>
              <?php endif; ?>
            </div>
      </div>
     
      <div class="eventos mt-2">
        <h5>Eventos marcados</h5>
        <div class="marcados">
        <div class="row">
              <?php $usuarios = new Usuario();?>
              <?php if($usuarios->getEvento()) :?>
                <?php foreach($usuarios->getEvento() as $usuario) : ?>
                    <div class="row">
                      <div class="col-md-6 mt-1 mb-2 ml-2" id="linhaPost">
                        <div id="card" class="card mx-2" >
                          <div class="card-body">
                            <h5 class="card-title"><?=$usuario['titulo']?></h5>
                            <h5><?=$usuario['autor']?></h5>
                            <p class="card-text">
                            </p>
                            <hr>
                            <div class="cardBottom">
                            <h5><?=$usuario['dataMarcada']?></h5>
                            <a href="eventos.php?id=<?= $usuario['id_evento']?>">Ver mais sobre</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
              <?php else :?>
                <p>Não há eventos marcados</p>
              <?php endif; ?>
            </div>
        </div>
        
      </div>
        <!--Comentários  -->
        <!-- Modal -->
          <!-- Modal -->
        <div class="modal fade" id="addPanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crie sua panela</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                 <form id="publicacaoForm" method="POST" action="Crud/insertPan.php" enctype="multipart/form-data">
                        <div class="text-left">
                            <input placeholder="título" name="nome_panela" type="text" />
                            
                              <textarea
                                      name="descricao"
                                      class="mt-2"
                                      placeholder="Descrição"
                                      
                                      id=""
                                      cols="60"
                                      rows="10"
                                ></textarea>
                              <hr />
                              <label for="">Autor</label>
                              <input placeholder="autor" name="autor" type="text">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                          <button type="submit" name="submit" class="btn btn-primary">Adicionar seu evento</button>
                        </div>
                  </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script>
      
    </script>
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
  </body>
</html>
