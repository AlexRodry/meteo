  <?php 
	include ('connectBD.php');
	include ('funciones.php');
    $conexion = conectarBD();
    
    $valor_temp1 = obtener_valores(1, $conexion);	// String de Humedad
    $valor_temp2 = obtener_valores(2, $conexion);	// String de Temperatura
	$valor_temp3 = obtener_valores(3, $conexion);	// String de Luz
	$last_val_1	 = array_count_values($valor_temp1);			// Último valor de humedad
	$last_val_2	 = array_pop($valor_temp2);			// Último valor de temperatura
	$last_val_3	 = array_pop($valor_temp3);			// Último valor de luz
	desconectarBD($conexion);
  ?>

<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>
 <?php echo '<p>TEST</p>'; ?>
 <?php echo $last_val_1; ?>

 </body>
</html>