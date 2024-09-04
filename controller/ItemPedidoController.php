<?php
    require_once './models/ItemPedidoModel.php';

    class ItemPedidoController {
        public function createItemPedido() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idProduto'])) {
                return $this->showError('Você deve informar o idProduto');
            }
            if(empty($dados['idPedido'])) {
                return $this->showError('Você deve informar o idPedido');
            }
            if(empty($dados['quantidade'])) {
                return $this->showError('Você deve informar a quantidade');
            }
            $itemPedidoModel = new itemPedidoModel(null,$dados['idProduto'],$dados['idPedido'],$dados['quantidade']);

            $verificacao = $itemPedidoModel->verificarSeProdutoJaEstaNoPedido($dados['idPedido']);

            if ($verificacao['Produto'] >= 1) {
                $result = $itemPedidoModel->updateQuantidade();
            }
            else {
                $result = $itemPedidoModel->create();
            }            
            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }

        public function getItemsPedidoById() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idPedido'])) {
                return $this->showError('Você deve informar o idPedido');
            }
            $itemPedidoModel = new itemPedidoModel();


            $produtos = $itemPedidoModel->getItemsPedidoById($dados['idPedido']);
   
           return json_encode([
               'error' => null,
               'result' => $produtos                
               ]);
        }

        public function getValorTotalFromPedidoById() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idPedido'])) {
                return $this->showError('Você deve informar o idPedido');
            }
            $itemPedidoModel = new itemPedidoModel();

            $result = $itemPedidoModel->getValorTotalPedido($dados['idPedido']);

            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }
        public function updateItemPedido() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['id_item_pedido'])) {
                return $this->showError('Você deve informar o id_item_pedido');
            }
            if(empty($dados['idProduto'])) {
                return $this->showError('Você deve informar o idProduto');
            }
            if(empty($dados['idPedido'])) {
                return $this->showError('Você deve informar o idPedido');
            }
            if(empty($dados['quantidade'])) {
                return $this->showError('Você deve informar a quantidade');
            }
            $itemPedidoModel = new itemPedidoModel(
                $dados['id_item_pedido'],
                $dados['idProduto'],
                $dados['idPedido'],
                $dados['quantidade']
            );

            $result = $itemPedidoModel->update();

            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }
        public function deleteItemPedido() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['id_item_pedido'])) {
                return $this->showError('Você deve informar o id_item_pedido');
            }
            $itemPedidoModel = new itemPedidoModel();


            $produtos = $itemPedidoModel->delete($dados['id_item_pedido']);
   
           return json_encode([
               'error' => null,
               'result' => $produtos                
               ]);
        }

        private function showError(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }
?>