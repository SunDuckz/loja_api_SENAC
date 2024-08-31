<?php
    require './models/UsuarioModel.php';

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

            if(empty($dados['nomeUsuario'])){
                return $this->showError('Você deve mostar o nomeUsuario');
            }
            if(empty($dados['cpfUsuario'])){
                return $this->showError('Você deve informar o cpfUsuario');
            }
            if(empty($dados['senhaUsuario'])){
                return $this->showError('Você deve mostar a senhaUsuario');
            }

            $usuario = new UsuarioModel (
                null,
                $dados['nomeUsuario'],
                $dados['cpfUsuario'],
                md5($dados['senhaUsuario'])
            );

            $usuario->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function getUsuarioById() {
            $dados = json_decode(file_get_contents("php://input"));

            if(empty($dados['idUsuario'])){
                return $this->showError('Você deve informar o idUsuario');
            }
            $usuarioModel = new UsuarioModel($dados['idUsuario']);

            $result = $usuarioModel->getUsuarios();

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