<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Formulario para iniciar sesion
 *
 ***********************************************************************/
// Include file headers
include_once "./includes/settings.php";
include_once "./includes/db.php";

$sselected = 1;
$subtitle = $_i18n["login.submenu"];
$selected = $_GET["sm"];
$items = array($_i18n["login.submenu"], $_i18n["register.submenu"]);
$links = array("./login.php", "./register.php");
include("includes/header.php");

if (isset($_GET["id"])) {
    ?>
<div align="center" class="msg">
    <div class="bl3">
        <div class="br">
            <div class="tl">
                <div class="tr2"><?=$_i18n["logine" . base64_decode($_GET["id"])]?>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php }
$fields = " " . base64_decode($_GET["tk"]); ?>
<style>
    .f {
        border-top: solid 1px #bbbbbb;
        color: #676767;
        font-size: 12px;
        padding-top: 5px;
        margin-top: 15px
    }

    .f span {
        position: relative;
        bottom: 7px
    }

    .errormsg {
        color: #cc0000
    }

    .alert {
        color: #FF0000
    }

    .x {
        background-color: #ddf8cc;
        border: solid 1px #80c65a;
        padding: 15px;
        margin: 0 15px 0 0;
        text-align: center;
    }

    .x, .x td {
        font-size: 12px
    }

    .x table {
        margin: 0px;
        text-align: left;
    }

    .x p {
        text-align: left;
    }

    .x h2 {
        margin: 0 0 0 0;
        font-weight: bold;
        font-size: 12px;
    }
</style>

<div align="center">
    <table border="0" cellpadding="0" style="text-align: center;"
           cellspacing="0" style="width:200px">
        <tbody>
        <tr>
            <td valign="top">
                <div class="x"><?=$_i18n["login.info"]?>
                    <form action="action_login.php" method="post" name="login">
                        <table style="margin: 15px 0pt 0pt;" border="0" cellpadding="0"
                               cellspacing="0">
                            <tbody>
                            <tr>
                                <td align="right" nowrap="nowrap"><?=$_i18n["user"]?> :&nbsp;</td>
                                <td><input name="userName" size="18"
                                           type="text"> <?php if (strpos($fields, 'userName')) { ?><br>
                                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["error.required"]?>
						</span><?php } ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td
                                    style="overflow: hidden; color: rgb(68, 68, 68); font-size: 75%;"
                                    dir="ltr" align="right">@<?=$_i18n["empresa"]?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3" height="8"></td>
                            </tr>
                            <tr>
                                <td colspan="2" height="8"></td>
                            </tr>
                            <tr>
                                <td align="right" nowrap="nowrap"><?=$_i18n["pass"]?> :&nbsp;</td>
                                <td><input name="userPassword" size="18"
                                           type="password"> <?php if (strpos($fields, 'userPassword')) { ?><br>
                                    <span class="errormsg" id="errormsg_0"> <?=$_i18n["error.required"]?>
						</span><?php } ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" height="8"></td>
                            </tr>
                            <tr>
                                <td colspan="2" height="8"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input value="<?=$_i18n["access"]?>" type="submit"></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>

</tr>
</tbody>
</table>
</div>
<script type="text/javascript" language="JavaScript">
    <!--
    var focusControl = document.forms["login"].elements["userName"];
    if (focusControl.type != "hidden" && !focusControl.disabled) {
        focusControl.focus();
    }
    // -->
</script>
<?php include("./includes/foot.php"); ?>

</body>
</html>
