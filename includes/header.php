<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Cabecera
 *
 ***********************************************************************/
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html dir="ltr">
    <head>                     
        <meta content="text/html; charset=windows-1252" http-equiv="content-type">
        <title><?=$_i18n["title"]?></title>   
        <link href="styles/global.css" type="text/css" rel="stylesheet">   
        <link href="styles/modal-message.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="jscripts/ajax.js"></script> 
        <script type="text/javascript" src="jscripts/modal/js/ajax.js"></script>
        <script type="text/javascript" src="jscripts/modal/js/modal-message.js"></script>
        <script type="text/javascript" src="jscripts/modal/js/ajax-dynamic-content.js"></script>
        <script type="text/javascript" src="jscripts/cpanel.js"></script>
    </head>
    <body>   
    <div id="header"> <div id="logo"> 
        <a href="./">     
        <img alt="jshop" src="images/logo.jpg">  </a> 
    </div> 
<?php include("topmenu.php");?> 
        <p> 
        <b> <?=$_i18n["searchl"]?> </b> 
        <span id="premium">  -  beta  </span> 
        </p> 
        <form action="./search.php" method="get"> 
            <label for="user">Find</label> 
            <input maxlength="2048" id="user" value="<?=$q?>" name="q" type="text"> 
            <input value="<?=$_i18n["search"]?>" type="submit"> 
        </form> 
    </div>                  
   <?php include("includes/menu.php");?>
   <div class="clear"></div>
	<div id="nav2"> 
	<h2><?=$subtitle?></h2>
	<?php if( count( $items ) > 0 ){?>
		<ul id="submain"> 
			<?php for( $i = 0; $i < count( $items ); $i++ ){
			if( $selected == $i ){?>
			<li class="selected"> <?=$items[$i]?>  </li>
			<?php }else{?>
			<li class=""> <a href="<?=$links[$i]?>"><?=$items[$i]?></a>  </li>
			<?php }?>
			<?php }?>
		</ul> 
	<?php } ?>
	</div>
    <div id="tip"> 
        <span class="new">Nuevo!</span></a> 
    </div> 