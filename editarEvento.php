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
 
</head>
<body class="page-header-fixed">
<?php
	{ 
		include "dbconex.php";
	   $idEvento = $_POST["idEvento"];//$row['CALC_INV'];
	   $eventoNombre = $_POST["eventoNombre"];
	   $descripcion = $_POST["descripcion"];
	   $fechaInicio = $_POST["fechaInicio"];
	   $fechaFin = $_POST["fechaFin"];
	   $lugarID = $_POST["lugarID"];
	   $costo = $_POST["costo"];
	   $imagen = $_POST["imagen"];
	   $logo = $_POST["logo"];
?>

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-pencil"></i>Editar
			</div>
		</div>
		<div class="portlet-body form">
			<form role="form" action="EditEventoProc.php" enctype="multipart/form-data" method="post">
				<div class="form-body">
					<div class="form-group">
								  <label for="exampleInputEmail1">Nombre:</label>
								  <input type="hidden" name="idEvento" value="<?php echo $idEvento;?>">
								  <input class="form-control" name="eventoNombre" placeholder="Nombre del Evento" value="<?php echo $eventoNombre;?>" required>
					 </div>
					<div class="form-group">
						<label >Descripción:</label>
						<textarea class="form-control" name="descripcion" rows="10" cols="50" placeholder="Descripción del servicio" required ><?php echo $descripcion;?></textarea> 
					</div>
					 <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Inicio:</label>
                                    <div class="input-group date form_datetime" data-date="<?php echo $fechaInicio;?>" data-date-format="dd M yyyy hh:ii" id="datetimepickerEdit">                                       
                                             <input name="fechaInicio" value="<?php echo $fechaInicio;?>" class="form-control" required readonly>
                                             <span class="input-group-btn">
                                             <button class="btn default date-set" type="button"><i class="icon-calendar"></i></button>
                                             </span>
                                    </div>
                                </div>
							   <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Fin:</label>
                                    <div class="input-group date form_datetime" data-date="<?php echo $fechaFin;?>" data-date-format="dd M yyyy hh:ii" id="datetimepickerDosEdit">                                       
                                             <input name="fechaFin"  value="<?php echo $fechaFin;?>" class="form-control" required readonly>
                                             <span class="input-group-btn">
                                             <button class="btn default date-set" type="button"><i class="icon-calendar"></i></button>
                                             </span>
                                    </div>
                                </div>
					  <div class="form-group">
								  <label for="exampleInputEmail1">Lugar:</label>
								  <select  name="lugarID" class="form-control input-medium select2me" required>
								  <?php
									$sql = "SELECT * FROM Lugar where Activo='ACT'";
									$conn = conectarBD();
									$stmt = sqlsrv_query( $conn, $sql );
									while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
										echo "<option value=".$col['LugarID'];
										if($lugarID === $col['LugarID']) {
											echo ' selected="selected"';
										}
										echo '>'.$col['Nombre'].'</option>\n';
									}
								  ?>
								  </select>
					  </div>
					  <div class="form-group">
								  <label for="exampleInputEmail1">Costo:</label>
								   <input class="form-control" name="costo" placeholder="Costo del Evento" value="<?php echo $costo;?>" required>
					 </div>
					 <div class="form-group">
								  <label for="exampleInputFile">Imagen:</label>
								  <?php
									if($imagen!='-'){
										echo "<br><img src='$imagen'><br>";
									}
   								  ?>
								  <input type="file" name="imagen" id="exampleInputFile">
					 </div>
					 <div class="form-group">
								  <label for="exampleInputFile">Logo:</label>
								  <?php
									if($logo!='-'){
										echo "<br><img src='$logo'><br>";
									}
   								  ?>
								  <input type="file" name="logo" id="exampleInputFile">
					 </div>
				<div class="form-actions">
				    <button type="submit" class="btn blue" style="background-color:#3DB7E4; color:white">Guardar</button>
				</div>
	     	 </form> 
		</div>			
	</div>
<?php	
	}
?>
  <script type="text/javascript">
		$(document).ready(function(){
			$(".imageEdit").mouseover(function(){
				//alert('noo');
				$("#pop-up-Edit").show();
				$("#pop-up-Edit").css({left:event.pageX-235, top:event.pageY-20, display:"block"});
			});

			$(".imageEdit").mouseout(function(){
				$("#pop-up-Edit").hide();
			});
		});


		$('.date-picker').datepicker({
			language: 'es'
		});
		$('#datetimepickerEdit').datetimepicker();
		$('#datetimepickerDosEdit').datetimepicker();
	</script>
</body>
</html>