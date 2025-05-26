<?php

namespace App\Daos;

use App\Clases\Database;

class PedidoDao
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($idPago, $idUsuario, $totalPedido, $ivaPedido, $subtotalPedido)
    {

        try {
            $sql = "INSERT INTO TBL_PEDIDOS (ID_USUARIO, FECHA, METODO_PAGO, ESTATUS, TOTAL, IVA, SUBTOTAL)
                VALUES (:IDUSUARIO, CURDATE(), :METODOPAGO, 'PENDIENTE', :TOTALPEDIDO, :IVAPEDIDO, :SUBTOTALPEDIDO)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':IDUSUARIO', $idUsuario);
            $stmt->bindParam(':METODOPAGO', $idPago);
            $stmt->bindParam(':TOTALPEDIDO', $totalPedido);
            $stmt->bindParam(':IVAPEDIDO', $ivaPedido);
            $stmt->bindParam(':SUBTOTALPEDIDO', $subtotalPedido);
            $stmt->execute();

            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            echo "Error al crear usuario: " . $e->getMessage();
            return false;
        }

        /*
        try {
            // Iniciar la transacción
            $this->db->beginTransaction();

            // Crear la tabla temporal para los cálculos
            $createTempTableSql = "CREATE TEMPORARY TABLE TEMP_CART AS
            SELECT C.ID_ARTICULO, C.CANTIDAD, A.PRECIO
            FROM TBL_CARRITO AS C
            JOIN TBL_ARTICULOS  AS A ON C.ID_ARTICULO = A.ID
            WHERE C.ID_USUARIO = :IDUSUARIO";

            // Preparar y ejecutar la consulta para crear la tabla temporal
            $stmt = $this->db->prepare($createTempTableSql);
            $stmt->bindParam(':IDUSUARIO', $idUsuario);
            $stmt->execute();

            // Calcular SUBTOTAL, IVA y TOTAL
            $calculateTotalsSql = "SELECT 
            SUM(A.PRECIO * C.CANTIDAD) AS SUBTOTAL,
            SUM(A.PRECIO * C.CANTIDAD) * 0.16 AS IVA,
            SUM(A.PRECIO * C.CANTIDAD) * 1.16 AS TOTAL
            FROM TEMP_CART";

            // Preparar y ejecutar la consulta para calcular los totales
            $stmt = $this->db->prepare($calculateTotalsSql);
            $stmt->execute();
            $totals = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($totals === false) {
                error_log("Error fetching totals");
                $this->db->rollBack();
                return false;
            }

            error_log("Totales: " . print_r($totals, true));


            // Insertar el pedido en TBL_PEDIDOS
            $insertPedidoSql = "INSERT INTO TBL_PEDIDOS (ID_USUARIO, FECHA, METODO_PAGO, ESTATUS, TOTAL, IVA, SUBTOTAL)
            VALUES (:USUARIO, CURDATE(), :PAGO, :PENDIENTE, :TOTAL, :IVA, :SUBTOTAL)";

            $metodoPago = $pedido->getMetodoPago();
            $estatus = $pedido->getEstatus();
            $total = $totals['TOTAL'];
            $iva = $totals['IVA'];
            $subtotal = $totals['SUBTOTAL'];

            $stmt = $this->db->prepare($insertPedidoSql);
            $stmt->bindParam(':USUARIO', $idUsuario);
            $stmt->bindParam(':PAGO', $metodoPago);
            $stmt->bindParam(':PENDIENTE', $estatus);
            $stmt->bindParam(':TOTAL', $total);
            $stmt->bindParam(':IVA', $iva);
            $stmt->bindParam(':SUBTOTAL', $subtotal);
            $stmt->execute();

            // Obtener el ID del nuevo pedido
            $idPedido = $this->db->lastInsertId();

            // Insertar los detalles del pedido usando la función createDetalle
            //$this->createDetalle($idUsuario, $idPedido);

            // Confirmar la transacción
            $this->db->commit();

            return $idPedido;
        } catch (\PDOException $e) {
            // Revertir la transacción en caso de error
            $this->db->rollBack();
            error_log("Error al crear pedido: " . $e->getMessage());
            return false;
        }
            */
    }

    public function createDetalle($idUsuario, $idPedido, $idarticulo, $cantidad, $importe)
    {
        try {
            // Insert details into TBL_DETALLE_PEDIDO
            $sql = "INSERT INTO TBL_DETALLE_PEDIDO (ID_PEDIDO, ID_ARTICULO, CANTIDAD, IMPORTE)
                    VALUES (:IDPEDIDO, :IDARTICULO, :CANTIDADPEDIDO, :IMPORTEPEDIDO)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':IDPEDIDO', $idPedido, \PDO::PARAM_INT);
            $stmt->bindParam(':IDARTICULO', $idarticulo, \PDO::PARAM_INT);
            $stmt->bindParam(':CANTIDADPEDIDO', $cantidad, \PDO::PARAM_INT);
            $stmt->bindParam(':IMPORTEPEDIDO', $importe, \PDO::PARAM_STR);
            $stmt->execute();
            $ultimoId =  $this->db->lastInsertId();
            // Delete user's cart items after successful insertion
            $sql = "DELETE FROM TBL_CARRITO WHERE ID_USUARIO = :IDUSUARIO";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDUSUARIO', $idUsuario, \PDO::PARAM_INT);
            $stmt->execute();

            return $ultimoId;
        } catch (\PDOException $e) {
            echo "Error al crear detalle del pedido o eliminar items del carrito: " . $e->getMessage();
            return false;
        }
    }

    public function historialPedidos($idUser)
    {
        $BloquesPedidos = array();
        try {
            $sql = "SELECT ID, FECHA, ESTATUS, SUBTOTAL, IVA, TOTAL FROM TBL_PEDIDOS WHERE ID_USUARIO = :IDUSER; ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':IDUSER', $idUser);
            $stmt->execute();

            $pedidos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Obtén todos los resultados en un array asociativo
            foreach ($pedidos as $pedido) {
                $sql = "SELECT A.ID, A.ID_PEDIDO, A.ID_ARTICULO, A.CANTIDAD, A.IMPORTE,
                B.SKU, B.NOMBRE, B.DESCRIPCION, B.MARCA, B.IMAGEN,B.PRECIO, C.NOMBRE AS MARCA FROM TBL_DETALLE_PEDIDO AS A JOIN 
               TBL_ARTICULOS AS B ON A.ID_ARTICULO = B.ID JOIN TBL_MARCAS AS C ON B.MARCA = C.ID WHERE A.ID_PEDIDO = :IDPEDIDO; ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':IDPEDIDO', $pedido['ID']);
                $stmt->execute();
                $detallePedido = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                $bloquePedido =
                    [
                        'header' => $pedido,
                        'detalle' => $detallePedido
                    ];

                $BloquesPedidos[] = $bloquePedido;
            }

            return $BloquesPedidos;

            // Obtén todos los resultados en un array asociativo
        } catch (\PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
            return false;
        }
    }
}
