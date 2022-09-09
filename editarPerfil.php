<?php
    require_once('./includes/header.php');
    include "Crud/conexao.php";
    $id = $_GET['id'];
   
?>

<div class="text-center my-4">
    <h2>Editar perfil</h2>
</div>
<?php if(isset($_SESSION['idusuario'])) : ?>
    <?php 
        $sql2 = "select * from usuario where id='$id'";
        $sql2 = $pdo->prepare($sql2);
        $sql2->execute();
        $dado2 = $sql2->fetch();
    ?> 

<div class="row text-center">
    <div class="col-md-7 mx-auto">
        <!-- Form input -->
         <form action="Crud/editarPerfil.php?id=<?= $id?>" style="background-color:white; padding:20px;" method="POST">
         <div class="form-group" style="display:inline;">
                    <img
                        width="150px"
                        height="150px"
                        class="mt-3"
                        src="<?= $dado2['foto_usuario']?>"
                        alt="Foto"
                        style="border-radius: 50%;"
                    />
                    <button type="button" style="margin-left: 42%; margin-right: 80%; border-radius: 10px; display: inline;" class="btn btn-info" data-toggle="modal" data-target="#LojaModal">
                        Mudar avatar <i class="bi bi-cart-plus-fill"></i>
                    </button>
                </div>
                <div class="form-group" >
                    <label>Nome </label>
                    <input class="form-control" name="nome" type="text" value=<?= $dado2['nome']; ?> required>
                    <label>Sobrenome </label>
                    <input class="form-control" name="sobrenome" type="text" value=<?= $dado2['sobrenome']; ?> required>
                </div>
                <div class="form-group">
                    <label>Email </label>
                    <input class="form-control" name="email" type="text" value=<?= $dado2['email']; ?> required>
                </div>
                <div class="form-group">
                    <label>Senha </label>
                    <input class="form-control" name="senha" type="text" value=<?= $dado2['senha']; ?> required>
                </div>
                    <a href="perfil.php" type="button" class="btn btn-secondary mt-3" >Voltar</a>
                    <button type="submit" name="update" class="btn btn-primary mt-3">Atualizar perfil</button>
            </form>
    </div>
</div>
<?php else : ?>
     <?php 
        $sql2 = "select * from ongs where id_ong='$id'";
        $sql2 = $pdo->prepare($sql2);
        $sql2->execute();
        $dado2 = $sql2->fetch();
    ?> 

<div class="row text-center">
    <div class="col-md-7 mx-auto">
        <!-- Form input -->
         <form action="Crud/editarPerfil.php?id=<?= $id?>" style="background-color:white; padding:20px;" method="POST">
         <div class="form-group" style="display:inline;">
                    <img
                        width="150px"
                        height="150px"
                        class="mt-3"
                        src="<?= $dado2['foto_ong']?>"
                        alt="Foto"
                        style="border-radius: 50%;"
                    />
                    <button type="button" style="margin-left: 42%; margin-right: 80%; border-radius: 10px; display: inline;" class="btn btn-info" data-toggle="modal" data-target="#LojaModal">
                        Mudar avatar <i class="bi bi-cart-plus-fill"></i>
                    </button>
                </div>
                <div class="form-group" >
                    <label>Nome </label>
                    <input class="form-control" name="nome" type="text" value=<?= $dado2['nome_ong']; ?> required>
                    <label>Sobrenome </label>
                    <input class="form-control" name="sobrenome" type="text" value=<?= $dado2['pix_ong']; ?> required>
                </div>
                <div class="form-group">
                    <label>Email </label>
                    <input class="form-control" name="email" type="text" value=<?= $dado2['email_ong']; ?> required>
                </div>
                <div class="form-group">
                    <label>Senha </label>
                    <input class="form-control" name="senha" type="text" value=<?= $dado2['senha_ong']; ?> required>
                </div>
                    <a href="perfil.php" type="button" class="btn btn-secondary mt-3" >Voltar</a>
                    <button type="submit" name="update" class="btn btn-primary mt-3">Atualizar perfil</button>
            </form>
    </div>
</div>
<?php endif ?>
<!-- Modal avatar -->
<div class="modal fade" id="LojaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Seus avatares</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php 
                  $sql5 = "SELECT count(*) FROM information_schema.columns WHERE table_name = 'eventos'";
                  $sql5 = $pdo->prepare($sql5);
                  $sql5->execute();
                  $dado5 = $sql5->fetch();
                  $eventosSoma = $dado5[0] - 7;
              ?>
              <?php for($i=0; $i<= 3; $i++) : ?>
                    <a href="includes/mudarAvatar.php?img=<?= $dado2['foto_obtida' . $i] ?>"><img
                        width="150px"
                        height="150px"
                        class="mt-3"
                        src="<?= $dado2['foto_obtida' . $i]??"img/avatares/Não obtido.png" ?>"
                        alt="Não obtido."
                        style="border-radius: 50%;"
                    /></a>
                <?php endfor; ?>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
</div>
<!-- <?php
    require_once('./includes/footer.php');
?> -->