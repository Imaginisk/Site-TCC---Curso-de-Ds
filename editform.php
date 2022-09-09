<?php
    require_once('./includes/header.php');
    include("./includes/class-autoload.inc.php");

    $post = new POSTS;
    $post = $post->editPost($_GET['id']);
    $title = $post['titulo'];
    $body = $post['conteudo'];
    $id = $post['id'];
    $author = $post['autor'];
?>

<div class="text-center my-4">
    <h2>Editar publicação</h2>
</div>

<div class="row">
    <div class="col-md-7 mx-auto">
        <!-- Form input -->
         <form action="post.process.php?id=<?= $id?>" method="POST">
                <div class="form-group">
                    <label>Titulo: </label>
                    <input class="form-control" name="postTitulo" type="text" value=<?= $title; ?> required>
                </div>
                <div class="form-group">
                    <label>Conteudo: </label>
                    <textarea class="form-control" name="postConteudo" type="text" required><?=$body?></textarea>
                </div>
                <div class="form-group">
                    <label>Autor: </label>
                    <input class="form-control" name="postAutor" type="text" value=<?= $author;?> required>
                </div>
                    <a href="index.php" type="button" class="btn btn-secondary mt-3" >Voltar</a>
                    <button type="submit" name="update" class="btn btn-primary mt-3">Atualizar publicação</button>
            </form>
    </div>
</div>
<!-- <?php
    require_once('./includes/footer.php');
?> -->