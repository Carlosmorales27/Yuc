<?php

function conectar()
{
$db_host="db5009683277.hosting-data.io";
$db_name="dbs8208167";
$db_login="dbu145439";
$db_pswd="#SuicidePrevention2022";

$con = mysqli_connect($db_host, $db_login, $db_pswd, $db_name);
if(!$con){
    die("Database connection failed".mysql_error($con));
    echo "no hay conexión";
    exit();

}
else{

    echo "";
}
 return $con;
}

function consultarhombres(){
$conn = conectar();
$sql2 = "SELECT genero, count(*) as cantidad FROM `datos_comunes` where genero = 'Hombre'";
$resultado2 = mysqli_query($conn, $sql2);
if(!$resultado2) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado2->num_rows>0){
$num_filas = $resultado2->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado2)){
  if($i < $num_filas){
$hombres = $rows[1];
    $i++;
  }
  else{
    $hombres = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}

mysqli_free_result($resultado2);
return $hombres;
}

function consultarmujeres(){
$conn = conectar();
$sql2 = "SELECT genero, count(*) as cantidad FROM `datos_comunes` where genero = 'Mujer'";
$resultado2 = mysqli_query($conn, $sql2);
if(!$resultado2) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado2->num_rows>0){
$num_filas = $resultado2->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado2)){
  if($i < $num_filas){
$mujeres = $rows[1];
    $i++;
  }
  else{
    $mujeres = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}

mysqli_free_result($resultado2);
return $mujeres;
}


function conriesgo(){
$conn = conectar();

$sql1 = "SELECT distinct (id_encuestado), count(*) as cantidad FROM `datos_comunes`";
$resultado1 = mysqli_query($conn, $sql1);
if(!$resultado1) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado1->num_rows>0){
$num_filas = $resultado1->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado1)){
  if($i < $num_filas){
$total = $rows[1];
    $i++;
  }
  else{
    $total = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}
  
  
$sql2 = "SELECT columbia, count(*)as cantidad FROM `datos_comunes` WHERE columbia > 0";
$resultado2 = mysqli_query($conn, $sql2);
if(!$resultado2) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado2->num_rows>0){
$num_filas = $resultado2->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado2)){
  if($i < $num_filas){
$con_riesgo = $rows[1];
    $i++;
  }
  else{
    $con_riesgo = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}

$porcentaje_con_riesgo = ($con_riesgo * 100)/$total;
$porcentaje_con_riesgo = round($porcentaje_con_riesgo, 2);
mysqli_free_result($resultado1);
mysqli_free_result($resultado2);

return $porcentaje_con_riesgo;
}


function sinriesgo(){
$conn = conectar();

$sql1 = "SELECT distinct (id_encuestado), count(*) as cantidad FROM `datos_comunes`";
$resultado1 = mysqli_query($conn, $sql1);
if(!$resultado1) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado1->num_rows>0){
$num_filas = $resultado1->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado1)){
  if($i < $num_filas){
$total = $rows[1];
    $i++;
  }
  else{
    $total = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}
  
  
$sql2 = "SELECT columbia, count(*)as cantidad FROM `datos_comunes` WHERE columbia = 0";
$resultado2 = mysqli_query($conn, $sql2);
if(!$resultado2) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado2->num_rows>0){
$num_filas = $resultado2->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado2)){
  if($i < $num_filas){
$sin_riesgo = $rows[1];
    $i++;
  }
  else{
    $sin_riesgo = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}

$porcentaje_sin_riesgo = ($sin_riesgo * 100)/$total;
$porcentaje_sin_riesgo = round($porcentaje_sin_riesgo, 2);
mysqli_free_result($resultado1);
mysqli_free_result($resultado2);

return $porcentaje_sin_riesgo;
}

function tabla_encuestados(){
$conn = conectar();
// Consulta SQL
$sql = "SELECT edad, genero, edocivil, cantidad_hijos, municipio, tiempo, columbia, dass_21_depresion, dass_21_ansiedad, dass_21_estres FROM datos_comunes"; 
$result = $conn->query($sql);
return $result;
}

function riesgoalto(){
$conn = conectar();
  
$sql1 = "SELECT distinct (id_encuestado), count(*) as cantidad FROM `datos_comunes`";
$resultado1 = mysqli_query($conn, $sql1);
if(!$resultado1) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado1->num_rows>0){
$num_filas = $resultado1->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado1)){
  if($i < $num_filas){
$total = $rows[1];
    $i++;
  }
  else{
    $total = 0;  
    }

}

