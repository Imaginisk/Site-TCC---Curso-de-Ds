<?php
    include('includes/class-autoload.inc.php');
    include('Classes/eventos.php');

    if(isset($_POST['submit'])){
        $post = new POSTS;
        $id = $_GET['id'];
        $title = $_POST['postTitulo'];
        $content = $_POST['postConteudo'];
        $author = $_POST['postAutor'];
        $post->addPost($title, $content, $author);
    }else if(isset($_POST['update'])){
        $post = new POSTS;
        $id = $_GET['id'];
        $title = $_POST['postTitulo'];
        $content = $_POST['postConteudo'];
        $author = $_POST['postAutor'];
        $post->updatePost($title, $content, $author, $id);
    }else if($_GET["send"] === 'del'){
        $eventos = new Eventos;
        $id = $_GET['id'];
        $eventos->deleteEvento($id);
    }
   

?>