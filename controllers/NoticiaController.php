<?php
    require_once  './models/NoticiaModel.php';
    class NoticiaController {
        public function getNoticias() {
            $noticiaModel = new NoticiaModel();

            $result = $noticiaModel->getNoticias();

            return json_encode([
                'error' => null,
                'result'=> $result
            ]);
        }
        public function createNoticia() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if (empty($dados['idAutor'])) {
                return $this->showError('Você deve informar o IdAutor');
           }
            if (empty($dados['tituloNoticia'])) {
                return $this->showError('Você deve informar o titulo Noticia');
            }
            if (empty($dados['conteudoNoticia'])) {
                return $this->showError('Você deve informar o conteudoNoticia');
            }
            $noticia = new NoticiaModel(
            null,
            $dados['idAutor'],
            $dados['tituloNoticia'],
            $dados['conteudoNoticia'],
            $dados['imagemNoticia']
            );

            $result = $noticia->create();

            return json_encode([
                'error' => null,
                'result' => $result
            ]);

        }
        public function updateNoticia() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idNoticia'])){
                return $this->showError('Você deve informar o idNoticia');
            }

            if (empty($dados['idAutor'])) {
                return $this->showError('Você deve informar o IdAutor');
           }
            if (empty($dados['tituloNoticia'])) {
                return $this->showError('Você deve informar o titulo Noticia');
            }
            if (empty($dados['conteudoNoticia'])) {
                return $this->showError('Você deve informar o conteudoNoticia');
            }
            $noticia = new NoticiaModel(
                $dados['idNoticia'],
                $dados['idAutor'],
                $dados['tituloNoticia'],
                $dados['conteudoNoticia'],
                $dados['imagemNoticia']
            );

            $result = $noticia->update();
            
            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }

        public function deleteNoticia() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idNoticia'])){
                return $this->showError('Você deve informar o idNoticia');
            }
                $noticia = new NoticiaModel($dados['idNoticia']);
    
                $result = $noticia->delete();
                return json_encode([
                    'error' => null,
                    'result' => $result
                ]);           

        }

        public function getNoticiaPorId() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idNoticia'])){
                return $this->showError('Você deve informar o idNoticia');
            }
                $noticiaModel = new NoticiaModel($dados['idNoticia']);
    
                $result = $noticiaModel->getNoticia();
    
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