<?php
    require_once 'Conexao.php';

    class UsuarioDAO {
        public function getUsuarios() {
            $conexao = (new conexao)->getConnection();

            $sql = 'SELECT * FROM usuario';

            $stmt = $conexao->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
            }
            
        public function getUsuarioById(UsuarioModel $usuario) {
            $conexao = (new conexao)->getConnection();

            $sql = 'SELECT * FROM usuario WHERE idUsuario = :id';

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":id",$usuario->idUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            public function createUsuario(UsuarioModel $usuario) {
                $conexao = (new conexao())->getConnection();
                $sql = "INSERT INTO usuario VALUES (:id,:nome,:cpf,:senha)";
        
                $stmt = $conexao->prepare($sql);
        
                $stmt->bindValue(":id",null);
                $stmt->bindValue(':nome',$usuario->nomeUsuario);
                $stmt->bindValue(':cpf',$usuario->cpfUsuario);
                $stmt->bindValue(':senha',$usuario->senhaUsuario);

                return $stmt->execute();
            }
            public function updateUsuario(UsuarioModel $usuario) {
                $conexao = (new conexao())->getConnection();
    
                $sql = "UPDATE usuario SET nomeUsuario = :nome, cpfUsuario = :cpf,senhaUsuario = :senha WHERE idUsuario = :id";
    
                $stmt = $conexao->prepare($sql);
                $stmt->bindValue(":id",$usuario->idUsuario);
                $stmt->bindValue(':nome',$usuario->nomeUsuario);
                $stmt->bindValue(':cpf',$usuario->cpfUsuario);
                $stmt->bindValue(':senha',$usuario->senhaUsuario);
    
                return $stmt->execute();
            }
            public function deleteUsuario(UsuarioModel $usuario) {
                $conexao = (new conexao())->getConnection();
    
                $sql = "DELETE FROM usuario Where idUsuario = :id";
    
                $stmt = $conexao->prepare($sql);
                $stmt->bindValue(":id",$usuario->idUsuario);
    
                return $stmt->execute();
            }
        }
        
?>