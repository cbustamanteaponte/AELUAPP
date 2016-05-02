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
		$idAfiliacion = $_POST["idAfiliacion"];//$row['CALC_INV'];
		$deporteID = $_POST["deporteID"];//$row['CALC_INV'];
		$categoriaID = $_POST["categoriaID"];//$row['CALC_INV'];
		$clubID = $_POST["clubID"];//$row['CALC_INV'];
?>

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-pencil"></i>Editar
			</div>
		</div>
		<div class="portlet-body form">
			<form role="form" action="EditAfiliacionProc.php" method="post">
				<div class="form-body">
					<div class="form-group">
								  <label for="exampleInputEmail1">Deporte:</label>
								  <input type="hidden" name="idAfiliacion" value="<?php echo $idAfiliacion;?>">
								  <select  name="deporteID" class="form-control input-medium select2me" required>
								  <?php
									$sql = "SELECT * FROM Deporte where Activo='ACT'";
									$conn = conectarBD();
									$stmt = sqlsrv_query( $conn, $sql );
									while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
										echo "<option value=".$col['DeporteID'];
										if($deporteID === $col['DeporteID']) {
											echo ' selected="selected"';
										}
										echo '>'.$col['Nombre'].'</option>\n';										
									}
								  ?>
								  </select>
							  </div>
							  <div class="form-group">
								  <label for="exampleInputEmail1">Categoria:</label>
								   <select  name="categoriaID" class="form-control input-medium select2me" required>
								  <?php
									$sql = "SELECT * FROM Categoria where Activo='ACT'";
									$conn = conectarBD();
									$stmt = sqlsrv_query( $conn, $sql );
									while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
										echo "<option value=".$col['CategoriaID'];
										if($categoriaID === $col['CategoriaID']) {
											echo ' selected="selected"';
										}
										echo '>'.$col['Nombre'].'</option>\n';
									}
								  ?>
								  </select>
							  </div>
							   <div class="form-group">
								  <label for="exampleInputEmail1">Club:</label>
								  <select  name="clubID" class="form-control input-medium select2me" required>
								  <?php
									$sql = "SELECT * FROM Club where Activo='ACT'";
									$conn = conectarBD();
									$stmt = sqlsrv_query( $conn, $sql );
									while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
										echo "<option value=".$col['ClubID'];
										if($clubID === $col['ClubID']) {
											echo ' selected="selected"';
										}
										echo '>'.$col['Nombre'].'</option>\n';
									}
								  ?>
								  </select>
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
		$('#datetimepicker').datetimepicker();

	</script>
</body>
</html>