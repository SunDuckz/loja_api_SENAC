<?php
    require_once 'Conexao.php';
    
    class ProdutoDAO {
        public function getProdutos(){
            $conexao = (new conexao)->getConnection();

            $sql = 'SELECT * FROM produto';

            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
    }

?>