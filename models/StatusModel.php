<?php
    require_once 'DAL/StatusDAO.php';

    class StatusModel {
        public ?int $idStatus;
        public ?string $descricaoStatus;

        public function __construct(
            ?int $idStatus = null,
            ?string $descricaoStatus = null,
        ) {
            $this->idStatus = $idStatus;
            $this->descricaoStatus = $descricaoStatus;
        }
        public function getStatus() {
            $statusDAO = new StatusDAO();

            $status = $statusDAO->getStatus();

            foreach ($status as &$stat) {
                $stat = new StatusModel(
                    $stat['idStatus'],
                    $stat['descricaoStatus']
                );

            }

            return $status;
        }
    }

?>