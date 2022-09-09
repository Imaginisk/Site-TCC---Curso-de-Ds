<?php
    class Posts extends Dbh{
        public function getPost(){
            $sql = "SELECT * FROM posts ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            while($result = $stmt->fetchAll()){
                return $result;
            }
        }
        public function getComentario($id){
            $sql = "SELECT * FROM comentarios Where id=$id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            while($result = $stmt->fetchAll()){
                return $result;
            }
        }
       
        public function addPost($title, $body, $author,$imagePath,$autor_pub,$tag_post,$id_panela){
         
            $sql = "INSERT INTO posts(titulo,conteudo,autor,imagemPublicao,autor_pub,tag_post,id_panela) VALUES(?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title, $body, $author,$imagePath,$autor_pub,$tag_post,$id_panela]);

            header("location: {$_SERVER['HTTP_REFERER']}");
        }
        public function editPost($id){
            $sql = "SELECT * FROM posts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        }

        public function updatePost($title, $body, $author, $id){
            $sql = "UPDATE posts SET titulo = ?, conteudo = ?, autor = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$title, $body, $author, $id]);
            header("location: index.php");
        }

        public function deletePost($id){
            $sql = "DELETE FROM posts WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
           
            
            $sql2 = "DELETE FROM comentarios WHERE id_publicacao = ?";
            $stmt2 = $this->connect()->prepare($sql2);
            $stmt2->execute([$id]);
            $stmt->execute([$id]);
            
            header("location: index.php");
        }

    }


?>