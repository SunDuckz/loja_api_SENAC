<?php
        require_once 'Conexao.php';
    
        class PedidoDAO {
            public function getPedidos(){
                $conexao = (new conexao)->getConnection();
    
                $sql = 'SELECT * FROM pedido';
    
                $stmt = $conexao->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            }

            public function getPedidoById($idPedido){
                $conexao = (new conexao)->getConnection();

                $sql = "SELECT * FROM pedido WHERE idPedido = :id";

                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(":id",$idPedido);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            public function getPedidoByIdUsuario($idUsuario) {
                $conexao = (new conexao)->getConnection();

                $sql = "SELECT * FROM pedido WHERE idUsuario = :id";

                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(":id",$idUsuario);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            public function createPedido(PedidoModel $pedido) {
                $conexao = (new conexao)->getConnection();

                $sql = "INSERT INTO pedido VALUES (:id,:idUsuario,:idStatus)";
                $stmt = $conexao->prepare($sql);
                $stmt->bindValue(":id", null);
                $stmt->bindValue(":idUsuario",$pedido->idUsuario);
                $stmt->bindValue(":idStatus",$pedido->idStatus);
    
                return $stmt->execute();
            }


        }

?>