<?php
    require_once 'Conexao.php';

    class ItemPedidoDAO {
        public function createItemPedido(itemPedidoModel $itemPedido) {
            $conexao = (new conexao)->getConnection();

            $sql = "INSERT INTO item_pedido VALUES (:id,:idProd,:idPedido,:quantidade)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",null);
            $stmt->bindValue(":idProd",$itemPedido->idProduto);
            $stmt->bindValue(":idPedido",$itemPedido->idPedido);
            $stmt->bindValue(":quantidade",$itemPedido->quantidade);

            return $stmt->execute();

        }
        public function getItemsPedidoById($idPedido) {
            $conexao = (new conexao)->getConnection();

            $sql = "SELECT * FROM item_pedido WHERE idPedido = :idPedido";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue("idPedido",$idPedido);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getValorTotalFromPedidoById($idPedido) {
            $conexao = (new conexao)->getConnection();

            $sql = "SELECT ip.*,ip.quantidade * p.precoProduto as valorTotal from item_pedido ip left join produto p on ip.idProduto = p.idProduto where ip.idPedido = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":id",$idPedido);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateItemPedido(itemPedidoModel $itemPedido) {
            $conexao = (new conexao)->getConnection();

            $sql = "UPDATE item_pedido SET idProduto = :idProd ,idPedido = :idPedido, quantidade = :quantidade WHERE id_item_pedido = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$itemPedido->id_item_pedido);
            $stmt->bindValue(":idProd",$itemPedido->idProduto);
            $stmt->bindValue(":idPedido",$itemPedido->idPedido);
            $stmt->bindValue(":quantidade",$itemPedido->quantidade);

            return $stmt->execute();
        }
        public function deleteItemPedido($id_item_pedido) {
            $conexao = (new conexao())->getConnection();

            $sql = "DELETE FROM item_pedido Where id_item_pedido = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(":id",$id_item_pedido);

            return $stmt->execute();
        }
    }

?>