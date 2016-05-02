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
		
		$idLugar = $_POST["idLugar"];//$row['CALC_INV'];
		$nombre = $_POST["nombre"];//$row['CALC_INV'];
		$latitud = $_POST["latitud"];//$row['CALC_INV'];
		$longitud = $_POST["longitud"];//$row['CALC_INV'];
?>

	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="icon-pencil"></i>Editar
			</div>
		</div>
		<div class="portlet-body form">
			<form role="form" action="EditLugarProc.php" method="post">
				<div class="form-body">
					<div class="form-group">
								  <label for="exampleInputEmail1">Nombre:</label>
								  <input type="hidden" name="idLugar" value="<?php echo $idLugar;?>">
								  <input class="form-control" name="nombre" placeholder="Nombre del lugar" value="<?php echo $nombre;?>" required>
					 </div>
					<div class="form-group">
								  <label for="exampleInputEmail1">Latitud:</label>
								  <input class="form-control" name="latitud" placeholder="Latitud de la noticia" value="<?php echo $latitud;?>" required>
					 </div>
					<div class="form-group">
								  <label for="exampleInputEmail1">Longitud:</label>
								  <input class="form-control" name="longitud" placeholder="Longitud de la noticia" value="<?php echo $longitud;?>" required>
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
			
		$(document).ready(function(){
				
			$("#pesoEdit").change(function(){
				peso = $(this).val();
						if (!IsNumeric(peso)){
							alert("Recuerda que tus objetivos no deben tener peso menor a 10%");
							$(this).val(10);
						}
						
						if(peso<10){
							alert("Recuerda que tus objetivos no deben tener peso menor a 10%");
							$(this).val(10);
						}
						
						if( peso >100){
							alert("Recuerda que tus objetivos no deben tener peso mayor a 100%");
							$(this).val(10);
						}
			})
				
				
			$("#metaEdit").change(function(){
				meta = $(this).val();
				if (!IsNumeric(meta)){
					alert("Formato de meta incorrecto.\nDebe ser numérico");
					$(this).val(0);
				}
			})
			
			$( "#categoria-med" ).change(function () {
				id = $(this).val();
				if(id=="TIEMPO"){
					$("#unidad-med").html('<option value="días">días</option><option value="meses">meses</option><option value="semanas">semanas</option><option value="horas">horas</option><option value="horas-hombre">horas-hombre</option><option value="minutos">minutos</option><option value="segundos">segundos</option>');			
				}else if(id=="PORCENTAJE"){
					$("#unidad-med").html('<option value="%">%</option>');
				}else if(id=="CANTIDAD"){
					$("#unidad-med").html('<option value="unidad / horas-hombre">unidad / horas-hombre</option><option value="unidad">unidad</option><option value="número">número</option>');
				}else if(id=="LONGITUD"){
					$("#unidad-med").html('<option value="metros">metros</option><option value="kilómetros">kilómetros</option><option value="centímetros">centímetros</option><option value="micras">micras</option>');
				}else if(id=="TEMPERATURA"){
					$("#unidad-med").html('<option value="°C">°C</option><option value="°F">°F</option>');
				}else if(id=="VOLUMEN"){
					$("#unidad-med").html('<option value="cm3">cm3</option><option value="galón">galón</option><option value="litro">litro</option>');
				}else if(id=="AREA"){
					$("#unidad-med").html('<option value="m2">m2</option><option value="HA (hectáreas)">HA (hectáreas)</option>');
				}else if(id=="MASA"){
					$("#unidad-med").html('<option value="Kg.">Kg.</option><option value="Gr.">Gr.</option><option value="TM (toneladas métricas)">TM (toneladas métricas)</option>');
				}else if(id=="MONEDA"){
					$("#unidad-med").html('<option value="PEN">PEN</option><option value="M PEN">M PEN</option><option value="MM PEN">MM PEN</option><option value="USD">USD</option><option value="M USD">M USD</option><option value="MM USD">MM USD</option>');
				}else if(id=="OTROS"){
					$("#unidad-med").html('<option value="Gal/TM PT.">Gal/TM PT.</option><option value="Gal/TM">Gal/TM</option><option value="Kw hr/TM">Kw hr/TM</option><option value="Kw hr/TM PT">Kw hr/TM PT</option><option value="SM3/TN pellets.">SM3/TN pellets.</option><option value="M3/mes">M3/mes</option><option value="g/g">g/g</option><option value="Kg/HA">Kg/HA</option><option value="PEN/TM">PEN/TM</option>');
				}
			});
		});

	</script>
</body>
</html>