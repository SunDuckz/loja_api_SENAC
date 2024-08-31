<?php
    require_once 'DAL/ProdutoDAO.php';

    class ProdutoModel {
        public ?int $idProduto;
        public ?string $descricaoProduto;
        public ?float $precoProduto;

        public function __construct(
            ?int $idProduto = null,
            ?string $descricaoProduto = null,
            ?int $precoProduto = null,
        ) {
            $this->idProduto = $idProduto;
            $this->descricaoProduto = $descricaoProduto;
            $this->precoProduto = $precoProduto;

        }
        public function getProdutos() {
            $produtoDAO = new ProdutoDAO();

            $produtos = $produtoDAO->getProdutos();

            foreach ($produtos as &$produto) {
                $produto = new ProdutoModel(
                    $produto['idProduto'],
                    $produto['descricaoProduto'],
                    $produto['precoProduto'],
                );

            }

            return $produtos;
        }
    }
?>