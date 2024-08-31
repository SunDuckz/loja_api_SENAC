<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this ->routes = [
                'GET' =>[
                    "/usuarios" => [ #Completo
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ],
                    "/status" => [ #Completo
                        'controller' => 'StatusController',
                        'function' => 'getStatus'
                    ],
                    "/produtos" => [ #Completo
                        'controller' => 'ProdutoController',
                        'function' => 'getProdutos'
                    ],
                    "/pedidos" => [ #Completo
                        'controller' => 'PedidoController',
                        'function' => 'getPedidos'
                    ]

                ],
                'POST' => [
                    "/usuario" => [ 
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarioById'
                    ],
                    "/cadastrar-usuario" => [
                        'controller' => 'UsuarioController',
                        'function' => 'createUsuario'
                    ],
                    "/status" => [
                        'controller' => 'StatusController',
                        'function' => 'getStatusById'
                    ],
                    "/produto" => [
                        'controller' => 'ProdutoController',
                        'function' => 'getProdutoById'
                    ],
                    "/cadastrar-produto" => [
                        'controller' => 'ProdutoController',
                        'function' => 'createProduto'
                    ],
                    "/itens-pedido" => [
                        'controller' => "ItemPedidoController",
                        'function' => "getItemsPedidoById"
                    ],
                    '/cadastrar-item-pedido' => [
                        'controller' => 'ItemPedidoController',
                        'function' => 'createItemPedido'
                    ],
                    '/pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'getPedidoById'
                    ],
                    '/pedidos-pessoa' => [
                        'controller' => 'PedidoController',
                        'function' => 'getPedidoByIdUsuario'
                    ],
                    '/cadastrar-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'createPedido'
                    ],
                    '/valor-total-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'getValorTotalFromPedidoById'
                    ]
                    ],
                'PUT' => [
                    '/editar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'updateUsuario'
                    ],
                    '/editar-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'updateProduto',
                    ],
                    '/editar-item-pedido' => [
                        'controller' => 'ItemPedidoController',
                        'function' => 'updateItemPedido'
                    ],
                    '/editar-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'updatePedido'
                    ],
                    '/editar-status-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'updateStatusPedido'
                    ]
                   
                    ],
                'DELETE' => [
                    '/excluir-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'deleteUsuario'
                    ],
                    '/excluir-produto' => [
                        'controller' => 'ProdutoController',
                        'function' => 'deleteProduto'
                    ],
                    '/excluir-item-pedido' => [
                        'controller' => 'ItemPedidoController',
                        'function' => 'deleteItemPedido'
                    ],
                    '/excluir-pedido' => [
                        'controller' => 'PedidoController',
                        'function' => 'deletePedido'
                    ]
                ]
            ];

        }

        public function handleRequest(string $method, string  $route): string {
            $routeExists = !empty($this->routes[$method][$route]);
            
            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!',
                    'result' => null 
                ]);
            }
            $routeInfo = $this->routes[$method][$route];
            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];

            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            return (new $controller)->$function();
        }
    }
?>