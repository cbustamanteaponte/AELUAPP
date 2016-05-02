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
	function cargaDeporteEdit(str)
	{
		//alert('holi');
		$("#club1IDEdit").empty();
		$("#club2IDEdit").empty();
		$("#categoriaIDEdit").load("cargarCategorias.php",{'idDeporte':str});
	}
	function cargaCategoriaEdit(str)
	{
		var idDeporte = $("#deporteIDEdit").val();
		//$("#categoriaID").empty();
		$("#club1IDEdit").load("cargarClubs.php",{'idCategoria':str,'idDeporte':idDeporte});
		$("#club2IDEdit").load("cargarClubs.php",{'idCategoria':str,'idDeporte':idDeporte});
	}
</script>

</head>
<body class="page-header-fixed">
<?php
	{ 
		include "dbconex.php";
		$idPartido = $_POST["idPartido"];//$row['CALC_INV'];
		$deporteID = $_POST["deporteID"];//$row['CALC_INV'];
		$categoriaID = $_POST["categoriaID"];//$row['CALC_INV'];
		$club1ID = $_POST["club1ID"];//$row['CALC_INV'];
		$club2ID = $_POST["club2ID"];//$row['CALC_INV'];
		$lugarID = $_POST["lugarID"];//$row['CALC_INV'];
		$fecha = $_POST["fecha"];//$row['CALC_INV'];
?>

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-pencil"></i>Editar
			</div>
		</div>
		<div class="portlet-body form">
			<form role="form" action="EditPartidoProc.php" method="post">
				<div class="form-body">
					<div class="form-group">
								  <label for="exampleInputEmail1">Deporte:</label>
								  <input type="hidden" name="idPartido" value="<?php echo $idPartido;?>">
								  <select id="deporteIDEdit" name="deporteID"  onchange="cargaDeporteEdit(this.value)" class="form-control input-medium select2me" required>
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
								   <select id="categoriaIDEdit" name="categoriaID" onchange="cargaCategoriaEdit(this.value)" class="form-control input-medium select2me" required>
								  <?php
									$sql = "select distinct(DCC.CategoriaID), C.Nombre FROM DeporteCategoriaClub DCC,Categoria C Where DCC.CategoriaID = C.CategoriaID AND C.Activo='ACT' and DCC.DeporteID=".$deporteID;
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
								  <label for="exampleInputEmail1">Club 1:</label>
								  <select id="club1IDEdit" name="club1ID" class="form-control input-medium select2me" required>
								  <?php
									$sql = "select distinct(DCC.ClubID), C.Nombre FROM DeporteCategoriaClub DCC,Club C Where DCC.ClubID = C.ClubID AND C.Activo='ACT' and DCC.DeporteID=".$deporteID." and DCC.CategoriaID=".$categoriaID;
									$conn = conectarBD();
									$stmt = sqlsrv_query( $conn, $sql );
									while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
										echo "<option value=".$col['ClubID'];
										if($club1ID === $col['ClubID']) {
											echo ' selected="selected"';
										}
										echo '>'.$col['Nombre'].'</option>\n';
									}
								  ?>
								  </select>
							   </div>
							   <div class="form-group">
								  <label for="exampleInputEmail1">Club 2:</label>
								  <select  id="club2IDEdit" name="club2ID" class="form-control input-medium select2me" required>
								  <?php
									$sql = "select distinct(DCC.ClubID), C.Nombre FROM DeporteCategoriaClub DCC,Club C Where DCC.ClubID = C.ClubID AND C.Activo='ACT' and DCC.DeporteID=".$deporteID." and DCC.CategoriaID=".$categoriaID;
									$conn = conectarBD();
									$stmt = sqlsrv_query( $conn, $sql );
									while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
										echo "<option value=".$col['ClubID'];
										if($club2ID === $col['ClubID']) {
											echo ' selected="selected"';
										}
										echo '>'.$col['Nombre'].'</option>\n';
									}
								  ?>
								  </select>
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
                                    <label for="exampleInputEmail1">Fecha:</label>
                                    <div class="input-group date form_datetime" data-date="<?php echo $fecha;?>" data-date-format="dd M yyyy hh:ii" id="datetimepickerEdit">                                       
                                             <input name="fecha" value="<?php echo $fecha;?>" class="form-control" required readonly>
                                             <span class="input-group-btn">
                                             <button class="btn default date-set" type="button"><i class="icon-calendar"></i></button>
                                             </span>
                                    </div>
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

	</script>
</body>
</html>