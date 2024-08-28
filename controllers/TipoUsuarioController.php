<?php
    require_once './models/TipoUsuarioModel.php';

    class TipoUsuarioController {
        public function getTiposUsuario() {
            $tipoUsuarioModel = new TipoUsuarioModel();

            $tiposUsuario = $tipoUsuarioModel->getTiposUsuario();

            return json_encode([
                'error' => null,
                'result' => $tiposUsuario
            ]);
        }
        public function getTipoUsuario() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idTipoUsuario'])){
                return $this->showError('Você deve informar o idTipoUsuario');
            }
                $tipoUsuarioModel = new TipoUsuarioModel($dados['idTipoUsuario']);
    
                $result = $tipoUsuarioModel->getTipoUsuario();
    
                return json_encode([
                    'error' => null,
                    'result'=> $result
                ]);
           }
           public function updateTipoUsuario() {
                $dados = json_decode(file_get_contents('php://input'),true);

                if(empty($dados['idTipoUsuario'])){
                    return $this->showError('Você deve informar o idTipoUsuario');
                }
                if(empty($dados['descricaoTipoUsuario'])){
                    return $this->showError('Você deve informar a descricaoTipoUsuario');
                }

                $tipoUsuarioModel = new TipoUsuarioModel();

                $tiposUsuario = $tipoUsuarioModel->updateTipoUsuario();

                return json_encode([
                    'error' => null,
                    'result' => $tiposUsuario
                ]);
            }
            public function deleteTipoUsuario() {
                $dados = json_decode(file_get_contents('php://input'),true);

                if(empty($dados['idTipoUsuario'])){
                    return $this->showError('Você deve informar o idTipoUsuario');
                }
                    $tipoUsuarioModel = new TipoUsuarioModel($dados['idTipoUsuario']);
        
                    $result = $tipoUsuarioModel->delete($dados['idTipoUsuario']);
        
                    return json_encode([
                        'error' => null,
                        'result'=> $result
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