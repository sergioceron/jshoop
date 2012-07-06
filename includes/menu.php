<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Menu de navegacion
 *
 ***********************************************************************/
?>
<div id="navigation">
<ul>
	<li class="<?=$sselected == 1 ? "selected" : ""?>"><a href="."
		title="<?=$_i18n["menu1"]?>"> <?=$_i18n["menu1"]?> </a></li>
	<li class="<?=$sselected == 2 ? "selected" : ""?>"><a
		href="categories.php" title="<?=$_i18n["menu2"]?>"><?=$_i18n["menu2"]?>
	</a></li>
	<li class="<?=$sselected == 3 ? "selected" : ""?>"><a
		href="adminpanel.php" title="<?=$_i18n["menu3"]?>"> <?=$_i18n["menu3"]?>
	</a></li>
	<li id="services" class="<?=$sselected == 4 ? "selected" : ""?>"><a
		href="javascript:showItem('servicelist');"
		title=" <?=$_i18n["menu4"]?>"> <?=$_i18n["menu4"]?><img
		src="styles/arrow.gif" alt=""> </a>
	<ul id="servicelist">
		<li class=""><a href="admin_personal.php"
			title="<?=$_i18n["menu41"]?>"> <?=$_i18n["menu41"]?> </a></li>
		<li class=""><a href="admin_access.php" title="<?=$_i18n["menu42"]?>">
		<?=$_i18n["menu42"]?> </a></li>
		<li class=""><a href="admin_products.php"
			title="<?=$_i18n["menu43"]?>"> <?=$_i18n["menu43"]?> </a></li>
		<li class=""><a href="admin_payment.php" title="<?=$_i18n["menu44"]?>">
		<?=$_i18n["menu44"]?> </a></li>
	</ul>
	</li>
</ul>
<div id="status" style="float: right"><?php
if( isset($_SESSION["user_id"])){
	$productos = $db->get_results("select * from compras where usuario_id=".$_SESSION[ "user_id"] ." and  compra_estado=0");
	$subtotal = 0.0;
	for( $i = 0; $i <count($productos); $i++ ){
		$price = $db->get_var("select articulo_precio from articulos where articulo_id=".$productos[$i]->articulo_id);
		$subtotal += $price;
	}
	echo "<b>".$_i18n[ "products" ].":</b> $i, <b>".$_i18n[ "subtotal" ]."</b> $subtotal";
}
?></div>
<div class="clear"></div>
</div>
