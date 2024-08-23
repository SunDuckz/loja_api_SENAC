<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this ->routes = [
                'GET' =>[
                    '/noticias' => [
                        'controller' => 'NoticiaController',
                        'function' => 'getNoticias'
                    ],
                    '/autores' => [
                        'controller' => 'AutorController',
                        'function' => 'getAutores'
                    ],
                    '/usuarios' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ],
                ],
                'POST' => [
                    '/criar-noticia' => [
                        'controller' => 'NoticiaController',
                        'function' => 'createNoticia'
                    ],
                    '/cadastrar-autor' => [
                        'controller' => 'AutorController',
                        'function' => 'createAutor'
                    ],
                    '/criar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'createUsuario'
                    ],
                    '/noticia' => [
                        'controller' => 'NoticiaController',
                        'function' => 'getNoticiaPorId'
                    ],
                    '/autor' => [
                        'controller' => 'AutorController',
                        'function' => 'getAutorPorId'
                    ],
                    '/usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarioPorId'
                    ],
                    '/validar-email' => [
                        'controller' => 'UsuarioController',
                        'function' => 'validateEmail'
                    ],
                    '/login' => [
                        'controller' => 'UsuarioController',
                        'function' => 'validateUsuario'
                    ]

                    ],
                'PUT' => [
                    '/atualizar-noticia'=> [
                        'controller' => 'NoticiaController',
                        'function' => 'updateNoticia'
                    ],
                    '/editar-autor' => [
                        'controller' => 'AutorController',
                        'function' => 'updateAutor'
                    ],
                    '/atualizar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'updateUsuario'
                    ]
                    
                    ],
                'DELETE' => [
                    '/excluir-noticia' => [
                        'controller' => 'NoticiaController',
                        'function' => 'deleteNoticia'
                    ],
                    '/excluir-autor' => [
                        'controller' => 'AutorController',
                        'function' => 'deleteAutor'
                    ],
                    '/excluir-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'deleteUsuario'
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