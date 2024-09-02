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
                    "/usuario" => [ #completo
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarioById'
                    ],
                    "/cadastrar-usuario" => [ #completo
                        'controller' => 'UsuarioController',
                        'function' => 'createUsuario'
                    ],
                    "/stat" => [ #completo (até o momento)
                        'controller' => 'StatusController',
                        'function' => 'getStatusById'
                    ],
                    "/produto" => [ #completo
                        'controller' => 'ProdutoController',
                        'function' => 'getProdutoById'
                    ],
                    "/cadastrar-produto" => [ #completo
                        'controller' => 'ProdutoController',
                        'function' => 'createProduto'
                    ],
                    "/itens-pedido" => [ #completo
                        'controller' => "ItemPedidoController",
                        'function' => "getItemsPedidoById"
                    ],
                    '/cadastrar-item-pedido' => [ #completo
                        'controller' => 'ItemPedidoController',
                        'function' => 'createItemPedido'
                    ],
                    '/pedido' => [  #completo
                        'controller' => 'PedidoController',
                        'function' => 'getPedidoById'
                    ],
                    '/pedidos-pessoa' => [ #completo
                        'controller' => 'PedidoController',
                        'function' => 'getPedidoByIdUsuario'
                    ],
                    '/cadastrar-pedido' => [ #completo
                        'controller' => 'PedidoController',
                        'function' => 'createPedido'
                    ],
                    '/valor-total-pedido' => [ #completo
                        'controller' => 'ItemPedidoController',
                        'function' => 'getValorTotalFromPedidoById'
                    ]
                    ],
                'PUT' => [
                    '/editar-usuario' => [ #completo
                        'controller' => 'UsuarioController',
                        'function' => 'updateUsuario'
                    ],
                    '/editar-produto' => [ #completo
                        'controller' => 'ProdutoController',
                        'function' => 'updateProduto',
                    ],
                    '/editar-item-pedido' => [ #completo
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
                    '/excluir-usuario' => [ #completo
                        'controller' => 'UsuarioController',
                        'function' => 'deleteUsuario'
                    ],
                    '/excluir-produto' => [ #completo
                        'controller' => 'ProdutoController',
                        'function' => 'deleteProduto'
                    ],
                    '/excluir-item-pedido' => [ #completo
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

            require_once __DIR__ . '/../controller/' . $controller . '.php';

            return (new $controller)->$function();
        }
    }
?>