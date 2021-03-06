  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="chart_div"></div>
  <div id="chart_div2"></div>
  <div id="chart_div3"></div>
  <?php 
	include ('connectBD.php');
	include ('funciones.php');
    // Conexión con la base de datos
    $conexion = conectarBD();
    
    $valor_temp1 = obtener_valores(1, $conexion);	// Humedad
    //var_dump ($valor_temp1);die();
    $valor_temp2 = obtener_valores(2, $conexion);	// Temperatura
	$valor_temp3 = obtener_valores(3, $conexion);	// Luz
    
	desconectarBD($conexion);
  ?>
<script>
    google.charts.load('current', {packages: ['corechart', 'line']});
	google.charts.setOnLoadCallback(drawBasic1);
	google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawBasic2);
	google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawBasic3);

function drawBasic1() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'datetime');
      data.addColumn('number', '%HR');
	  data.addRows(<?php echo $valor_temp1;?>);

      var options = {
        title: 'URJC',
        curveType: 'function',
  
        
        vAxis: {
          title: 'Humedad Relativa',
          viewWindow: {
              max:100,
              min:0
            }
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
            
    }

function drawBasic2() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Time of Day');
      data.addColumn('number', 'Grados');
	  data.addRows(<?php echo $valor_temp2;?>);

      var options = {
        
        vAxis: {
          title: 'Temperatura',
		   viewWindow: {
              max:35,
              min:15
            }
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
      chart.draw(data, options);
            
    } 
function drawBasic3() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Time of Day');
      data.addColumn('number', '% Luz');
	  data.addRows(<?php echo $valor_temp3;?>);

      var options = {
        
        vAxis: {
          title: 'Luz',
		   viewWindow: {
              max:100,
              min:0
            }
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
      chart.draw(data, options);
            
    } 
	
</script>