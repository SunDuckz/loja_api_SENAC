<?php
    require './models/ProdutoModel.php';

    class ProdutoModel {
        public function getProdutos(){
            $produtoModel = new ProdutoModel();
    
             $produtos = $produtoModel->getProdutos();
    
            return json_encode([
                'error' => null,
                'result' => $produtos                
                ]);
        }
    }

?>