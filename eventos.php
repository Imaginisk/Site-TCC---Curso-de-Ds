<?php
  include __DIR__.'/includes/header.php';
?>
  <body>
      <?php
        include "Crud/conexao.php";
        $id = $_GET['id'];
        global $pdo;
        $sql4 = "SELECT * FROM eventos WHERE id_evento=$id";
        $sql4 = $pdo->prepare($sql4);
        $sql4->execute();
        $dado4 = $sql4->fetch();
      ?>
    <div class="row text-center" style="width: 100%;">
            <div class="col-md-6 mt-1 mb-2 ml-2"  id="linhaPost">
                 <div id="card" class="card mx-2" >
                    <div class="card-body" >
                      
                            <h4 class="card-title text-center"><?=$dado4['titulo']?></h4>
                            <?php if(isset($_SESSION['idOng']) && $_SESSION['idOng'] == $dado4['autor_evento']):  ?>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLista">
                                Ver quem está interessado
                              </button>
                            <?php endif ?>

                            <h5 class="text-center"><?=$dado4['descricao']?></h5>
                            <h5 class="text-center"><?=$dado4['autor'];?></h5>
                              <img src="./Crud/<?=$dado4['imagemEvento']?>" alt="">
                            <hr>
                            <div class="cardBottom">
                              <h5>Dia</h5>
                            <h5><?=$dado4['dataMarcada']?></h5>
                            <h5 class="text-left">Interessados: <?= $dado4['confirmados']?></h5>
                            <form method="POST" action="includes/marcarPresenca.php?id=<?= $id?>">
                                <!-- Preciso de uma logica que me fa;a conseguir que o usuario n'ao consiga confirmar duas vezes presen;a -->
                                <!-- Ao apertar contagem sobe em 1, e se a contagem for maior que 0, fa;a o botao sumir e aparecer o outro botao -->
                                <!-- O outro botao vai ser o de desmarcar que fara a contagem descer em -1 -->
                                <!-- Caso esteja = a 0 o botao de marcar presenca voltara a aparecer -->
                                <!-- Notas: -->
                                <!-- A contagem precisa ser diferente para cada evento e para cada usuario -->
                                <!-- Todo evento vai ter uma variavel que comeca com 0, e sera individual para cada usuario, precisa estar logado para marcar presenca -->
                                <!-- Vai ter uma lista para as Ongs com todos que confirmaram presenca -->
                                <?php if(isset($_SESSION['idusuario'])): ?>
                                  <button onclick="marcado()" id="btnMarcaz" type="submit" class="btn btn-primary text-center" style="transition: 1s;">Vou ir</button>
                                <?php endif;?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(  isset($_SESSION['idOng']) && $_SESSION['idOng'] == $dado4['autor_evento'] || (isset($_SESSION['idadm']))) : ?>
          <button id="BtnComentVoltar" class="btn btn-secondary" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            Editar evento
          </button>
          <a href="Crud/deleteEvento.php?id=<?= $_GET['id']?>" onclick="return confirm('Tem certeza que deseja exclui o evento?');" type="button" id="BtnComent" style="margin-left: 100px;" class="btn btn-primary text-center">
            Excluir evento
          </a>
        <?php endif ?>
        
       <!-- Modal -->
      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <?php
                include 'Crud/conexao.php';
                $id = $_GET['id'];
                $sql2 = "select * from eventos where id_evento=$id;";
                $sql2 = $pdo->prepare($sql2);
                $sql2->execute();
                $dado2 = $sql2->fetch();
            ?>
            <form id="publicacaoForm" method="POST" action="Crud/editarEvento.php?id=<?= $_GET['id']?>" enctype="multipart/form-data">
                        <div class="text-left">
                          <label for="">Titulo</label>
                            <input placeholder="título" name="titulo" type="text" value=<?= $dado2['titulo']?> />
                            
                              <textarea
                                      name="descricao"
                                      class="mt-2"
                                      placeholder="Descrição"
                                      
                                      id=""
                                      cols="60"
                                      rows="10"
                                ><?=$dado2['descricao'];?></textarea>
                              <hr />
                              <label for="">Autor</label>
                              <input placeholder="autor" name="autor" type="text" value=<?=$dado2['autor']; ?> />
                              <input name="dataMarcada" type="date" value=<?= $dado2['dataMarcada'] ?>>
                              <hr>
                              <h5 class="mt-2">Mudar imagem</h5>
                              <input type="file" class="btn btn-primary" name="imagemEve">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                          <button type="submit" name="submit" class="btn btn-primary">Salvar alterações</button>
                        </div>
                  </form>
            </div>
            
          </div>
        </div>
      </div>
      <!-- Modal Lista participantes -->
      <div class="modal fade" id="modalLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Usuários</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php
                include "Crud/conexao.php";
                $sql5 = "SELECT count(*) FROM information_schema.columns WHERE table_name = 'eventos'";
                $sql5 = $pdo->prepare($sql5);
                $sql5->execute();
                $dado5 = $sql5->fetch();
                $eventosSoma = $dado5[0] - 10;
                $n = $eventosSoma + 1;
                 
                for($i=1;$i<$n;$i++){
                  
                  $id = $_GET['id'];
                  global $pdo;
                  $sql3 = "SELECT * FROM eventos WHERE id_evento=$id";
                  $sql3 = $pdo->prepare($sql3);
                  $sql3->execute();
                  $dado3 = $sql3->fetch();
                  $idUs = $dado3['id_usuario' . $i];

                  $sql4 = "SELECT nome,sobrenome FROM usuario WHERE id='$idUs'";
                  $sql4 = $pdo->prepare($sql4);
                  $sql4->execute();
                  $dado4 = $sql4->fetch();
                  if($dado4 == null){
                    
                  }else{
                    echo "<h5>" . $dado4['nome'] . " " ;
                    echo $dado4['sobrenome'] . "</h5>";
                    echo "</br>";
                  }
                }
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
        <script>
            function marcado(){
                window.alert('Obrigado por confirmar presença! 20 Ecopoints ganhos!');
                let btnMar = document.getElementById("btnMarcar");
                btnMar.innerHTML = "Confirmado";
                btnMar.style.visibility = "hidden";
            }
            
        </script>
    
    <?php
        include __DIR__.'/includes/footer.php';
      ?>
  </body>
</html>