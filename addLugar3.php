<!DOCTYPE html>
<?php
// INICIALIZO LAS VARIABLES 
$latitud= "-12.069417105877214";
$longitud="-77.07812547683716";
$zoom= "17";
$tipo_mapa = "HYBRID";
$direccion = "";

if (isset($_GET["direccion"])) $direccion=  urldecode ($_GET["direccion"]);
else $direccion="";

// LONGITUD Y LATITUD SI ESTAN COMO PARAMETROS LOS COJO
if (isset($_GET["dir"])) $direccion = $_GET["dir"];
if (strlen ($direccion) <= 8) $direccion =""; // SI LA DIRECCION ES MENOR QUE 8 NO LA PROCESO

// LONGITUD Y LATITUD SI ESTAN COMO PARAMETROS LOS COJO
if (isset($_GET["lon"])) $longitud= $_GET["lon"];
if (isset($_GET["lat"])) $latitud= $_GET["lat"];

// ZOOM ENTRE 0 y 19
if (isset($_GET["zoom"])) $zoom= $_GET["zoom"];
if (($zoom<=0) || ($zoom>=20)){ $zoom= "17";}


// TIPO DE MAPA
if (isset($_GET["tipo"])) $tipo_mapa= strtoupper($_GET["tipo"]);

// COMPRUEBO QUE EL TIPO ES UNO DE LOS QUE ACEPTA GOOGLE
if ($tipo_mapa == "SATELLITE") $error=0;
else
  if ($tipo_mapa == "ROADMAP") $error=0;
  else 	
    if ($tipo_mapa == "TERRAIN")$error=0;
    else $tipo_mapa = "HYBRID";



?>
<?php
	session_start();
?>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0
Version: 1.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if !IE]><!--> <html lang="es" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>AELU | Sistema de Gestión</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320" />
   	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
   <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
   <link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>   
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/jquery-tags-input/jquery.tagsinput.css" />
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
   <link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
   <!-- END PAGE LEVEL PLUGIN STYLES -->
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->

   <!-- END THEME STYLES -->
   <!--<link rel="shortcut icon" href="SF.ico" />-->

<!-- END HEAD -->
<!-- BEGIN BODY -->

<!-- BEGIN BODY -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
console.log('aaaa');
// VARIABLES GLOBALES JAVASCRIPT
var geocoder;
var marker;
var latLng;
var latLng2;
var map;

// INICiALIZACION DE MAPA
function initialize() {
  geocoder = new google.maps.Geocoder();  
  latLng = new google.maps.LatLng(<?php echo $latitud;?> ,<?php echo $longitud;?>);
    console.log( document.getElementById('mapCanvas') );
  map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom:<?php echo $zoom;?>,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.<?php echo $tipo_mapa;?>
  });
  console.log( map );


// CREACION DEL MARCADOR  
    marker = new google.maps.Marker({
    position: latLng,
    title: 'Arrastra el marcador si quieres moverlo',
    map: map,
    draggable: true
  });
 
 

 
// Escucho el CLICK sobre el mama y si se produce actualizo la posicion del marcador 
     google.maps.event.addListener(map, 'click', function(event) {
     updateMarker(event.latLng);
   });
  
  // Inicializo los datos del marcador
  //    updateMarkerPosition(latLng);
     
      geocodePosition(latLng);
 
  // Permito los eventos drag/drop sobre el marcador
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Arrastrando...');
  });
 
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Arrastrando...');
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Arrastre finalizado');
    geocodePosition(marker.getPosition());
  });
  

 
}


// Permito la gesti¢n de los eventos DOM
console.log('sape');
google.maps.event.addDomListener(window, 'load', initialize);

// ESTA FUNCION OBTIENE LA DIRECCION A PARTIR DE LAS COORDENADAS POS
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('No puedo encontrar esta direccion.');
    }
  });
}

// OBTIENE LA DIRECCION A PARTIR DEL LAT y LON DEL FORMULARIO
function codeLatLon() { 
      str= document.form_mapa.longitud.value+" , "+document.form_mapa.latitud.value;
      latLng2 = new google.maps.LatLng(document.form_mapa.latitud.value ,document.form_mapa.longitud.value);
      marker.setPosition(latLng2);
      map.setCenter(latLng2);
      geocodePosition (latLng2);
      // document.form_mapa.direccion.value = str+" OK";
}

// OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
function codeAddress() {
        var address = document.form_mapa.direccion.value;
          geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             updateMarkerPosition(results[0].geometry.location);
             marker.setPosition(results[0].geometry.location);
             map.setCenter(results[0].geometry.location);
           } else {
            alert('ERROR : ' + status);
          }
        });
      }

// OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
function codeAddress2 (address) {
          
          geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             updateMarkerPosition(results[0].geometry.location);
             marker.setPosition(results[0].geometry.location);
             map.setCenter(results[0].geometry.location);
             document.form_mapa.direccion.value = address;
           } else {
            alert('ERROR : ' + status);
          }
        });
      }

function updateMarkerStatus(str) {
  document.form_mapa.direccion.value = str;
}

// RECUPERO LOS DATOS LON LAT Y DIRECCION Y LOS PONGO EN EL FORMULARIO
function updateMarkerPosition (latLng) {
  document.form_mapa.longitud.value =latLng.lng();
  document.form_mapa.latitud.value = latLng.lat();
}

function updateMarkerAddress(str) {
  document.form_mapa.direccion.value = str;
}

// ACTUALIZO LA POSICION DEL MARCADOR
function updateMarker(location) {
        marker.setPosition(location);
        updateMarkerPosition(location);
        geocodePosition(location);
      }





</script>
</head>
<body class="page-header-fixed">

<?php
	include "dbconex.php";
/*
	if (!isset($_SESSION["usuario"])){
		session_destroy();
		echo "sesion no valida";
		echo "<br><IMG SRC='error.png'>";		
	}
	else */{ 
		/*$userid = $_SESSION["usuario"];
		$nombre = $_SESSION["nombre"];
		$puesto = $_SESSION['puesto'];
		$ger_corp = $_SESSION['ger_corp'];
		$gerencia = $_SESSION['gerencia'];
		$area = $_SESSION['area'];		
		$unidad = $_SESSION['unidad'];		
		$evaluador = $_SESSION['evaluador'];
		$permiso = $_SESSION["permiso"];
		$num_col = $_SESSION["num_col"];
		$acceso = $_SESSION["acceso"];
		
		$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.2.143)(PORT = 1521)))(CONNECT_DATA = (SID = M4PREP)))"; 

		$conn = oci_connect("SF_EVADES","evadesprep",$db,'AL32UTF8') or die( "Could not connect to Oracle database!");
		if (!$conn) {  
			$e = oci_error();  
			echo $e['message']."<br>";  
		   //exitexit;  
		}  
		ini_set('charset', 'UTF-8'); 
		ini_set('default_charset', 'UTF-8');  //UTF-8
		
		$sql = "select * from EVALUACION WHERE ID_RH = '$userid'";  
		$st = oci_parse($conn, $sql);  
		oci_execute($st);  
		$result = oci_fetch_array($st, OCI_ASSOC);
		$obj_fin_estado = $result['OBJ_FINAL_ESTADO'];
		$retro_estado = $result['RETRO_ESTADO'];
			*/	

?>
  <!-- BEGIN HEADER -->   
   <div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
	  <div class="header-inner">
		<ul class="nav navbar-nav pull-right white">
						<li class="dropdown" id="header_task_bar">
               <a href="menu.php" class="dropdown-toggle" style="color:white;" >
               <i class="icon-home white" ></i>Inicio
               </a>
            </li>
		</ul>
         <ul class="nav navbar-nav pull-right">
            <!-- BEGIN USER LOGIN DROPDOWN -->
			<!--
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
               <span class="username"><?php echo htmlentities("opciones",ENT_QUOTES, 'UTF-8'); ?></span>
               <i class="icon-angle-down"></i>
               </a>
               <ul class="dropdown-menu">
                  <li><a href="#" rel="miPerfil.php" class="buttonE"><i class="icon-user"></i> Mi Perfil</a>
                  </li> 
				  <li><a href="#" rel="cambioClave.php" class="buttonE"><i class="icon-user"></i> Cambio de Clave</a>
                  </li>
                  <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Pantalla Completa</a>
                  </li>
                  <li><a href="salir.php"><i class="icon-key"></i> Salir</a>
                  </li>
               </ul>
            </li>-->

            <!-- END USER LOGIN DROPDOWN -->
         </ul>
		 </div>
         <!-- END TOP NAVIGATION MENU -->
      <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <div class="clearfix"></div>
   <!-- BEGIN CONTAINER -->
   <div class="page-container">
      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar navbar-collapse collapse">
         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
				   <a href="menu.php"><img src="logoAELU.png" alt="logo"  class="img-responsive" /></a> <!--Cambiar: logo SF-->

            <li class="">
               <a href="#" rel="mantenimiento_deportes.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Deportes</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_categorias.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Categorias</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_clubs.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Clubs</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_afiliaciones.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Afiliar Clubs</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_lugares.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Sedes</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_partidos.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Partidos</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_eventos.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Eventos</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_noticias.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Noticias</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_servicios.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Servicios</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="mantenimiento_academias.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Academias</span>
               <span class="arrow "></span>
               </a>
            </li>
			<li class="">
               <a href="#" rel="reporte_asistencia.php" class="buttonE">
               <i class="icon-bookmark"></i> 
                <span class="title">Asistencia Eventos</span>
               <span class="arrow "></span>
               </a>
            </li>
            <!--<li class="last ">
			   <a href="#" rel="objetivos.php" class="buttonE">
			   <i class="icon-bookmark"></i>                
               <span class="title">Contacto</span>
			   <span class="arrow "></span>
               </a>
            </li>-->
         </ul>
         <!-- END SIDEBAR MENU -->
	  
      </div>
      <!-- END SIDEBAR -->
      <div class="page-content">
		 <div id="resultado">
		 <div class="portlet box blue">
					  <div class="portlet-title">
						 <div class="caption">
							<i class="icon-pencil"></i>Añadir nuevo
						 </div>
					  </div>
					  <div class="portlet-body form">
					<!--	<form role="form" action="addLugarProc.php" method="post">
							<div class="form-body">
							   <div class="form-group">
								  <label for="exampleInputEmail1">Nombre:</label>
								  <input class="form-control" name="nombre" placeholder="Nombre del lugar" required>
							   </div>
							   <div class="form-group">
								  <label for="exampleInputEmail1">Latitud:</label>
								  <input class="form-control" name="latitud" placeholder="Latitud del lugar" required>
							   </div>
							   <div class="form-group">
								  <label for="exampleInputEmail1">Longitud:</label>
								  <input class="form-control" name="longitud" placeholder="Longitud del lugar" required>
							   </div>
							</div>
							<div class="form-actions">
							   <button type="submit" class="btn" style="background-color:#4CAD33; color:white">Guardar</button>
							                            
							</div>
						 </form> 
					-->
					
				 <form role="form" name="form_mapa" action="addLugarProc.php" method="post" enctype="multipart/form-data">			  
				  <div class="form-body">
							   <div class="form-group">
								  <label for="exampleInputEmail1">Nombre:</label>
								  <input class="form-control" name="nombre" placeholder="Nombre del lugar" required>
							   </div>
							   <div class="form-group">
								  <label for="exampleInputEmail1">Latitud:</label>
								  <input class="form-control" name="latitud" placeholder="Latitud del lugar" required>
							   </div>
							   <div class="form-group">
								  <label for="exampleInputEmail1">Longitud:</label>
								  <input class="form-control" name="longitud" placeholder="Longitud del lugar" required>
							   </div>
							   <div class="form-group">
								<label for="exampleInputEmail1">Dirección:</label>
								<input class="form-control" name="direccion" id="direccion"  value="<?php echo $direccion;?>">
								<input type="button" value="Buscar Calle" onclick="codeAddress()">
							  </div>
					</div>
					
							<div class="form-actions">
							   <button type="submit" class="btn" style="background-color:#4CAD33; color:white">Guardar</button>
							                            
							</div>
					
					
					 </form>
				     
				<div id="mapCanvas" style = "height: 500px; width: 500px"></div>
				</div> 
	</div>
    
		 
		 </div> <!-- Se actualizara con elección.-->
	  </div>
   </div>
   <!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
   <div class="footer">
      <div class="footer-inner">
         2015 &copy; AELU
      </div>
      <div class="footer-tools">
         <span class="go-top">
         <i class="icon-angle-up"></i>
         </span>
      </div>
   </div>
   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>

   <script src="assets/plugins/respond.min.js"></script>
   <script src="assets/plugins/excanvas.min.js"></script> 
   <![endif]-->   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
   <script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>    
   <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>   
   <script src="assets/plugins/bootstrap-switch/static/js/bootstrap-switch.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
      
   <script type="text/javascript" src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
   <script type="text/javascript" src="assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

   
   <script type="text/javascript" src="assets/plugins/fuelux/js/spinner.min.js"></script>
   <script type="text/javascript" src="assets/plugins/ckeditor/ckeditor.js"></script>  
   <script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
   <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
   
   <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js" charset="UTF-8"></script>
   <script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
   
   <script type="text/javascript" src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
     
   <script type="text/javascript" src="assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
   <script type="text/javascript" src="assets/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
   <script type="text/javascript" src="assets/plugins/jquery-multi-select/js/jquery.quicksearch.js"></script>   
   
   
   <script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
   
   <script src="assets/plugins/jquery.pwstrength.bootstrap/src/pwstrength.js" type="text/javascript" ></script>
   <script src="assets/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript" ></script>
   <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript" ></script>
   
   <!-- END CORE PLUGINS -->
   <script src="assets/scripts/app.js"></script>
   <script src="assets/scripts/form-wizard.js"></script>     
   <script src="assets/scripts/form-components.js"></script>   
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">
console.log('aaaa');
// VARIABLES GLOBALES JAVASCRIPT
var geocoder;
var marker;
var latLng;
var latLng2;
var map;

// INICiALIZACION DE MAPA
function initialize() {
  geocoder = new google.maps.Geocoder();  
  latLng = new google.maps.LatLng(<?php echo $latitud;?> ,<?php echo $longitud;?>);
    console.log( document.getElementById('mapCanvas') );
  map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom:<?php echo $zoom;?>,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.<?php echo $tipo_mapa;?>
  });
  console.log( map );


