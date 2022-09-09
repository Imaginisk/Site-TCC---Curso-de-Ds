<?php
    class Eventos extends Dbh{
        public function editEvento($id){
            $sql = "SELECT * FROM eventos WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        }

        public function updatePost($tiutlo, $descricao, $autor, $id){
            $sql = "UPDATE eventos SET titulo = ?, conteudo = ?, autor = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$tiutlo, $descricao, $autor, $id]);
            header("location: index.php");
        }

        public function deleteEvento($id){
            $sql = "DELETE FROM eventos WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            header("location: index.php");
        }

    }


?>