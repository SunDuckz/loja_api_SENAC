<?php
    require_once './models/PedidoModel.php';

    class PedidoController {
        public function getPedidos() {
            $pedidoModel = new PedidoModel();
    
            $pedidos = $pedidoModel->getPedidos();
   
           return json_encode([
               'error' => null,
               'result' => $pedidos                
               ]);
            }
        public function getPedidoById(){
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idPedido'])) {
                return $this->showError('Você deve informar o idPedido');
            }
            $pedidoModel = new PedidoModel();

            $result = $pedidoModel->getPedido($dados['idPedido']);

            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }
        public function getPedidoByIdUsuario(){
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idUsuario'])) {
                return $this->showError('Você deve informar o idUsuario');
            }
            $pedidoModel = new PedidoModel();

            $result = $pedidoModel->getPedidoUsuario($dados['idUsuario']);

            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }

        public function createPedido() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idUsuario'])) {
                return $this->showError('Você deve informar o idUsuario');
            }
            if(empty($dados['idStatus'])) {
                return $this->showError('Você deve informar o idStatus');
            }
            $pedidoModel = new PedidoModel(null,$dados['idUsuario'],$dados['idStatus']);

            $result = $pedidoModel->create();

            return json_encode([
                'error' => null,
                'result' => $result
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