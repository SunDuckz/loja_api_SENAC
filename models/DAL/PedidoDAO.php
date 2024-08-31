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
        }

?>