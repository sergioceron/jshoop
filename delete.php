<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Quita un producto del carrito de compras
 *              id        : Obligatorio (id del producto)
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";

$_validator = new Validator();
$_validator->setMethod("GET");
$_validator->setVars(array("id:required"));

if ($_validator->validate()) {
    $values = $_validator->getValues();
    if ($login == 1) {
        // Aumentamos el producto eliminado a la cantidad de articulos
        $pid = $db->get_var("select articulo_id from compras where usuario_id=" . $_SESSION["user_id"] . " and compra_id=" . base64_decode($values["id"]) . " and compra_estado=0");
        $db->query("update articulos set articulo_cantidad=articulo_cantidad+1 where articulo_id=$pid");

        $db->query("delete from compras where usuario_id=" . $_SESSION["user_id"] . " and compra_id=" . base64_decode($values["id"]) . " and compra_estado=0");
        $productos = $db->get_results("select * from compras where usuario_id=" . $_SESSION["user_id"] . " and  compra_estado=0");

        $subtotal = 0.0;
        $i = 0;
        for ($i = 0; $i < count($productos); $i++) {
            $price = $db->get_var("select articulo_precio from articulos where articulo_id=" . $productos[$i]->articulo_id);
            $subtotal += $price;
        }
        $com2 = "<b>Articulos:</b> " . $i . ", <b>Subtotal:</b> $" . $subtotal;
        $com3 = "1 - " . $i . " de " . $i;
        $com7 = "1 - " . $i . " de " . $i;
        $com4 = "$" . $subtotal;
        $com5 = "$" . ($subtotal * 0.15);
        $com6 = "$" . ($subtotal + ($subtotal * 0.15));
        echo "$com2|$com3|$com7|$com4|$com5|$com6";
    } else {
        echo "Necesita <a href='./login.php'><b>iniciar sesion</b></a> para comprar.";
    }
}

?>