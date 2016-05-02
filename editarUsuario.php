<!DOCTYPE html>
<?php
	session_start();
?>
<html lang="es" class="no-js">
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <META HTTP-EQUIV="Content-Type" content="text/html; charset=utf-8"/>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->

   <!-- BEGIN PAGE LEVEL STYLES -->          
   <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
   <!-- END PAGE LEVEL STYLES -->          
   
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">
		$(document).ready(function(){
			$("#btnGuardar").click(function(){
				var idColaborador =$("#idColaborador").val().toString();
				var nombre =$("#nombre").val().toString();
				var cod =$("#cod").val().toString();
				var puesto =$("#puesto").val().toString();
				var gerencia_corp =$("#gerencia_corp").val().toString();
				var gerencia_asoc =$("#gerencia_asoc").val().toString();
				var gerencia =$("#gerencia").val().toString();
				var area =$("#area").val().toString();
				var id_eval =$("#id_eval").val().toString();
				var nombre_eval =$("#nombre_eval").val().toString();
				var email_eval =$("#email_eval").val().toString();
				$("#cargar").load("editUsuarioProc.php",{'idColaborador':idColaborador, 'nombre':nombre,'cod':cod,'puesto':puesto,'gerencia_corp':gerencia_corp,'gerencia_asoc':gerencia_asoc,'gerencia':gerencia,'area':area,'id_eval':id_eval,'nombre_eval':nombre_eval
				, 'email_eval':email_eval});
				$("#cuerpo").remove();
			})
		});

	</script>
</head>
<body class="page-header-fixed">
<?php

	if (!isset($_SESSION["usuario"])){
		session_destroy();
		echo "sesion no valida";
		echo "<br><IMG SRC='error.png'>";		
	}
	else{ 
		$idColaborador = $_POST["idColaborador"];
	
			
		$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.2.143)(PORT = 1521)))(CONNECT_DATA = (SID = M4PREP)))"; 
		$conn = oci_connect("SF_EVADES","evadesprep",$db,'al32utf8') or die( "Could not connect to Oracle database!");
		// controlmos el error  
		if (!$conn) {  
			$e = oci_error();  
			echo $e['message']."<br>";  
		   //exitexit;  
		}
		ini_set('default_charset', 'ISO-8859-1'); 
		$sql = "select * from usuarios where id_rh='".$idColaborador."'";
		$st = oci_parse($conn, $sql);  
		oci_execute($st);
		oci_fetch_all($st,$results,null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		$nombre =  $results[0]['NOMBRE'];
		$puesto =  $results[0]['PUESTO'];
		$gerencia_corp =  $results[0]['GERENCIA_CORP'];
		$gerencia =  $results[0]['GERENCIA'];
		$area =  $results[0]['AREA'];
		$gerencia_asoc =  $results[0]['GERENCIA_ASOC'];
		$id_eval =  $results[0]['ID_EVAL'];
		$nombre_eval =  $results[0]['NOMBRE_EVAL'];			
		$email_eval =  $results[0]['EMAIL_EVAL'];		
		$cod =  $results[0]['COD'];	
		
		oci_free_statement($st);  
		oci_close($conn);	

?>

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-pencil"></i>Editar Usuario
			</div>
		</div>
		<div id="cuerpo" class="portlet-body form">
				<div class="form-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre:</label>
						<input type="hidden" id="idColaborador" value="<?php echo $idColaborador;?>">
						<input class="form-control" id="nombre"  value="<?php echo $nombre;?>" >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Código:</label>
						<input class="form-control" id="cod" value="<?php echo $cod;?>"  >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Puesto:</label>
						<input class="form-control" id="puesto" value="<?php echo $puesto;?>"  >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Gerencia Corporativa:</label>
						<input class="form-control" id="gerencia_corp" value="<?php echo $gerencia_corp;?>"  >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Gerencia Asociada:</label>
						<input class="form-control" id="gerencia_asoc" value="<?php echo $gerencia_asoc;?>" >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Gerencia:</label>
						<input class="form-control" id="gerencia" value="<?php echo $gerencia;?>"  >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Área:</label>
						<input class="form-control" id="area" value="<?php echo $area;?>"  >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Id Evaluador:</label>
						<input class="form-control" id="id_eval" value="<?php echo $id_eval;?>"  >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Nombre Evaluador:</label>
						<input class="form-control" id="nombre_eval" value="<?php echo $nombre_eval;?>"  >
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Correo Evaluador:</label>
						<input class="form-control" id="email_eval" value="<?php echo $email_eval;?>"  >
					</div>
				 </div>
				    <center><button type="submit" id = "btnGuardar" class="btn blue" style="background-color:#3DB7E4; color:white">Guardar</button></center>

		</div>	
		<div id="cargar" class="portlet-body form"></div> 
	</div>
<?php	
	}
?>

</body>
</html>