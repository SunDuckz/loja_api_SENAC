<?php
        require_once 'DAL/PedidoDAO.php';

        class PedidoModel {
            public ?int $idPedido;
            public ?int $idUsuario;
            public ?int $idStatus;
    
            public function __construct(
                ?int $idPedido = null,
                ?int $idUsuario = null,
                ?int $idStatus = null,
            ) {
                $this->idPedido = $idPedido;
                $this->idUsuario = $idUsuario;
                $this->idStatus = $idStatus;
    
            }
            public function getPedidos() {
                $pedidoDAO = new PedidoDAO();
    
                $pedidos = $pedidoDAO->getPedidos();
    
                foreach ($pedidos as &$pedido) {
                    $pedido = new PedidoModel(
                        $pedido['idPedido'],
                        $pedido['idUsuario'],
                        $pedido['idStatus'],
                    );
    
                }
    
                return $pedidos;
            }
            public function getPedido($idPedido) {
                $pedidoDAO = new PedidoDAO;

                return $pedidoDAO->getPedidoById($idPedido);
            }

            public function getPedidoUsuario($idUsuario){
                $pedidoDAO = new PedidoDAO();
    
                $pedidos = $pedidoDAO->getPedidoByIdUsuario($idUsuario);
    
                foreach ($pedidos as &$pedido) {
                    $pedido = new PedidoModel(
                        $pedido['idPedido'],
                        $pedido['idUsuario'],
                        $pedido['idStatus'],
                    );
    
                }
    
                return $pedidos;
            }

            public function create() {
                $pedidoDAO = new PedidoDAO;

                return $pedidoDAO->createPedido($this);
            }
        }

?>