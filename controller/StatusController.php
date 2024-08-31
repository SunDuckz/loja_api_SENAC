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


        private function showError(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }
    }