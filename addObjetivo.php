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

	if (!isset($_SESSION["usuario"])){
		session_destroy();
		echo "sesion no valida";
		echo "<br><IMG SRC='error.png'>";		
	}
	else{ 
		$userid = $_SESSION["usuario"];
?>
	 <div class="portlet box blue">
					  <div class="portlet-title">
						 <div class="caption">
							<i class="icon-pencil"></i>Añadir Objetivo
						 </div>
					  </div>
					  <div class="portlet-body form">
							<form role="form" action="addObjetivoProc.php" method="post">
							<div class="form-body">
							   <div class="form-group">
								  <label for="exampleInputEmail1">Objetivo:</label>
								  <input class="form-control" name="objetivo" placeholder="Describe tu objetivo" required>
							   </div>
							   <div class="form-group">
								  <label for="exampleInputEmail1">Item de control:</label>
								  <input class="form-control" name="item" placeholder="Describe el item de control de tu objetivo" required >
							   </div>
							   <div class="form-group">
							   		<table>
										<tr>
											<td>
												<label>Categoría de medida:</label>
												<select  id="categoria-medida" name="categoria" class="form-control input-medium select2me" required>
													<option value="TIEMPO" selected="selected">TIEMPO</option>
													<option value="PORCENTAJE">PORCENTAJE</option>
													<option value="CANTIDAD">CANTIDAD</option>
													<option value="LONGITUD">LONGITUD</option>
													<option value="TEMPERATURA">TEMPERATURA</option>
													<option value="VOLUMEN">VOLUMEN</option>
													<option value="AREA">AREA</option>
													<option value="MASA">MASA</option>
													<option value="MONEDA">MONEDA</option>
													<option value="OTROS">OTROS</option>
												</select>
											</td>
											<td></td><td></td><td></td><td></td><td></td><td></td>
											<td>
												<label>Unidad de medida:</label>
												<select  id="unidad-medida" name="unidad" class="form-control input-medium select2me" required>
												</select>
											</td>
										</tr>
									</table>	
							   </div>
							   <div class="form-group">
								   <table>
								   <tr>
								   <td><label for="exampleInputEmail1">Meta:</label>
									  <input id="meta" class="form-control" name="meta" required ></td>
									  <td></td><td></td><td></td><td></td><td></td><td></td>
								   <td><label  for="exampleInputEmail1">Peso %:</label>
									  <input id="peso" maxlength="2" size="2" class="form-control" name="peso" required ></td>
								   </tr>
								   </table>			
							   </div>
							   <div class="form-group">
							     
								  <label  class=""><i class="icon-question-sign image" content="Visualizar"></i> Cálculo  inverso:</label>
								  <input type="checkbox" name="calculo" value="1">
								  <!--<div class="radio-list">
									 <label>								
									 <input type="radio" name="calculo" value="1" required>Sí
									 </label>
									 <label>
									 <input type="radio" name="calculo" value="0" checked>No
									 </label>
								  </div>-->
							   </div>
							   <div class="form-group">
								  <label  class="">Fecha de cumplimiento:</label>
								   <div class="input-group input-medium date date-picker" data-date="01-01-2014" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                    <input name="fecha" class="form-control" required>
                                    <span class="input-group-btn">
                                    <button class="btn default" type="button"><i class="icon-calendar"></i></button>
                                    </span>
                                 </div>
							  	</div>
								<div id="pop-up" style="position: absolute; display:none;"><img src="calc.png" width='350' height='315'/></div>
							   <div class="form-group">
								  <label >Plan de Acción:</label>
								  <textarea class="form-control" name="acciones" rows="10" cols="50" placeholder="Describe las acciones que tomarás para lograr el cumplimiento de tu objetivo" required ></textarea> 
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
				
		$(document).ready(function(){
		
			$("#meta").change(function(){
				meta = $(this).val();
				if (!IsNumeric(meta)){
					alert("Formato de meta incorrecto.\nDebe ser numérico");
					$(this).val(0);
				}
			})
			
			$("#peso").change(function(){
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
		
			$( "#categoria-medida" ).change(function () {
				id = $(this).val();
				if(id=="TIEMPO"){
					$("#unidad-medida").html('<option value="días">días</option><option value="meses">meses</option><option value="semanas">semanas</option><option value="horas">horas</option><option value="horas-hombre">horas-hombre</option><option value="minutos">minutos</option><option value="segundos">segundos</option>');			
				}else if(id=="PORCENTAJE"){
					$("#unidad-medida").html('<option value="%">%</option>');
				}else if(id=="CANTIDAD"){
					$("#unidad-medida").html('<option value="unidad / horas-hombre">unidad / horas-hombre</option><option value="unidad">unidad</option><option value="número">número</option>');
				}else if(id=="LONGITUD"){
					$("#unidad-medida").html('<option value="metros">metros</option><option value="kilómetros">kilómetros</option><option value="centímetros">centímetros</option><option value="micras">micras</option>');
				}else if(id=="TEMPERATURA"){
					$("#unidad-medida").html('<option value="°C">°C</option><option value="°F">°F</option>');
				}else if(id=="VOLUMEN"){
					$("#unidad-medida").html('<option value="cm3">cm3</option><option value="galón">galón</option><option value="litro">litro</option>');
				}else if(id=="AREA"){
					$("#unidad-medida").html('<option value="m2">m2</option><option value="HA (hectáreas)">HA (hectáreas)</option>');
				}else if(id=="MASA"){
					$("#unidad-medida").html('<option value="Kg.">Kg.</option><option value="Gr.">Gr.</option><option value="TM (toneladas métricas)">TM (toneladas métricas)</option>');
				}else if(id=="MONEDA"){
					$("#unidad-medida").html('<option value="PEN">PEN</option><option value="M PEN">M PEN</option><option value="MM PEN">MM PEN</option><option value="USD">USD</option><option value="M USD">M USD</option><option value="MM USD">MM USD</option>');
				}else if(id=="OTROS"){
					$("#unidad-medida").html('<option value="Gal/TM PT.">Gal/TM PT.</option><option value="Gal/TM">Gal/TM</option><option value="Kw hr/TM">Kw hr/TM</option><option value="Kw hr/TM PT">Kw hr/TM PT</option><option value="SM3/TN pellets.">SM3/TN pellets.</option><option value="M3/mes">M3/mes</option><option value="g/g">g/g</option><option value="Kg/HA">Kg/HA</option><option value="PEN/TM">PEN/TM</option>');
				}
			});
			
			$("#categoria-medida option:selected").each(function () {
				id = $(this).val();
				if(id=="TIEMPO"){
					$("#unidad-medida").html('<option value="días" selected="selected">días</option><option value="meses">meses</option><option value="semanas">semanas</option><option value="horas">horas</option><option value="horas-hombre">horas-hombre</option><option value="minutos">minutos</option><option value="segundos">segundos</option>');			
				}else if(id=="PORCENTAJE"){
					$("#unidad-medida").html('<option value="%">%</option>');
				}else if(id=="CANTIDAD"){
					$("#unidad-medida").html('<option value="unidad / horas-hombre" selected="selected">unidad / horas-hombre</option><option value="unidad">unidad</option><option value="número">número</option>');
				}else if(id=="LONGITUD"){
					$("#unidad-medida").html('<option value="metros" selected="selected">metros</option><option value="kilómetros">kilómetros</option><option value="centímetros">centímetros</option><option value="micras">micras</option>');
				}else if(id=="TEMPERATURA"){
					$("#unidad-medida").html('<option value="°C" selected="selected">°C</option><option value="°F">°F</option>');
				}else if(id=="VOLUMEN"){
					$("#unidad-medida").html('<option value="cm3" selected="selected">cm3</option><option value="galón">galón</option><option value="litro">litro</option>');
				}else if(id=="AREA"){
					$("#unidad-medida").html('<option value="m2" selected="selected">m2</option><option value="HA (hectáreas)">HA (hectáreas)</option>');
				}else if(id=="MASA"){
					$("#unidad-medida").html('<option value="Kg." selected="selected">Kg.</option><option value="Gr.">Gr.</option><option value="TM (toneladas métricas)">TM (toneladas métricas)</option>');
				}else if(id=="MONEDA"){
					$("#unidad-medida").html('<option value="PEN" selected="selected">PEN</option><option value="M PEN">M PEN</option><option value="MM PEN">MM PEN</option><option value="USD">USD</option><option value="M USD">M USD</option><option value="MM USD">MM USD</option>');
				}else if(id=="OTROS"){
					$("#unidad-medida").html('<option value="Gal/TM PT." selected="selected">Gal/TM PT.</option><option value="Gal/TM">Gal/TM</option><option value="Kw hr/TM">Kw hr/TM</option><option value="Kw hr/TM PT">Kw hr/TM PT</option><option value="SM3/TN pellets.">SM3/TN pellets.</option><option value="M3/mes">M3/mes</option><option value="g/g">g/g</option><option value="Kg/HA">Kg/HA</option><option value="PEN/TM">PEN/TM</option>');
				}
			});
		});

	</script>

</body>
</html>