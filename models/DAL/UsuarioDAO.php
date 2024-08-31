<?php
    require_once 'Conexao.php';

    class UsuarioDAO {
        public function getUsuarios() {
            $conexao = (new conexao)->getConnection();

            $sql = 'SELECT * FROM usuario';

            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        }
    }
?>