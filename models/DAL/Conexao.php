<?php
    class conexao {
        private PDO $conexao;
        public function __construct() {
            $this->conexao = new PDO('mysql:host=localhost;dbname=db_jornal', 'root', '');
        }

        public function getConnection(): PDO {
            return $this->conexao;
        }
    }
?>