$sql2 = "SELECT columbia, count(*)as cantidad FROM `datos_comunes` WHERE columbia = 3";
$resultado2 = mysqli_query($conn, $sql2);
if(!$resultado2) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado2->num_rows>0){
$num_filas = $resultado2->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado2)){
  if($i < $num_filas){
$riesgo_alto = $rows[1];
    $i++;
  }
  else{
    $riesgo_alto = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}

$riesgo_alto = ($riesgo_alto * 100)/$total;
$riesgo_alto = round($riesgo_alto, 1);
mysqli_free_result($resultado1);
mysqli_free_result($resultado2);

return $riesgo_alto;

}

function riesgomoderado(){
$conn = conectar();
  
$sql1 = "SELECT distinct (id_encuestado), count(*) as cantidad FROM `datos_comunes`";
$resultado1 = mysqli_query($conn, $sql1);
if(!$resultado1) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado1->num_rows>0){
$num_filas = $resultado1->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado1)){
  if($i < $num_filas){
$total = $rows[1];
    $i++;
  }
  else{
    $total = 0;  
    }

}

$sql2 = "SELECT columbia, count(*)as cantidad FROM `datos_comunes` WHERE columbia = 2";
$resultado2 = mysqli_query($conn, $sql2);
if(!$resultado2) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado2->num_rows>0){
$num_filas = $resultado2->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado2)){
  if($i < $num_filas){
$riesgo_moderado = $rows[1];
    $i++;
  }
  else{
    $riesgo_moderado = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}

$riesgo_moderado = ($riesgo_moderado * 100)/$total;
$riesgo_moderado = round($riesgo_moderado, 1);
mysqli_free_result($resultado1);
mysqli_free_result($resultado2);

return $riesgo_moderado;

}

function riesgobajo(){
$conn = conectar();
  
$sql1 = "SELECT distinct (id_encuestado), count(*) as cantidad FROM `datos_comunes`";
$resultado1 = mysqli_query($conn, $sql1);
if(!$resultado1) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado1->num_rows>0){
$num_filas = $resultado1->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado1)){
  if($i < $num_filas){
$total = $rows[1];
    $i++;
  }
  else{
    $total = 0;  
    }

}

$sql2 = "SELECT columbia, count(*)as cantidad FROM `datos_comunes` WHERE columbia = 1";
$resultado2 = mysqli_query($conn, $sql2);
if(!$resultado2) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado2->num_rows>0){
$num_filas = $resultado2->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado2)){
  if($i < $num_filas){
$riesgo_bajo = $rows[1];
    $i++;
  }
  else{
    $riesgo_bajo = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}

$riesgo_bajo = ($riesgo_bajo * 100)/$total;
$riesgo_bajo = round($riesgo_bajo, 1);
mysqli_free_result($resultado1);
mysqli_free_result($resultado2);

return $riesgo_bajo;

}

function riesgonulo(){
$conn = conectar();
  
$sql1 = "SELECT distinct (id_encuestado), count(*) as cantidad FROM `datos_comunes`";
$resultado1 = mysqli_query($conn, $sql1);
if(!$resultado1) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado1->num_rows>0){
$num_filas = $resultado1->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado1)){
  if($i < $num_filas){
$total = $rows[1];
    $i++;
  }
  else{
    $total = 0;  
    }

}

$sql2 = "SELECT columbia, count(*)as cantidad FROM `datos_comunes` WHERE columbia = 0";
$resultado2 = mysqli_query($conn, $sql2);
if(!$resultado2) {
    echo "Error de BD, no se pudo consultar la base de datos\n";
    echo "Error MySQL: " . mysql_error();
    exit;
}
if($resultado2->num_rows>0){
$num_filas = $resultado2->num_rows;
//echo "num registros ".$num_filas."<br>";
}
$i=0;
while($rows=mysqli_fetch_array($resultado2)){
  if($i < $num_filas){
$riesgo_nulo = $rows[1];
    $i++;
  }
  else{
    $riesgo_nulo = 0;  
    }
//echo $rows[0]."<br>";
//echo $rows[1]."<br>";
}

$riesgo_nulo = ($riesgo_nulo * 100)/$total;
$riesgo_nulo = round($riesgo_nulo, 1);
mysqli_free_result($resultado1);
mysqli_free_result($resultado2);

return $riesgo_nulo;

}



?>
