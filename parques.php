<html>
<?php
include_once "vistas/topbar.php";
?>
<!-- Incluir CSS y JS de Leaflet y MarkerCluster -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster-src.js"></script>

    <style>
        #map {
            margin-left:2%;
            position: center;
            height: 90%;
            width: 95%;
           border:1px solid
        }
    </style>
<!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
   <?php
// Conexión a la base de datos
include_once("Conexion.php");

// Consulta para obtener los datos de latitud y longitud
$sql = "SELECT latitud, longitud FROM parques where latitud != 0 and longitud != 0 ";  
$result = $conexion->query($sql);

// Crear un array para almacenar los resultados
$locations = array();
if ($result->num_rows > 0) {
    // Recorrer los resultados y agregarlos al array
    while($row = $result->fetch_assoc()) {
        $locations_parques[] = array('lat' => $row['latitud'], 'lng' => $row['longitud']);
    }
} else {
    echo "0 resultados";
}

$conexion->close();
?>
<div style="width: 100%;margin: 10px;margin-left: 2%;" ><h2>Observatorio Yucateco de Salud Mental</h2></div>
<div id="map"></div>

<script>
    // Crear el mapa centrado en una coordenada específica
    var map = L.map('map').setView([20.601342, -88.565865], 9);

    // Cargar las teselas del mapa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Crear un grupo de clúster para los marcadores
    var markers = L.markerClusterGroup();

    // Obtener las ubicaciones desde PHP
    var locations = <?php echo json_encode($locations_parques); ?>;

    // Agregar marcadores al grupo de clúster
    locations.forEach(function(location) {
        var marker = L.marker([location.lat, location.lng]);
        markers.addLayer(marker);
    });

    // Agregar el grupo de clúster al mapa
    map.addLayer(markers);
</script>

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

    <?
include_once "vistas/footer.php";
?>
</html>