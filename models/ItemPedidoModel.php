<?php
    require_once 'DAL/ItemPedidoDAO.php';

    class ProdutoModel {
        public ?int $id_item_pedido;
        public ?int $idProduto;
        public ?int $idPedido;
        public ?int $quantidade;

        public function __construct(
            ?int $id_item_pedido = null,
            ?int $idProduto = null,
            ?int $idPedido = null,
            ?int $quantidade = null,
        ) {
            $this->id_item_pedido = $id_item_pedido;
            $this->idProduto = $idProduto;
            $this->idPedido = $idPedido;
            $this->quantidade = $quantidade;

        }
        
        }

?>