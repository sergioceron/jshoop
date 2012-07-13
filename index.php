<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Tienda virtual en PHP
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";

$selected = $_GET["sm"];
$sselected = 1;
$subtitle = $selected == 0 ? $_i18n["index.submenu1"] : $_i18n["index.submenu2"];
$items = array($_i18n["index.submenu1"], $_i18n["index.submenu2"]);
$links = array("?sm=0", "?sm=1");
include("includes/header.php");
?>

<div id="dash_1"><?php
    $productos = $db->get_results("select * from articulos where articulo_expira>='" . date("y/m/d") . "' and articulo_cantidad > 0 order by " . ($selected == 0 ? "articulo_fecha" : "articulo_rank") . " desc limit 0,4");
    ?>
    <div id="dash1">
        <table>
            <tbody>
            <tr>
                <?php foreach ($productos as $producto) { ?>
                <td class="articleimage" align="center"><img
                    src="images/<?= $producto->articulo_imagen ?>"></td>
                <td class="shopimage"><img src="images/comprar.gif" class="link"
                                           onclick="buyArticle('<?= $producto->articulo_nombre ?>','addproduct.php?id=<?=base64_encode($producto->articulo_id)?>');">
                </td>
                <td class="articlespace"></td>
                <?php } ?>
            </tr>
            <tr>
                <?php foreach ($productos as $producto) { ?>
                <td colspan="2" class="tablefooter" valign="top" id="description"><a
                    href="#"
                    onclick="displayArticle( 'product.php?id=<?=base64_encode($producto->articulo_id)?>' );return false"><b><?= $producto->articulo_nombre ?></b></a><br>
                    <?= $producto->articulo_descripcion ?><br>
                    <span class="price"><?=$_i18n["price"]?> <?=$producto->articulo_precio ?></span>

                </td>
                <td class="articlespace"></td>
                <?php } ?>
            </tr>
            </tbody>
        </table>
    </div>

    <div id="dash2">
        <div class="spacer"></div>
        <h2 class="inlinetext"><?=$_i18n["newcategory"]?></h2>
        <ul class="inlinelist2">
            <li><a href="./categories.php"><?=$_i18n["viewcategory"]?></a></li>
        </ul>
        <div id="dash_2"><?php
            $categories = $db->get_results("select * from categorias order by " . ($selected == 0 ? "categoria_fecha" : "categoria_rank") . " desc limit 0, 4");
            ?>

            <ul id="services">
                <?php
                $i = 0;
                foreach ($categories as $cat) {
                    $products = $db->get_var("select count(*) from articulos where categoria_id=" . $cat->categoria_id . " and articulo_cantidad > 0 and articulo_expira>='" . date("y/m/d") . "'");
                    ?>
                    <li class="<?php echo ($i % 2 == 0 ? "clrflt" : ""); ?>">
                        <a href="#" class="category"><?=$cat->categoria_nombre ?></a>

                        <h3><a
                            href="categories.php?id=<?php echo base64_encode($cat->categoria_id); ?>"><?=$cat->categoria_nombre ?></a>
                        </h3>
                        <span class="beta"><?=$_i18n["new"]?></span>
                        <span> - <?=$products ?> <?=$_i18n["product"]?></span>

                        <p><?=$cat->categoria_descripcion ?><br>
                            <a href="#" class="greenlink"> <?=$_i18n["rank"]?>: <?=$cat->categoria_rank ?>
                                - <?=$cat->categoria_fecha ?></a></p>
                    </li>
                    <?php $i++;
                } ?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>

    <?php include("includes/foot.php");?>

    </body>
    </html>