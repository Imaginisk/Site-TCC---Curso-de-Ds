<div class="row text-center" id="comentario" style=" visibility: hidden; height: 10px; margin-bottom: 70px;  transition: 2s;">
                              <div class="col-md-6 mt-1 mb-2 ml-2"  id="linhaPost">
                                <div id="card"  class="card mx-2" style="height: 100%; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                                  <div class="card-body">
                                    <p class="card-text">
                                      <h5> <?php 
                                            
                                            $sql = "select conteudo_comentario from comentarios Where id_publicacao=$id";
                                            $sql = $pdo->prepare($sql);
                                            $sql->execute();
                                            $dado = $sql->fetchAll();
                                           
                                               
                                                  echo $item['conteudo_comentario'];
                                            
                                            
                                            
                                            $num++;
                                            /*Eu preciso fazer com que ele mostre o conteudo dos comentarios aqui
                                              preciso que ele mostre o conteudo do array igual a posição do i da contagem
                                            */
                                          ?>
                                          <!-- <?php 
                                            // $sql2 = "select autor_comentario from comentarios Where id_publicacao=$id";
                                            // $sql2 = $pdo->prepare($sql2);
                                            // $sql2->execute();
                                            // $dado2 = $sql2->fetch();
                                            // $comentario3 = $dado2[0];
                                            // echo $comentario3;
                                           ?> -->
                                      </h5>
                                    </p>
                                    <hr>
                                    <div class="cardBottom">
                                   
                                    <h5 style="display: inline; "><?=  $item['autor_comentario'];  ?></h5> 
                                    <img style="display: inline; text-align: right; border-radius: 50%" width="100px" height="100px"  src="<?= $item['foto_usuario'] ?>" alt="">
                                    
                                    <h6 style="display: inline; "><?=  $item['data_comentario']; ?></h6>
                                    <?php if(isset($_SESSION['idusuario']) && $_SESSION['idusuario'] == $item['id_usuario'])  : ?>
                                      <?php $idEditComent = $item['id_comentario'];  ?>
                                          <?php
                                          
                                              $sql = "select conteudo_comentario from comentarios Where id_comentario=$idEditComent";
                                              $sql = $pdo->prepare($sql);
                                              $sql->execute();
                                              $dadoX = $sql->fetch();
                                           ?>
                                              <!-- Modal -->
                                      
                                        
                                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          
                                        </div>
                                        <div class="text-center my-4">
                                            <h2>Editar Comentario</h2>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-7 mx-auto">
                                                <!-- Form input -->
                                                <form action="Includes/editComent.php?id=<?= $item['id_comentario']?>" method="POST">
                                                        
                                                        <div class="form-group">
                                                            <label>Conteudo: </label>
                                                            <textarea class="form-control" name="ComentarioConteudo" type="text"  required><?= $dadoX[0]; ?></textarea>
                                                        </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                              <button type="submit" name="update" class="btn btn-primary ">Atualizar publicação</button>
                                                          </div>
                                                          </form>
                                            </div>
                                        </div>
                                        
                                      </div>
                                    </div>
                                  </div>

                                      <button style=" " type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModalCenter">
                                        Editar comentario
                                    </button>
                                    <a  style=" " href="Crud/deleteComent.php?id=<?= $item['id_comentario']?>" onclick="return confirm('Tem certeza que deseja exclui o comentario?');" type="button" class="btn btn-danger" >
                                      Excluir comentario
                                    </a>
                                    <?php endif ?> 
                                
                                   
                                   
                                   
                                    