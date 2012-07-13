<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Actualiza los datos de pago de cada usuario
 *           name     : obligatorio (nombre)
 *           address  : obligatorio (direccion)
 *           phone    : obligatorio (telefono)
 *           method   : obligatorio (metodo de pago)
 *           type     : obligatorio (tipo de tarjeta de credito)
 *           credit   : opcional    (tarjeta de credito)
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
include_once "./includes/creditcard.php";

$_validator = new Validator();
$_validator->setMethod("POST");
$_validator->setVars(array("name:required", "address:required", "phone:required", "method:required", "type:required"));

if ($_validator->validate() && $login == 1) {
    $values = $_validator->getValues();

    if ($values["method"] != "credit") {
        $sql = "update usuarios set pago_nombre='" . $values["name"] . "', pago_direccion='" . $values["address"] . "'";
        $sql .= ", pago_telefono='" . $values["phone"] . "', usuario_metodopago=0";
        $sql .= " where usuario_id=" . $_SESSION["user_id"];
        $db->query($sql);
        header('Location: ./admin_payment.php?id=' . base64_encode("1"));
    } else {
        if (checkCreditCard($_POST["credit"], $values["type"], $err, $msg)) {
            $sql = "update usuarios set pago_nombre='" . $values["name"] . "', pago_direccion='" . $values["address"] . "'";
            $sql .= ", pago_telefono='" . $values["phone"] . "', usuario_metodopago=1";
            $sql .= ", usuario_tcredito='" . base64_encode($_POST["credit"]) . "', tarjeta_tipo='" . $values["type"] . "' where usuario_id=" . $_SESSION["user_id"];
            $db->query($sql);
            header('Location: admin_payment.php?id=' . base64_encode("1"));
        } else {
            header('Location: admin_payment.php?id=' . base64_encode("2"));
        }
    }
} else {
    for ($err = "", $i = 0; $i < count($e = $_validator->getErrors()); $i++) {
        $err = $err . ";" . $e[$i]["field"];
    }
    header('Location: admin_payment.php?id=' . base64_encode("0") . '&tk=' . base64_encode($err));
}

?>
