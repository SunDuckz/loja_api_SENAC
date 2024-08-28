<?php
    require_once 'Conexao.php';

    class TipoUsuarioDAO {
        public function getTiposUsuario() {
            $conexao = (new conexao())->getConnection();

            $sql = "SELECT * FROM tipousuario";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getTipoUsuario(TipoUsuarioModel $tipoUsuario) {
            $conexao = (new conexao)->getConnection();

            $sql = "SELECT * FROM tipousuario WHERE idTipoUsuario = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$tipoUsuario->idTipoUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        }
        public function updateTipoUsuario(TipoUsuarioModel $tipoUsuario) {
            $conexao = (new conexao)->getConnection();

            $sql = "UPDATE tipousuario SET descricaoTipoUsuario = :descricao WHERE idTipoUsuario = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$tipoUsuario->idTipoUsuario);
            $stmt->bindValue(":descricao",$tipoUsuario->descricaoTipoUsuario);

            return $stmt->execute();
        }
        public function delete($idTipoUsuario) {
            
        }
        
    }

?>