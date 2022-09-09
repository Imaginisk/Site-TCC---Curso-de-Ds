<?php
  include __DIR__.'/includes/header.php';
  include('./includes/class-autoload.inc.php');
  include('Classes/user.php');
  include('Classes/posts.class.php');
   
  // global $pdo;
  // $sql = "SELECT * FROM posts";
  // $stmt = $pdo->connect()->prepare($sql);
  // $stmt->execute();

  // $result = $stmt->fetchAll();
  // $id = $result['id'];
  $i = 0;
  
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
                include('./includes/buttonEven.php');
                include('./includes/buttonPan.php');
              }else if(isset($_SESSION['idadm']) || isset($_SESSION['idOng']) || isset($_SESSION['idusuario'])){
                  include('./includes/buttonPan.php');
              }
            ?> 
            <!-- Modal Publicação-->
            

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
            <?php 
            include "Crud/conexao.php";
              $sql2 = "select * from panela";
              $sql2 = $pdo->prepare($sql2);
              $sql2->execute();
              $dado2 = $sql2->fetchAll();            
            ?>
            <div id="layoutGeral" style="margin-left: 20px;">
            <?php foreach($dado2 as $panela) :?>
              <div class="row" >
                        <div class="col-md-6 mt-4" >
                          <div id="card" class="card mx-1" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="card-body">
                            <h5 class="card-title"><?=$panela['nome_panela']?></h5>
                              <p class="card-text">
                                <?=$panela['descricao_panela']?>
                              </p>
                              <div class="cardBottom">
                                <?php 
                                  // Acessos editar e excluir publicação
                                   if(isset($_SESSION['idOng']) && $_SESSION['idOng'] == $panela['autor_panela'] || isset($_SESSION['idusuario']) && $_SESSION['idusuario'] == $panela['autor_panela']  || isset($_SESSION['idadm'])) : ?>

                                      <a href="editform.php?id=<?= $panela['id_panela']?>"  class="btn btn-warning" >Editar</a>
                                      <a onclick="return confirm('Tem certeza que deseja exclui a publicação?');" href="post.process.php?id=<?= $panela['id']?>&send=del" class="btn btn-danger">Deletar</a>

                                    <?php endif?> 
                                <a href="Publicações.php?id_panela=<?= $panela['id_panela']?>" class="btn btn-success">Acessar panela</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <!-- Ranking -->
      <div id="ranking" class="mt-2">
        <h4 class="text-center">Publicações em destaque</h4>
             <div class="row">
              <?php $usuarios = new Usuario();?>
              <?php if($usuarios->getUsuario()) :?>
                <?php foreach($usuarios->getUsuario() as $usuario) : ?>
                  <?php $i++; ?>
                  <?php  if($i == 1) : echo ""; endif;  ?>
                    <div class="row">
                      <div class="col-md-6 mt-1 ml-4 mr-4"  >
                        <div id="card" class="card mx-auto"style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
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
                      <div class="col-md-6 mt-1 mb-2 ml-2" id="linhaPost" >
                        <div id="card" class="card mx-2"  style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
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
