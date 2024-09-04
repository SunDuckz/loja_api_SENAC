<?php
    require_once 'DAL/ProdutoDAO.php';

    class ProdutoModel {
        public ?int $idProduto;
        public ?string $descricaoProduto;
        public ?float $precoProduto;

        public function __construct(
            ?int $idProduto = null,
            ?string $descricaoProduto = null,
            ?float $precoProduto = null,
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

        public function getProduto(){
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->getProdutoById($this);
        }
        public function create() {
            $produtoDAO = new ProdutoDAO;

            return $produtoDAO->createProduto($this);
       }
       public function update() {
        $produtoDAO = new ProdutoDAO();

        return $produtoDAO->updateProduto($this);
        }
         public function delete() {
        $produtoDAO = new ProdutoDAO();

        return $produtoDAO->deleteProduto($this);
        }
        public function validarProduto(string $descricao) {
            $produtoDAO = new ProdutoDAO();

            return $produtoDAO->getNomeProduto($descricao);
        }
    }
?>