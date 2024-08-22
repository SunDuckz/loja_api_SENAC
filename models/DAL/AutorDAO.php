<?php
    require_once 'Conexao.php';
    class AutorDAO {
        public function getAutores(){
            $conexao = (new conexao)->getConnection();

            $sql = 'SELECT * FROM autor';

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function createAutor(AutorModel $autor){
            $conexao = (new conexao())->getConnection();

            $sql = "INSERT INTO autor VALUES (:id,:nome)";
            $stmt = $conexao->prepare($sql);

            $stmt->bindValue(":id",null);
            $stmt->bindValue(":nome",$autor->nomeAutor);

            return $stmt->execute();
         }

         public function deleteAutor(AutorModel $autor) {
            $conexao = (new conexao())->getConnection();

            $sql = "DELETE FROM autor WHERE idAutor = :idAutor";
            $stmt = $conexao->prepare($sql);

            $stmt->bindValue(":idAutor",$autor->idAutor);

            return $stmt->execute();
         }

         public function updateAutor(AutorModel $autor) {
            $conexao = (new conexao())->getConnection();

            $sql = "UPDATE autor SET nomeAutor = :nome WHERE idAutor = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$autor->idAutor);
            $stmt->bindValue(":nome",$autor->nomeAutor);

            return $stmt->execute();
         }
         public function getAutorPorId(AutorModel $autor) {
            $conexao = (new conexao())->getConnection();

            $sql = "SELECT * FROM autor WHERE idAutor = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id',$autor->idAutor);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
         }
    }

?>