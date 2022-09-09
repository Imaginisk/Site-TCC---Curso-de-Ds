<?php
    include('includes/class-autoload.inc.php');
    session_start();
    function RandomString($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $n; $i++) {
	        $index = rand(0, strlen($characters) - 1);
            $randstring .= $characters[$index];
        }
        return $randstring;
    }

    if(isset($_POST['submit'])){
        
        $image = $_FILES['imagemPub'] ?? null;
        $imagePath = '';

        // if (!is_dir('img')) {
        //     mkdir('img');
        // }

        if ($image && $image['tmp_name']) {
            $imagePath = 'img/' . RandomString(8) . '/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
          
        }
        $post = new POSTS;
        $title = $_POST['postTitulo'];
        $content = $_POST['postConteudo'];
        $author = $_POST['postAutor'];
        $autor_pub = $_SESSION['idOng']??$_SESSION['idusuario'];
        $id_panela = $_GET['id_panela'];
        $tag_post = $_POST['flexRadioDefault'];
        $post->addPost($title, $content, $author,$imagePath,$autor_pub,$tag_post,$id_panela);
    }else if(isset($_POST['update'])){
        $post = new POSTS;
        $id = $_GET['id'];
        $title = $_POST['postTitulo'];
        $content = $_POST['postConteudo'];
        $author = $_POST['postAutor'];
        $post->updatePost($title, $content, $author, $id);
    }else if($_GET["send"] === 'del'){
        $post = new POSTS;
        $id = $_GET['id'];
        $post->deletePost($id);
    }
   

?>