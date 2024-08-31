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
    }

?>