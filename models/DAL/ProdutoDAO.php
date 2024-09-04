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
        public function createProduto(ProdutoModel $produto) {
            $conexao = (new conexao)->getConnection();

            $sql = "INSERT INTO produto VALUES (:id,:descricao,:preco)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id", null);
            $stmt->bindValue(":descricao",$produto->descricaoProduto);
            $stmt->bindValue(":preco",$produto->precoProduto);

            return $stmt->execute();
        }
        public function getProdutoById(ProdutoModel $produto){
            $conexao = (new conexao)->getConnection();

            $sql = "SELECT * FROM produto WHERE idProduto = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$produto->idProduto);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function updateProduto(ProdutoModel $produto) {
            $conexao = (new conexao())->getConnection();

            $sql = "UPDATE produto SET descricaoProduto = :descricao, precoProduto = :preco WHERE idProduto = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$produto->idProduto);
            $stmt->bindValue(':descricao',$produto->descricaoProduto);
            $stmt->bindValue(':preco',$produto->precoProduto);

            return $stmt->execute();
        }
        public function deleteProduto(ProdutoModel $produto) {
            $conexao = (new conexao())->getConnection();

            $sql = "DELETE FROM produto Where idProduto = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$produto->idProduto);

            return $stmt->execute();
        }

        public function getNomeProduto(string $descricaoProduto) {
            $conexao = (new conexao)->getConnection();

            $sql = "SELECT count(descricaoProduto) as descricao From produto WHERE descricaoProduto = :descricao";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam("descricao",$descricaoProduto);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }
    }

?>