  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <body style='background-color:#E6F7F6'>
  <div id="chart_div" align="center"></div>
  <div id="chart_div2" align="center"></div>
  <div id="chart_div3" align="center"></div>
  <div id="chart_div4" align="center"></div>
  
  <?php 
	include ('connectBD.php');
	include ('funciones.php');
    // Conexion con la base de datos
    $conexion = conectarBD();
    
    $valor_temp1 = obtener_valores(1, $conexion);	// String de Humedad
    $valor_temp2 = obtener_valores(2, $conexion);	// String de Temperatura
	$valor_temp3 = obtener_valores(3, $conexion);	// String de Luz
	$last_val_1	 = array_pop($valor_temp1);			// Último valor de humedad
	$last_val_2	 = array_pop($valor_temp2);			// Último valor de temperatura
	$last_val_3	 = array_pop($valor_temp3);			// Último valor de luz
    
	desconectarBD($conexion);
  ?>
<script>
    google.charts.load('current', {packages: ['corechart', 'line']});
	google.charts.setOnLoadCallback(drawBasic1);
	google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawBasic2);
	google.charts.load('current', {packages: ['corechart', 'line']});
    google.charts.setOnLoadCallback(drawBasic3);
	google.charts.load('current', {'packages':['gauge']});
    google.charts.setOnLoadCallback(drawChart);

function drawBasic1() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'datetime');
      data.addColumn('number', '%HR');
	  data.addRows(<?php echo $valor_temp1;?>);

      var options = {
        title: 'MONITORIZACION DE HUMEDAD-TEMPERATURA-LUZ',
		titleTextStyle: {color: 'black', fontSize: 45},
        curveType: 'function',
		width: 1700,
        height: 315,
		colors: ['blue'],
		backgroundColor: 'transparent',
        vAxis: {
          title: 'Humedad Relativa',
		  titleTextStyle: {color: 'blue', fontSize: 30},
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
		width: 1700,
        height: 315,
		colors: ['red'],
        backgroundColor: 'transparent',
		vAxis: {
          title: 'Temperatura',
		  titleTextStyle: {color: 'red', fontSize: 30},
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
        width: 1700,
        height: 315,
		colors: ['#FFE800'],
        backgroundColor: 'transparent',
		vAxis: {
          title: 'Luz',
		  titleTextStyle: {color: 'orange', fontSize: 30},
		  viewWindow: {
              max:100,
              min:0
            }
        }

      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
      chart.draw(data, options);
            
    } 
function drawChart() {

      var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Humedad', 0],
          ['Temperatura', 0],
          ['Luz', 0]
        ]);


        var options = {
          width: 800, height: 240,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };
		var chart = new google.visualization.Gauge(document.getElementById('chart_div4'));

        chart.draw(data, options);

      }
	
</script>