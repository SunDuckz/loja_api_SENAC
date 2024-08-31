<?php
    require_once 'DAL/UsuarioDAO.php';

    class UsuarioModel {
        public ?int $idUsuario;
        public ?string $nomeUsuario;
        public ?string $cpfUsuario;
        public ?string $senhaUsuario;

        public function __construct(
            ?int $idUsuario = null,
            ?string $nomeUsuario = null,
            ?string $cpfUsuario = null,
            ?string $senhaUsuario = null
        ) {
            $this->idUsuario = $idUsuario;
            $this->nomeUsuario = $nomeUsuario;
            $this->cpfUsuario = $cpfUsuario;
            $this->senhaUsuario = $senhaUsuario;
        }
        public function getUsuarios() {
            $usuarioDAO = new UsuarioDAO();

            $usuarios = $usuarioDAO->getUsuarios();

            foreach ($usuarios as &$usuario) {
                $usuario = new UsuarioModel(
                    $usuario['idUsuario'],
                    $usuario['nomeUsuario'],
                    $usuario['cpfUsuario'],
                    $usuario['senhaUsuario']
                );
            }

            return $usuarios;
        }
        public function getUsuarioById() {}
    }
?>