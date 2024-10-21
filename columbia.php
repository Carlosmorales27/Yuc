<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
<head>
  
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
<meta name="description" content="">
<meta name="author" content=""> 

<title>Observatorio - Ideación</title>
<? include_once "vistas/topbar.php"; ?>
  
<body id="page-top">

   <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Observatorio Yucateco de Salud Mental</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
                    </div>
 

   <?php
error_reporting (E_ALL  ^  E_NOTICE  ^  E_DEPRECATED);
// 1.- IDENTIFICACION nombre de la base, del usuario, clave y servidor

$db_host="db5009683277.hosting-data.io";
$db_name="dbs8208167";
$db_login="dbu145439";
$db_pswd="#SuicidePrevention2022";

$conn = mysqli_connect($db_host,$db_login,$db_pswd,$db_name);
    if(!$conn)
    {
        echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
    }
    else
    {
        echo "<h3> </h3><hr><br>";
    }

$sql = 'select columbia, count(*) as cantidad from datos_comunes WHERE columbia IS NOT NULL group by columbia having count(*) > 0 order by columbia desc';
$resultado = mysqli_query($conn, $sql);
if(!$resultado) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado->num_rows>0){
$num_filas = $resultado->num_rows;
//echo "num registros ".$num_filas."<br>";
}
  $nivel=""; 
  $color="";
$data = "";
$data = '[';
  $i=1;
while($rows=mysqli_fetch_array($resultado)){
  if($i < $num_filas){
    if($rows[0] == "0"){
     $nivel="Nulo";
      
    }
    if($rows[0] == "1"){
     $nivel="Bajo";
     
    }
    if($rows[0] == "2"){
     $nivel="Moderado";
     
    }
    if($rows[0] == "3"){
     $nivel="Alto";
      
    }
    
    $data = $data.'{ "columbia": "'.$nivel.'", "cantidad": '.$rows[1].'},';
    $i++;
  }
  else{
    if($rows[0] == "0"){
     $nivel="Nulo";
     
    }
    if($rows[0] == "1"){
     $nivel="Bajo";
      
    }
    if($rows[0] == "2"){
     $nivel="Moderado";
      
    }
    if($rows[0] == "3"){
     $nivel="Alto";
      
    }
    $data = $data.'{ "columbia": "'.$nivel.'",  "cantidad": '.$rows[1].'} ]';
  }

}
$file = fopen("pie_columbia.json", "w");
fwrite($file, $data);
mysqli_free_result($resultado);
fclose($file);
  ?>

<div id="severidad_suicidadiv"style="width:50%; height:500px; margin:auto">

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var iconPath = "M53.5,476c0,14,6.833,21,20.5,21s20.5-7,20.5-21V287h21v189c0,14,6.834,21,20.5,21 c13.667,0,20.5-7,20.5-21V154h10v116c0,7.334,2.5,12.667,7.5,16s10.167,3.333,15.5,0s8-8.667,8-16V145c0-13.334-4.5-23.667-13.5-31 s-21.5-11-37.5-11h-82c-15.333,0-27.833,3.333-37.5,10s-14.5,17-14.5,31v133c0,6,2.667,10.333,8,13s10.5,2.667,15.5,0s7.5-7,7.5-13 V154h10V476 M61.5,42.5c0,11.667,4.167,21.667,12.5,30S92.333,85,104,85s21.667-4.167,30-12.5S146.5,54,146.5,42 c0-11.335-4.167-21.168-12.5-29.5C125.667,4.167,115.667,0,104,0S82.333,4.167,74,12.5S61.5,30.833,61.5,42.5z"
//var iconPath = "M224 32c9.036 24.71 106.984 58.72 156.096 64-37.096 7.89-53.042 10.52-57.545 32-13.076 62.384 191.477 60.478 115.73 152.223 69.11-15.788 57.922-116.197 15.887-129.84-27.237-8.84-63.75-11.67-47.75-38.383C425.962 88.104 503.57 59.74 448 32zM28.096 292v64h87v-64zm105 0v64h274v-64zm292 0v64h16v-64zm34 0v64h17v-64z"


var chart = am4core.create("severidad_suicidadiv", am4charts.SlicedChart);
chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect

chart.dataSource.url = "pie_columbia.json";

//Título
var title = chart.titles.create();
title.text = "Distribución por: nivel de IDEACIÓN SUICIDA";
title.fontSize = 25;
title.marginBottom = 30;

var series = chart.series.push(new am4charts.PictorialStackedSeries());
series.dataFields.value = "cantidad";
series.dataFields.category = "columbia";
series.alignLabels = true;

series.startLocation = 0.0
series.endLocation = 1.0

series.maskSprite.path = iconPath;
series.ticks.template.locationX = 1;
series.ticks.template.locationY = 0.5;

series.labelsContainer.width = 200;

series.labels.template.disabled = true;
series.ticks.template.disabled = true;

chart.legend = new am4charts.Legend();
chart.legend.position = "left";
chart.legend.valign = "top";

}); // end am4core.ready()
</script>
</div>
 
</div>
            <!-- End of Main Content -->

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

<? include_once "vistas/footer.php"; ?>

</html>