<?php
    require './models/StatusModel.php';

    class StatusController {
        public function getStatus(){
            $statusModel = new StatusModel();
    
             $status = $statusModel->getStatus();
    
            return json_encode([
                'error' => null,
                'result' => $status                
                ]);
        }

        public function getStatusById() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idStatus'])) {
                return $this->showError('Você deve informar o idStatus');
            }
            $statusModel = new StatusModel($dados['idStatus']);

            $result = $statusModel->getStatusById();

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