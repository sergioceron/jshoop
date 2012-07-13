<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario de registro para clientes
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";

$sselected = 1;
$subtitle = $_i18n["register.submenu"];
$selected = 1;
$items = array($_i18n["login.submenu"], $_i18n["register.submenu"]);
$links = array("./login.php", "./register.php");
include("includes/header.php");

?>

<div id="content"><?php if (isset($_GET["id"])) { ?>
    <div align="center" class="msg">
        <div class="bl3">
            <div class="br">
                <div class="tl">
                    <div class="tr2"><?=$_i18n["registere" . base64_decode($_GET["id"])]?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

    $fields = " " . base64_decode($_GET["tk"]);
    ?>
    <form action="action_register.php" method="post" id="settings"><input
        type="hidden" name="at" value="7cf0ac816f615996-1128ad98933">
        <table>
            <tr>
                <th><?=$_i18n["name"]?>: <font color="red">*</font></th>
                <td><span class="errorbox-good"> <input type="text" name="name"
                                                        value="" id="fn"
                                                        size="30"> </span> <?php if (strpos($fields, 'name')) { ?><br>
                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
            </tr>
            <tr>
                <th><?=$_i18n["address"]?>: <font color="red">*</font></th>
                <td><span class="errorbox-good"><textarea name="address" rows="6"
                                                          cols="40"
                                                          id="supportcontact"></textarea> </span> <?php if (strpos($fields, 'address')) { ?>
                    <br>
                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
            </tr>
            <tr>
                <th><?=$_i18n["phone"]?>:</th>
                <td><span class="errorbox-good"> <input type="text" name="phone"
                                                        value="" id=""
                                                        size="30"> </span> <?php if (strpos($fields, 'phone')) { ?><br>
                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
            </tr>
            <tr>
                <th><?=$_i18n["password"]?>: <font color="red">*</font></th>
                <td><span class="errorbox-good"> <input type="password"
                                                        name="password" value="" id=""
                                                        size="30"> </span> <?php if (strpos($fields, 'password')) { ?>
                    <br>
                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
            </tr>
            <tr>
                <th><?=$_i18n["paymethod"]?>:</th>
                <td><span class="errorbox-good"> <input name="method" value="credit"
                                                        id="standard" type="radio"> <label
                    for="standard"><b><?=$_i18n["creditcard"]?></b></label>
		<p class="indent"><?=$_i18n["pay.info4"]?></p>
		<input name="method" value="deposit" CHECKED id="standard"
               type="radio"> <label for="standard"><b><?=$_i18n["transfer"]?></b></label>
		<p class="indent"><?=$_i18n["pay.info5"]?></p>
		</span> <?php if (strpos($fields, 'method')) { ?><br>
                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
            </tr>
            <tr>
                <th><?=$_i18n["creditcard"]?>:</th>
                <td><span class="errorbox-good"> <input type="text" value=""
                                                        name="credit" value="" id=""
                                                        size="30"> </span> <?php if (strpos($fields, 'credit')) { ?><br>
                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
            </tr>
            <tr>
                <th><?=$_i18n["type"]?>:</th>
                <td><span class="errorbox-good"><select name="type">
                    <option value="American" selected>American Express</option>
                    <option value="Dinners">Diner's Club</option>
                    <option value="Discover">Discovers</option>
                    <option value="Master">Master Card</option>
                    <option value="Visa">Visa</option>
                    <option value="Visa Electron">Visa Electron</option>
                </select> <?=$_i18n["pay.info6"]?> </span> <?php if (strpos($fields, 'type')) { ?><br>
                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["emptyfield"]?> </span><?php } ?></td>
            </tr>
            <tr class="finalrow">
                <th></th>
                <td><input value="<?=$_i18n["savechange"]?>" class="mainbutton"
                           onclick="clear_isset_monitoring();" type="submit"> <input
                    value="<?=$_i18n["cancel"]?>" class="cancel"
                    onclick="clear_isset_monitoring(); go('./');" name="Button"
                    type="button"></td>
            </tr>
        </table>
    </form>
</div>
<?php include("./includes/foot.php"); ?>

</body>
</html>
