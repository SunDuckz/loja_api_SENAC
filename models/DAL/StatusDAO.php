<?php
    require_once 'Conexao.php';

    class StatusDAO {
        public function getStatus() {
            $conexao = (new conexao)->getConnection();

            $sql = "SELECT * FROM stat";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function  getStatusById(StatusModel $status) {
            $conexao = (new conexao)->getConnection();
        
            $sql = "SELECT * FROM stat WHERE idStatus = :id";
        
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$status->idStatus);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }


?>