<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Registra un usuario nuevo como cliente
 *           name     : obligatorio (nombre)
 *           address  : obligatorio (direccion)
 *           password : obligatorio (contraseña)
 *           method   : obligatorio (metodo de pago)
 *           type     : obligatorio (tipo de tarjeta de credito)
 *           phone    : opcional    (telefono)
 *
***********************************************************************/
// Include file headers
include_once "./includes/validator.php";
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/creditcard.php";

$_validator = new Validator();
$_validator->setMethod( "POST" );
$_validator->setVars( array( "name:required", "address:required", "password:required", "method:required", "type:required" ) );

if( $_validator->validate() ){
	$values = $_validator->getValues();
	$users = $db->get_results( "select * from usuarios where usuario_alias='".$values["name"]."'" );
	if( count($users) != 0 ){
		header( 'Location: ./register.php?id='.base64_encode( "1" ) );
		exit(0);
	}

	if( $values[ "method" ] != "credit" ){
		$sql  = "insert into usuarios(pago_nombre,pago_direccion,usuario_nombre,usuario_direccion,usuario_telefono, pago_telefono,usuario_password, usuario_metodopago,usuario_alias) ";
		$sql .= " values('".$values[ "name" ]."','".$values[ "address" ]."'";
		$sql .= ",'".$values[ "name" ]."','".$values[ "address" ]."'";
		$sql .= ",'".$_POST[ "phone" ]."','".$_POST[ "phone" ]."'";
		$sql .= ",'".md5($values[ "password" ])."','".$values[ "method" ]."','".$values[ "name" ]."')";
		$db->query($sql);

		header( 'Location: ./login.php?id='.base64_encode( "3" ) );
	}else{
		if( checkCreditCard ( $_POST[ "credit" ], $values[ "type" ], $err, $msg )  ){
			$sql  = "insert into usuarios(pago_nombre,pago_direccion,usuario_nombre,usuario_direccion,usuario_telefono, pago_telefono,usuario_password, usuario_metodopago,usuario_tcredito,tarjeta_tipo,usuario_alias) ";
			$sql .= " values('".$values[ "name" ]."','".$values[ "address" ]."'";
			$sql .= ",'".$values[ "name" ]."','".$values[ "address" ]."'";
			$sql .= ",'".$_POST[ "phone" ]."','".$_POST[ "phone" ]."'";
			$sql .= ",'".md5($values[ "password" ])."','".$values[ "method" ]."'";
			$sql .= ",'".base64_encode($_POST[ "credit" ])."','".$values[ "type" ]."','".$values[ "name" ]."')";
			$db->query($sql);

			header( 'Location: ./login.php?id='.base64_encode( "3" ) );
		}else{
			header( 'Location: ./register.php?id='.base64_encode( "0" ) );
		}
	}
}else{
	for( $err="", $i = 0; $i < count($e = $_validator->getErrors()); $i++ ){
		$err = $err.";".$e[$i]["field"];
	}
	header( 'Location: ./register.php?id='.base64_encode( "2" ).'&tk='.base64_encode($err) );

}

?>