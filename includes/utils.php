<?php
/**********************************************************************
 *  Author : Sergio Ceron Figueroa (sxceron@laciudadx.com)
 *  Alias  : sxceron
 *  Web    : http://www.dotrow.info
 *  Name   : jShop v1.0
 *  Desc   : Funciones de utlidad
 *              thumbjpeg        : Genera un thumbail de una imagen (requiere GD)
 *              diffdates        : Compara dos fechas
 *
 ***********************************************************************/

function thumbjpeg($imagen, $altura)
{

    // Lugar donde se guardar�n los thumbnails respecto a la carpeta donde est� la imagen "grande".
    $dir_thumb = "";

    // Prefijo que se a�adir� al nombre del thumbnail. Ejemplo: si la imagen grande fuera "imagen1.jpg",
    // el thumbnail se llamar�a "tn_imagen1.jpg"
    $prefijo_thumb = "th_";
    $camino_nombre = explode("/", $imagen);

    // Aqu� tendremos el nombre de la imagen.
    $nombre = end($camino_nombre);

    // Aqu� la ruta especificada para buscar la imagen.
    $camino = substr($imagen, 0, strlen($imagen) - strlen($nombre));

    // Intentamos crear el directorio de thumbnails, si no existiera previamente.
    if (!file_exists($camino . $dir_thumb))
        mkdir($camino . $dir_thumb, 0777) or die("No se ha podido crear el directorio $dir_thumb");

    // Aqu� comprovamos que la imagen que queremos crear no exista previamente
    if (!file_exists($camino . $dir_thumb . $prefijo_thumb . $nombre)) {
        $img = imagecreatefromjpeg($camino . $nombre) or die("No se encuentra la imagen $camino$nombre<br>n");

        // miramos el tama�o de la imagen original...
        $datos = getimagesize($camino . $nombre) or die("Problemas con $camino$nombre<br>n");

        // intentamos escalar la imagen original a la medida que nos interesa
        $ratio = ($datos[1] / $altura);
        $anchura = round($datos[0] / $ratio);

        // esta ser� la nueva imagen reescalada
        $thumb = imagecreatetruecolor($anchura, $altura);

        // con esta funci�n la reescalamos
        imagecopyresampled($thumb, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);

        // voil� la salvamos con el nombre y en el lugar que nos interesa.
        imagejpeg($thumb, $camino . $dir_thumb . $prefijo_thumb . $nombre);
    }
}

function diffdates($fecha1, $fecha2)
{
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha1))
	list($a�o1,$mes1,$dia1)=split("/", $fecha1);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha1))
	list($a�o1,$mes1,$dia1)=split("-", $fecha1);
	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha2))
	list($a�o2,$mes2,$dia2)=split("/", $fecha2);
	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha2))
	list($a�o2,$mes2,$dia2)=split("-", $fecha2);
	$dif = mktime(0, 0, 0, $mes1, $dia1, $a�o1) - mktime(0, 0, 0, $mes2, $dia2, $a�o2);
	return ($dif);
}

?>