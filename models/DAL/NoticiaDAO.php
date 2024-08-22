<?php
    require_once 'conexao.php';
    class NoticiaDAO{
        public function getNoticias() {
            $conexao = (new Conexao())->getConnection();
            
            $sql = "SELECT * FROM noticia";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }   
        public function createNoticia(NoticiaModel $noticia) {
            $conexao = (new Conexao())->getConnection();

            $sql = "INSERT INTO noticia VALUES (:id, :idAutor, :titulo, :conteudo, :imagem)";

            $stmt = $conexao->prepare($sql);



            $stmt->bindValue(':id',null);
            $stmt->bindValue(':idAutor',$noticia->idAutor);
            $stmt->bindValue(':titulo',$noticia->tituloNoticia);
            $stmt->bindValue(':conteudo',$noticia->conteudoNoticia);
            $stmt->bindValue(':imagem',$noticia->imagemNoticia);

            return $stmt->execute();
        }   
        public function updateNoticia(NoticiaModel $noticia) {
            $conexao = (new conexao())->getConnection();

            $sql = "UPDATE noticia set idAutor = :idAutor, tituloNoticia = :titulo, conteudoNoticia = :conteudo, imagemNoticia = :imagem WHERE idNoticia = :id";

            $stmt = $conexao->prepare($sql);

            $stmt->bindValue(':id',$noticia->idNoticia);
            $stmt->bindValue(':idAutor',$noticia->idAutor);
            $stmt->bindValue(':titulo',$noticia->tituloNoticia);
            $stmt->bindValue(':conteudo',$noticia->conteudoNoticia);
            $stmt->bindValue(':imagem',$noticia->imagemNoticia);

            return $stmt->execute();
        }

        public function deleteNoticia(NoticiaModel $noticia){
            $conexao = (new Conexao())->getConnection();

            $sql = "DELETE FROM noticia WHERE idNoticia = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id',$noticia->idNoticia);

            return $stmt->execute();
        }

        public function getNoticiaPorId(NoticiaModel $noticia) {
            $conexao = (new Conexao())->getConnection();

            $sql = "SELECT * from noticia WHERE idNoticia = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id',$noticia->idNoticia);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>