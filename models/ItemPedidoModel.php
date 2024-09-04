<?php
    require_once 'DAL/ItemPedidoDAO.php';

    class itemPedidoModel {
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
        public function create(){
            $itemPedidoDAO = new ItemPedidoDAO;

            return $itemPedidoDAO->createItemPedido($this);
            }
        public function getItemsPedidoById($idPedido) {
            $itemPedidoDAO = new ItemPedidoDAO();

            $itens = $itemPedidoDAO->getItemsPedidoById($idPedido);

            foreach ($itens as &$item) {
                $item = new itemPedidoModel(
                    $item['id_item_pedido'],
                    $item['idProduto'],
                    $item['idPedido'],
                    $item['quantidade']
                );
            }
            return $itens;
        }
        public function getValorTotalPedido($idPedido) {
            $ItemPedidoDAO = new ItemPedidoDAO;

            return $ItemPedidoDAO->getValorTotalFromPedidoById($idPedido);

            
            foreach ($itens as &$item) {
                $item = new itemPedidoModel(
                    $item['id_item_pedido'],
                    $item['idProduto'],
                    $item['idPedido'],
                    $item['quantidade'],
                    $item['valorTotal']
                );
            }
            return $itens;
        }
        public function update() {
            $itemPedidoDAO = new ItemPedidoDAO();
    
            return $itemPedidoDAO->updateItemPedido($this);
            }
        public function delete($id_item_pedido) {
            $itemPedidoDAO = new ItemPedidoDAO();
    
            return $itemPedidoDAO->deleteItemPedido($id_item_pedido);
            }
        public function verificarSeProdutoJaEstaNoPedido(int $idPedido) {
            $itemPedidoDAO = new ItemPedidoDAO();

            return $itemPedidoDAO->verificarSeProdutoJaEstaNoPedido($idPedido);
        }
        public function updateQuantidade() {
            $itemPedidoDAO = new ItemPedidoDAO();

            return $itemPedidoDAO->updateQuantidade($this);
        }
    }
?>