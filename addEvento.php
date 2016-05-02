﻿<!DOCTYPE html>
<?php
	session_start();
	include "dbconex.php";
?>
<?php
	$sql = "SELECT getDate() as fecha;";
	$conn = conectarBD();
	$stmt = sqlsrv_query( $conn, $sql );
	while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
		$fechaHoy = date_format($col['fecha'],'d M Y H:i');		
	}
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
   <style type="text/css">
    /* Estilo que muestra la capa flotante */
    #flotante
    {
        position: absolute;
        display:none;
        font-family:Arial;
        font-size:1em;
        width:70px;
        border:1px solid #808080;
        background-color:#f1f1f1;
        padding:5px;
    }
</style>
</head>
<body class="page-header-fixed">
<?php
{ 
		//$userid = $_SESSION["usuario"];
?>
	 <div class="portlet box blue">
					  <div class="portlet-title">
						 <div class="caption">
							<i class="icon-pencil"></i>Añadir nuevo
						 </div>
					  </div>
					  <div class="portlet-body form">
							<form role="form" action="addEventoProc.php" enctype="multipart/form-data" method="post">
							<div class="form-body">
							   <div class="form-group">
								  <label for="exampleInputEmail1">Nombre:</label>
								  <input class="form-control" name="eventoNombre" placeholder="Nombre del noticia" required>
							   </div>
							   <div class="form-group">
								  <label >Descripción:</label>
								  <textarea class="form-control" name="descripcion" rows="10" cols="50" placeholder="Descripción del evento" required ></textarea> 
							   </div>
							   
							   <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Inicio:</label>
                                    <div class="input-group date form_datetime" data-date="<?php echo $fechaHoy;?>" data-date-format="dd M yyyy hh:ii" id="datetimepicker">                                       
                                             <input name="fechaInicio" class="form-control" required readonly>
                                             <span class="input-group-btn">
                                             <button class="btn default date-set" type="button"><i class="icon-calendar"></i></button>
                                             </span>
                                    </div>
                                </div>
							   <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Fin:</label>
                                    <div class="input-group date form_datetime" data-date="<?php echo $fechaHoy;?>" data-date-format="dd M yyyy hh:ii" id="datetimepickerDos">                                       
                                             <input name="fechaFin" class="form-control" required readonly>
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
										echo "<option value=".$col['LugarID'].">".$col['Nombre']."</option>\n"; 
									}
								  ?>
								  </select>
							   </div>
							   <div class="form-group">
								  <label for="exampleInputEmail1">Costo:</label>
								  <input class="form-control" name="costo" placeholder="Costo del evento" required>
							   </div>
							   <div class="form-group">
								  <label for="exampleInputFile">Imagen:</label>
								  <input type="file" name="imagen" id="exampleInputFile">
							   </div>
							   <div class="form-group">
								  <label for="exampleInputFile">Logo:</label>
								  <input type="file" name="logo" id="exampleInputFile">
							   </div>
							</div>
							<div class="form-actions">
							   <button type="submit" class="btn" style="background-color:#4CAD33; color:white">Guardar</button>
							  <!-- <button type="button" class="btn default">Cancel</button>-->                           
							</div>
						 </form> 
					</div>			
	</div>

<?php	
	}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".image").mouseover(function(){
			//alert('noo');
			$("#pop-up").show();
			$("#pop-up").css({left:event.pageX-235, top:event.pageY-20, display:"block"});
		});

		$(".image").mouseout(function(){
			$("#pop-up").hide();
		});
	});
		
		$('.date-picker').datepicker({
			language: 'es'
		});
		$('#datetimepicker').datetimepicker();
		$('#datetimepickerDos').datetimepicker();
	</script>

</body>
</html>