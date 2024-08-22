<?php
    require_once './models/AutorModel.php';

    class AutorController {
        public function getAutores() {
            $autorModel = new AutorModel();

            $response = $autorModel->getAutores();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }
        public function createAutor(){
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['nomeAutor'])){
                return $this->showError('Você deve informar o nomeAutor');
            }

            $autor = new AutorModel(
                null,
                $dados['nomeAutor']
            );
            $response = $autor->create();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }
        public function deleteAutor() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idAutor'])){
                return $this->showError('Você deve informar o idAutor');
        }
        
        $noticia = new AutorModel($dados['idAutor']);
    
        $response = $noticia->delete();
        return json_encode([
            'error' => null,
            'result' => $response
        ]);           
    }

    public function updateAutor() {
        $dados = json_decode(file_get_contents('php://input'),true);
        if (empty($dados['idAutor'])) {
            return $this->showError('Você deve informar o idAutor');
        }
        
        if(empty($dados['nomeAutor'])){
            return $this->showError('Você deve informar o nomeAutor');
        }

        $autor = new AutorModel(
            $dados['idAutor'],
            $dados['nomeAutor']
        );

        $response = $autor->update();
        
        return json_encode([
            'error' => null,
            'result' => $response
        ]);
    }

    public function getAutorPorId() {
        $dados = json_decode(file_get_contents('php://input'),true);
        if (empty($dados['idAutor'])) {
            return $this->showError('Você deve informar o idAutor');
        }

        $autor = new AutorModel($dados['idAutor']);

        $result = $autor->getAutor();
        
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