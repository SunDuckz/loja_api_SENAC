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
            $validação = $usuario->validarUsuario($dados['cpfUsuario']);

            if ($validação['CPF'] >= 1) {
                return $this->showError("já existe um usuario com este CPF");
            }

            $usuario->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function getUsuarioById() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idUsuario'])) {
                return $this->showError('Você deve informar o idUsuario');
            }
            $usuarioModel = new UsuarioModel($dados['idUsuario']);

            $result = $usuarioModel->getUsuarioById();

            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }

        public function updateUsuario() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idUsuario'])) {
                return $this->showError('Você deve informar o idUsuario');
            }
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
                $dados['idUsuario'],
                $dados['nomeUsuario'],
                $dados['cpfUsuario'],
                md5($dados['senhaUsuario'])
            );

            $validacao = $usuario->validarUsuario($dados['cpfUsuario']);

            if ($validacao['CPF'] >= 1) {
                return $this->showError("já existe um usuario com este CPF");
            }


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

        private function showError(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }

?>