// CREACION DEL MARCADOR  
    marker = new google.maps.Marker({
    position: latLng,
    title: 'Arrastra el marcador si quieres moverlo',
    map: map,
    draggable: true
  });
 
 

 
// Escucho el CLICK sobre el mama y si se produce actualizo la posicion del marcador 
     google.maps.event.addListener(map, 'click', function(event) {
     updateMarker(event.latLng);
   });
  
  // Inicializo los datos del marcador
  //    updateMarkerPosition(latLng);
     
      geocodePosition(latLng);
 
  // Permito los eventos drag/drop sobre el marcador
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Arrastrando...');
  });
 
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Arrastrando...');
    updateMarkerPosition(marker.getPosition());
  });
 
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Arrastre finalizado');
    geocodePosition(marker.getPosition());
  });
  

 
}


// Permito la gesti¢n de los eventos DOM
console.log('sape');
google.maps.event.addDomListener(window, 'load', initialize);

// ESTA FUNCION OBTIENE LA DIRECCION A PARTIR DE LAS COORDENADAS POS
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('No puedo encontrar esta direccion.');
    }
  });
}

// OBTIENE LA DIRECCION A PARTIR DEL LAT y LON DEL FORMULARIO
function codeLatLon() { 
      str= document.form_mapa.longitud.value+" , "+document.form_mapa.latitud.value;
      latLng2 = new google.maps.LatLng(document.form_mapa.latitud.value ,document.form_mapa.longitud.value);
      marker.setPosition(latLng2);
      map.setCenter(latLng2);
      geocodePosition (latLng2);
      // document.form_mapa.direccion.value = str+" OK";
}

// OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
function codeAddress() {
        var address = document.form_mapa.direccion.value;
          geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             updateMarkerPosition(results[0].geometry.location);
             marker.setPosition(results[0].geometry.location);
             map.setCenter(results[0].geometry.location);
           } else {
            alert('ERROR : ' + status);
          }
        });
      }

// OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
function codeAddress2 (address) {
          
          geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
             updateMarkerPosition(results[0].geometry.location);
             marker.setPosition(results[0].geometry.location);
             map.setCenter(results[0].geometry.location);
             document.form_mapa.direccion.value = address;
           } else {
            alert('ERROR : ' + status);
          }
        });
      }

function updateMarkerStatus(str) {
  document.form_mapa.direccion.value = str;
}

// RECUPERO LOS DATOS LON LAT Y DIRECCION Y LOS PONGO EN EL FORMULARIO
function updateMarkerPosition (latLng) {
  document.form_mapa.longitud.value =latLng.lng();
  document.form_mapa.latitud.value = latLng.lat();
}

function updateMarkerAddress(str) {
  document.form_mapa.direccion.value = str;
}

// ACTUALIZO LA POSICION DEL MARCADOR
function updateMarker(location) {
        marker.setPosition(location);
        updateMarkerPosition(location);
        geocodePosition(location);
      }

</script>
    <script>
			function loadRed(varPage)
			{
				if(varPage){
					$.ajax({
					  url: 'contenido.php',
						data: 'boton='+varPage,
					  type: 'POST',
					  success: function(data){
						$('#resultado').html(data);
					  }
					});
				}
			}
            $(function(){			
                $(".buttonE").click(function(){
                    $('#resultado').html("");
                    var valor=$(this).attr("rel");
                    $.ajax({
                      url: 'contenido.php',
                      data: 'boton='+valor,
                      type: 'POST',
                      success: function(data){
                        $('#resultado').html(data);
                      }
                    });
                });
            });

    </script>
   <script>
      jQuery(document).ready(function() {   
         // initiate layout and plugins
         App.init();
		 
		 FormComponents.init();
      });
   </script>
   <!-- END JAVASCRIPTS -->   
      <?php
   		if(isset($_SESSION["page_id"])){
			$page_id = $_SESSION["page_id"];
			echo "<script> loadRed('".$page_id."'); </script>";
			unset($_SESSION["page_id"]);
		}
   ?>
   <?php } ?>
</body>
<!-- END BODY -->

</html>