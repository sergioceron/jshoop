<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Lista de productos comprados por un usuario
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";
include_once "./includes/security.php";
if ($login != 1) header("Location: ./login.php");

$sselected = 4;
$subtitle = $_i18n["products.submenu"];
include("includes/header.php");

?>

<div id="content">
    <ul class="inlinelist">
        <li class="main1"><a href="#"
                             onclick="document.getElementById('list').submit();"><?=$_i18n["process"]?></a></li>
        <li><a href="./"><?=$_i18n["continue"]?></a></li>
        <li><a href="admin_payment.php"><?=$_i18n["menu44"]?></a></li>
    </ul>
    <p><?=$_i18n["info1"]?></p>
</div>

<?php if (isset($_GET["id"])) { ?>
<div align="center" class="msg">
    <div class="bl3">
        <div class="br">
            <div class="tl">
                <div class="tr2"><?php if (base64_decode($_GET["id"]) == "0") { ?>
                    <?= $_i18n["processe" . base64_decode($_GET["id"])] ?> <?php } else { ?>
                    <?= $_i18n["processe" . base64_decode($_GET["id"])] ?> <?php }?></div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php
$productos = $db->get_results("select * from compras where usuario_id=" . $_SESSION["user_id"] . " and compra_estado=0");
?>
<form id="list" name="deleteItems" action="action_process.php"
      method="post">
    <table>
        <tr>
            <th colspan="3" class="tablebar"><input disabled="disabled"
                                                    value="<?=$_i18n["delete"]?>" id="deleteB"
                                                    onclick="return deleteArticle(deleteItems, './delete.php');"
                                                    type="button"></th>
            <th colspan="4" class="tablebar">
                <ul class="inlinelist">
                    <li id="count2"><b>1 - <?=count($productos)?> de <?=count($productos)?></b>
                    </li>
                </ul>
            </th>
        </tr>
        <tr>
            <th id="header"></th>
            <th id="header"><input value="" name="select_all"
                                   onclick="cbTbl.selectAll(this); updateDeleteButtons(this);"
                                   type="checkbox"></th>
            <th id="header"><?=$_i18n["name"]?></th>
            <th id="header"><?=$_i18n["description"]?></th>
            <th id="header"><?=$_i18n["date"]?></th>
            <th id="header"><?=$_i18n["expire"]?></th>
            <th id="header" style="width: 5%" align="right"><?=$_i18n["price"]?></th>
        </tr>
        <?php for ($i = 0, $subtotal = 0; $i < count($productos); $i++) {
        $producto = $db->get_row("select * from articulos where articulo_id=" . $productos[$i]->articulo_id);
        ?>
        <tr class="" id="ARTICLE_COLLECTION_SELECTION_<?=$i?>">
            <td></td>
            <td><input value="true"
                       name="COLLECTION_SELECTION_<?=$i?>.<?=base64_encode($productos[$i]->compra_id)?>"
                       onclick="cbTbl.selectOne(this); updateDeleteButtons(this);"
                       type="checkbox"></td>
            <td><a href="javascript:void(0)"
                   onclick="displayArticle( 'product.php?id=<?=base64_encode($producto->articulo_id)?>' );return false"><?=$producto->articulo_nombre?></a>
            </td>
            <td><?=$producto->articulo_descripcion?></td>
            <td><?=$producto->articulo_fecha?></td>
            <td><?=$producto->articulo_expira?></td>
            <td align="right"><?=$producto->articulo_precio?></td>
        </tr>
        <?php
        $subtotal += $producto->articulo_precio;
    }
        if ($i == 0) {
            ?>
            <tr class="" id="ARTICLE_COLLECTION_SELECTION_0">
                <td colspan="7" align="center"><em>No existe ningun articulo en su
                    carrito</em></td>
            </tr>
            <?php } ?>

        <tr>
            <th colspan="3" class="tablebar"><input disabled="disabled"
                                                    value="<?=$_i18n["delete"]?>" id="deleteT"
                                                    onclick="return deleteArticle(deleteItems, './delete.php');"
                                                    type="button"></th>
            <th colspan="4" class="tablebar">
                <ul class="inlinelist">
                    <li id="count"><b>1 - <?=count($productos)?> de <?=count($productos)?></b>
                    </li>
                </ul>

            </th>
        </tr>
        <tr>
            <th colspan="5" class="tablebar1"></th>
            <th colspan="1" class="tablebar1"><b><?=$_i18n["subtotal"]?> </b></th>
            <th colspan="1" class="total" id="sub">$<?=$subtotal?></th>
        </tr>
        <tr>
            <th colspan="5" class="tablebar1"></th>
            <th colspan="1" class="tablebar1"><b><?=$_i18n["iva"]?>: </b></th>
            <th colspan="1" class="total" id="iva"><?=$subtotal * $_config["iva"]?>
            </th>
        </tr>
        <tr>
            <th colspan="5" class="tablebar1"></th>
            <th colspan="1" class="tablebar1"><b><?=$_i18n["total"]?>: </b></th>
            <th colspan="1" class="total" id="total">$<?=$subtotal + ($subtotal * $_config["iva"])?>
            </th>
        </tr>
    </table>
</form>
</div>

<?php include("includes/foot.php"); ?>
</body>
</html>
