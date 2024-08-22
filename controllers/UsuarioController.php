<?php
    require_once './models/UsuarioModel.php';

    class UsuarioController {
        public function getUsuarios(){
            $usuarioModel = new UsuarioModel();

            $usuarios = $usuarioModel->getUsuarios();

            return json_encode([
                'error' => null,
                'result' => $usuarios
            ]);
        }
        public function createUsuario() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idTipoUsuario'])){
                return $this->showError('Você deve informar o idTipoUsuario');
            }
            if(empty($dados['nomeUsuario'])){
                return $this->showError('Você deve mostar o nomeUsuario');
            }
            if(empty($dados['emailUsuario'])){
                return $this->showError('Você deve informar o emailUsuario');
            }
            if(empty($dados['senhaUsuario'])){
                return $this->showError('Você deve mostar a senhaUsuario');
            }

            $usuario = new UsuarioModel (
                null,
                $dados['idTipoUsuario'],
                $dados['nomeUsuario'],
                $dados['emailUsuario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }
        public function updateUsuario() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idUsuario'])) {
                return $this->showError('Você deve informar o idUsuario');
            }

            if(empty($dados['idTipoUsuario'])){
                return $this->showError('Você deve informar o idTipoUsuario');
            }
            if(empty($dados['nomeUsuario'])){
                return $this->showError('Você deve mostar o nomeUsuario');
            }
            if(empty($dados['emailUsuario'])){
                return $this->showError('Você deve informar o emailUsuario');
            }
            if(empty($dados['senhaUsuario'])){
                return $this->showError('Você deve mostar a senhaUsuario');
            }

            $usuario = new UsuarioModel (
                $dados['idUsuario'],
                $dados['idTipoUsuario'],
                $dados['nomeUsuario'],
                $dados['emailUsuario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);

        }

        public function deleteUsuario() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idUsuario'])){
                return $this->showError('Voce deve informar o idUsuario');
            }
                $usuario = new UsuarioModel($dados['idUsuario']);

                $usuario->delete();

                return json_encode([
                    'error' => null,
                    'result' => true
                ]);
        }
        public function getUsuarioPorId(){
            $dados = json_decode(file_get_contents('php://input'),true);
            if (empty($dados['idUsuario'])) {
                return $this->showError("Você deve informar o idUsuario");
            }
            $usuario = new UsuarioModel($dados['idUsuario']);

            $result = $usuario->getUsuario();

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