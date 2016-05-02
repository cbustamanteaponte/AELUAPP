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
		
		$idServicio = $_POST["idServicio"];//$row['CALC_INV'];
		$nombre = $_POST["nombre"];//$row['CALC_INV'];
		$descripcion = $_POST["descripcion"];//$row['CALC_INV'];
		$horario = $_POST["horario"];//$row['CALC_INV'];
		$precio = $_POST["precio"];//$row['CALC_INV'];
		$imagen = $_POST["imagen"];//$row['CALC_INV'];
		$logo = $_POST["logo"];//$row['CALC_INV'];
?>

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-pencil"></i>Editar
			</div>
		</div>
		<div class="portlet-body form">
			<form role="form" action="EditServicioProc.php" enctype="multipart/form-data" method="post">
				<div class="form-body">
					<div class="form-group">
								  <label for="exampleInputEmail1">Nombre:</label>
								  <input type="hidden" name="idServicio" value="<?php echo $idServicio;?>">
								  <input class="form-control" name="nombre" placeholder="Nombre del servicio" value="<?php echo $nombre;?>" required>
					</div>
					<div class="form-group">
						<label >Descripción:</label>
						<textarea class="form-control" name="descripcion" maxlength="2000" rows="10" cols="50" placeholder="Descripción del servicio" required ><?php echo $descripcion;?></textarea> 
					</div>
					<div class="form-group">
								  <label for="exampleInputEmail1">Horario:</label>
								  <input class="form-control" name="horario" placeholder="Horario del servicio" value="<?php echo $horario;?>" required>
					 </div>
					<div class="form-group">
								  <label for="exampleInputEmail1">Precio:</label>
								  <input class="form-control" name="precio" placeholder="Precio del servicio" value="<?php echo $precio;?>" required>
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

	</script>
</body>
</html>