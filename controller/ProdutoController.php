<?php
    require './models/ProdutoModel.php';

    class ProdutoController {
        public function getProdutos(){
            $produtoModel = new ProdutoModel();
    
             $produtos = $produtoModel->getProdutos();
    
            return json_encode([
                'error' => null,
                'result' => $produtos                
                ]);
        }

        public function getProdutoById() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['idProduto'])) {
                return $this->showError('Você deve informar o idProduto');
            }
            $usuarioModel = new ProdutoModel($dados['idProduto']);

            $result = $usuarioModel->getProduto();

            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }

        public function createProduto() {
            $dados = json_decode(file_get_contents("php://input"),true);

            if(empty($dados['descricaoProduto'])) {
                return $this->showError('Você deve informar a descricaoProduto');
            }
            if(empty($dados['precoProduto'])) {
                return $this->showError('Você deve informar o precoProduto');
            }
            $produtoModel = new ProdutoModel(null,$dados['descricaoProduto'],floatval($dados['precoProduto']));

            $result = $produtoModel->create();

            return json_encode([
                'error' => null,
                'result' => $result
            ]);
        }
        public function updateProduto() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idProduto'])) {
                return $this->showError('Você deve informar o idProduto');
            }
            if(empty($dados['descricaoProduto'])){
                return $this->showError('Você deve mostar o descricaoProduto');
            }
            if(empty($dados['precoProduto'])){
                return $this->showError('Você deve informar o precoProduto');
            }

            $usuario = new ProdutoModel (
                $dados['idProduto'],
                $dados['descricaoProduto'],
                $dados['precoProduto'],
            );

            $usuario->update();

            return json_encode([
                'error' => null,
                'result' => true
            ]);

        }

        public function deleteProduto() {
            $dados = json_decode(file_get_contents('php://input'),true);

            if(empty($dados['idProduto'])){
                return $this->showError('Voce deve informar o idProduto');
            }
                $usuario = new ProdutoModel($dados['idProduto']);

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