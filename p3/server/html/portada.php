<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader,[ ]);

// Se conecta con el servidor
//$conexion = mysql_connect('localhost', 'admin', 'sibw1819');
// La versión de arriba ( que se propone en el tutorial ) está obsoleta y no funciona
//$conexion = new mysqli("localhost", "admin", "sibw1819");
$conexion = mysqli_connect('localhost', 'admin', 'sibw1819', "SIBW_bd");

// Se abre la base de datos
//$abreBD = mysqli_select_db('SIBW_bd', $conexion);
if(!$conexion){
    die ('No se pudo abrir la base de datos. ERROR: ' . mysql_error());
}

// Se ejecuta una consulta
$seleccion = 'SELECT * FROM gameEvent WHERE eventId = 1';
//$resultado = mysql_query ($seleccion, $conexion);
$resultado = mysqli_query($conexion, $seleccion);


// Averiguamos cuantas filas devuelve la consulta
$numFilas = mysqli_num_rows ($resultado);


$fila = mysqli_fetch_array ($resultado, MYSQLI_NUM);
$nombre = $fila[0];
$imagenPortada = $fila[1];

echo $twig->render('portadaTemplate.html',
	 ['eventName' => $nombre, 'titleImg' => $imagenPortada]);

// Cerramos la conexion con el servidor
mysql_close($conexion);
?>