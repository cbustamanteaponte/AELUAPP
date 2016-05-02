<!DOCTYPE html>
<?php
	session_start();
?>
<html lang="es" class="no-js">
<head>
   <?php header('Content-Type: text/html; charset=UTF-8');   ?>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
   <link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
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

<script type='text/javascript'>
$(document).ready(function(){
    // Cuando el mouse se pone encima de un elemento con el class=text
    $(".text").mouseenter(function(event){
        // Ponemos en el div flotante el contenido del attributo content del div
        // donde se encuentra el mouse (this)
        $("#flotante").html($(this).attr("content"));
        // Posicionamos el div flotante y mo lostramos
        $("#flotante").css({left:event.pageX-30, top:event.pageY+15, display:"block"});
    });
    
    // Cuando el mouse sale del elemento con el class=text
    $(".text").mouseleave(function(event){
        // Escondemos el div flotante
        $("#flotante").hide();
    });
});
</script>
       <script>
	   
		   function IsNumeric(input){
				var RE = /^-{0,1}\d*\.{0,1}\d+$/;
				return (RE.test(input));
			}
			
			$('.date-picker').datepicker({
				language: 'es'
			});
		
			function getObjetivos(){
				var contador = 0;
				$(".fila").each(function(){
					contador = contador +1;
				});
				return (contador);
			}

            $(function(){
				var total = 0;
                $(".btnModal").click(function(){
                    var idAcademia=$(this).attr("id_obj");
					var nombre=$(this).attr("nombre");
					var imagen=$(this).attr("imagen");
					var logo=$(this).attr("logo");
					
					$variablesPase = {'idAcademia':idAcademia, 'nombre':nombre,'imagen':imagen,'logo':logo};
					var relacionado=$(this).attr("relacionado");
					
					if(relacionado=="seeObj"){
						$("#respSeeData").load("verObjetivo.php",$variablesPase);
					}else if(relacionado=="editObj"){
						$("#respEditData").load("editarAcademia.php",$variablesPase);
					}else if(relacionado=="removeObj"){
						var r=window.confirm("¿Desea eliminar el objeto seleccionado?");
						if (r==true){
							$("#respDelete").load("eliminarAcademiaProc.php",{'idAcademia':idAcademia});
							$(".fila").each(function(){
								if($(this).attr("id_obj")==idAcademia){
									$(this).remove();
								}
							})
							var total = 0;
							$(".clasePeso").each(function(){
								total=total+parseFloat($(this).val());
							})
							$("#totalPeso").html(total + "%");
						
							if(total!=100){
								//$("#infoPeso").show();
								$("#btnEnviar").hide();
								//$("#btnImprimir").hide();
							}else{
								$("#btnEnviar").show();
							}
						}
					}
				});
				
				$("#btnNuevo").click(function(){
					$("#respAddData").load("addAcademia.php");					         			
				});

				$("#btnGuardar").click(function(){
         			$(".clasePeso").each(function(){
						var idObjetivo=$(this).attr("id_obj");
						var pesoOld=$(this).attr("peso");
						var peso = $(this).val();
						//alert(pesoOld);
						//alert(peso);
						
						if(peso!=pesoOld){
							$("#respUpdObj").load("updObjPeso.php",{'id_obj':idObjetivo, 'peso':peso});
							
							$(".infoAprobado").each(function(){
								if($(this).attr("id_obj")==idObjetivo){
									$(this).hide();
								}						
							})
							
							$(".infoDenegado").each(function(){
								if($(this).attr("id_obj")==idObjetivo){
									$(this).hide();
								}						
							})
							
							$(".infoPendiente").each(function(){
								if($(this).attr("id_obj")==idObjetivo){
									$(this).hide();
								}						
							})
							
							$(".infoRegistrado").each(function(){
								if($(this).attr("id_obj")==idObjetivo){
									$(this).show();
								}						
							})
							
							$(this).attr("peso",peso);
						}
					})
					$("#btnGuardar").hide();
					
					var total = 0;
					$(".clasePeso").each(function(){
						total=total+parseFloat($(this).val());
					})
					
					$("#infoGuardado").show();
					
					if(total!=100){
						//$("#infoPeso").show();
					}else{
						$("#btnEnviar").show();
					}
					
				});
				
				$("#btnEnviar").click(function(){
					var nObj = getObjetivos();
					if(nObj<3){
						$(this).attr("href","#");
						alert("Recuerda que debes tener por lo menos 3 objetivos");
					}else{
						$("#btnEnviar").hide();
						$("#infoGuardado").hide();
						/*ENVIAR */
						var evaluador=$(this).attr("eval");
						var email=$(this).attr("email");
						var email_eval=$(this).attr("email_eval");
						//alert(evaluador);
						
						mensaje = evaluador + " ha registrado sus objetivos y están pendientes de aprobación.\n\n*Recuerda que deben ser aprobados para poder cerrar el acuerdo de desempeño 2014.\n\nIngrese al siguiente link para visualizarlos:\nhttp://srvmtweb/SGD ";
						$("#respEnviar").load("sendEmail.php",{'email_from':email,'email_to':email_eval,'email_subject':"SGD-Acuerdo de desempeño 2014",'email_message':mensaje});
						$("#respEnviar").load("estadosObjetivos.php");
						//alert("win");
						$("#infoRecienEnviado").show();
						/*$("#infoEnviado").show();*/
						
						$(".infoRegistrado").each(function(){
							idObj = $(this).attr("id_obj");
							displayVal = $(this).css("display");
							if(displayVal != "none"){
								$(this).hide();
								$(".infoPendiente").each(function(){
									if($(this).attr("id_obj")==idObj){
										$(this).show();
									}
								})
							}
						})
						
						
						$(".opci").each(function(){
							$(this).remove();
						})
						
						$('.clasePeso').attr("readonly", true) 
					}
				});
				
				$("#btnImprimir").click(function () {	
					var idColaborador = $(this).attr("idCol");
					$("#respImprimir").load("descargaAcuerdo.php",{'idUserObj':idColaborador});
				})
				
				$( ".clasePeso" ).change(function () {					
						var peso = $(this).val();
						
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
					
						
						var total = 0;
						$(".clasePeso").each(function(){
							total=total+parseFloat($(this).val());
						})
						$("#totalPeso").html(total + "%");
						if( total > 100){
							$('#infoPesoMin').hide();
							$('#infoPesoMax').show();
						}else{							
							$('#infoPesoMax').hide();
							if(total < 100){
								$('#infoPesoMin').show();
							}else{
								$('#infoPesoMin').hide();
							}
						}
						
						$("#infoRecienEnviado").hide();
						/*$("#infoEnviado").hide();*/
						$("#infoGuardado").hide();
						//$("#infoPeso").hide();
						$('#btnEnviar').hide();
						$('#btnImprimir').hide();
						$('#btnGuardar').show();
					});
            });

    </script>

</head>
<body class="page-header-fixed">
<div id="flotante"></div>
<?php
	function printVar($variable) {
		if($variable){
			return htmlentities($variable,ENT_QUOTES, 'UTF-8');
		}else{
			return "-";
		}
	}
	/*
	if (!isset($_SESSION["usuario"])){
		session_destroy();
		echo "sesion no valida";
		echo "<br><IMG SRC='error.png'>";		
	}
	else*/{ 
	/*
		$userid = $_SESSION["usuario"];
		$nombre = $_SESSION["nombre"];
		$puesto = $_SESSION['puesto'];
		$ger_corp = $_SESSION['ger_corp'];
		$gerencia = $_SESSION['gerencia'];
		$area = $_SESSION['area'];		
		$unidad = $_SESSION['unidad'];	
		$evaluador = $_SESSION['evaluador'];
		$permiso = $_SESSION["permiso"];
		
		$email_eval = $_SESSION["email_eval"];
		$email = $_SESSION["email"];
		//$aprobacionGen = $_SESSION["aprobacion"];
	
		$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.2.143)(PORT = 1521)))(CONNECT_DATA = (SID = M4PREP)))"; 

		$conn = oci_connect("SF_EVADES","evadesprep",$db,'AL32UTF8') or die( "Could not connect to Oracle database!");
	
		if (!$conn) {  
			$e = oci_error();  
			echo $e['message']."<br>";  
		   //exitexit;  
		}  
		ini_set('charset', 'UTF-8'); 
		ini_set('default_charset', 'UTF-8');  //UTF-8
		
		$sql = "select APROBACION from USUARIOS WHERE ID_RH = '$userid'";  
		$st = oci_parse($conn, $sql);  
		oci_execute($st); 
		$rowUsr = oci_fetch_row($st);
		$aprobacionGen = $rowUsr[0];
		
		$sql = "select * from OBJETIVOS WHERE ID_RH = '$userid'";  
		$st = oci_parse($conn, $sql);  
		oci_execute($st);  
		$nObjetivos = oci_fetch_all($st,$results,null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		*/
		include "dbconex.php";
		$sql = "select * from academia where Activo='ACT';";
		$conn = conectarBD();
		$stmt = sqlsrv_query( $conn, $sql );		
?>
<br><br>              
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption" >
			<i class="icon-pencil"></i> Academia
        </div>
        
		<div class="tools">
			<a href="" class="collapse"></a>
			<!--<a href="#portlet-config" data-toggle="modal" class="config"></a>
			<!--<a href="" class="reload"></a>
			<!-- <a href="" class="remove"></a>-->
		</div>
	</div>
				    
	<div class="portlet-body">
		
		<div class="table-toolbar">
    		<div class="btn-group">
				<button id="btnNuevo" class="btn" style="background-color:#f6921e; color: white;" data-toggle="modal" href="#respAdd">
                    Añadir nuevo  <i class="icon-plus"></i>
                </button>
            </div>
		</div>
		<table align="center" class="table  table-striped table-bordered">
			<tr>
				<!--<td align="center"><b>NRO</b></td>-->
             	<!--<td align="center"><b>ID Deporte</b></td>-->
				<td align="center"><b>Nombre Academia</b></td>
                <td align="center"><b>&nbsp;&nbsp;Opciones&nbsp;&nbsp;</b></td>
            </tr>
			<?php
				$existen=0;
				$pesoTotal=0;
				
				while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
					$id = $col['AcademiaID'];
					$nombre = utf8_encode($col['Nombre']);
					$imagen = utf8_encode($col['Imagen']);
					$logo = utf8_encode($col['Thumbnail']);
			?>
			<tr class="fila"  id_obj="<?php echo printVar($id); ?>">
                <!--<td><?php echo printVar($id); ?></td>-->
				<td><?php echo $nombre; ?></td>
				<td align="center">						   
					<!--<a class="btnModal" 
						relacionado="seeObj"
						id_obj="<?php echo printVar($id); ?>" 
						nombre="<?php echo printVar($nombre); ?>"
					data-toggle="modal" href="#respSee"><i class="icon-search text"  content="Visualizar"></i></a>&nbsp;&nbsp;&nbsp;
					-->
					<a class="btnModal opci"  relacionado="editObj" 
						id_obj="<?php echo printVar($id); ?>" 
						nombre="<?php echo printVar($nombre); ?>"
						imagen="<?php echo printVar($imagen); ?>"
						logo="<?php echo printVar($logo); ?>"
						data-toggle="modal" 
						href="#respEdit"><i style="color:brown" class="icon-pencil text"  content="&nbsp;&nbsp;&nbsp;Editar"></i>
					</a><a class="opci">&nbsp;&nbsp;&nbsp;</a>
					<a class="btnModal opci" relacionado="removeObj" 
						id_obj="<?php echo printVar($id); ?>"
						href="#"><i style="color:red" class="icon-remove text"  content="&nbsp;Eliminar"></i>
					</a>
				</td >
            </tr>
			<?php
				}
				if($existen==1){
			?>
  			<tr border ="0">
				<td></td>
				<td></td>
				<td></td>
                <td align="right"><b>Total:</b></td>
				<td align="center"><b><div id="totalPeso"><?php echo $pesoTotal; ?>%</div></b></td>
                <td></td>
				<td></td>
				<td></td>
            </tr>
			<?php
				}
			?>
		</table>	
					<!-- responsive -->
					<div id="respUpdObj"></div>
					<div id="respEnviar"></div>
					<div id="respImprimir" class="modal fade" tabindex="-1" data-width="760">
					
					</div>					
					<div id="respDelete"></div>
					<div id="respSee" class="modal fade" tabindex="-1" data-width="760">
							<div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                             <!-- <h4 class="modal-title">Visualizar Objetivo</h4>-->
                           </div>
                          <div class="modal-body" id="respSeeData">
                          </div>
                          <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#3DB7E4; color:white">Cerrar</button>
                          </div>
                    </div>
					 
                     <div id="respEdit" class="modal fade" tabindex="-1" data-width="760">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                              <!--<h4 class="modal-title">Modificar Objetivo</h4>-->
                           </div>
                          <div class="modal-body" id="respEditData">
                          </div>
                          <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#3DB7E4; color:white">Cerrar</button>
                             <!--<button type="button" class="btn blue">Guardar</button>-->
                          </div>
                     </div>

					 <div id="respCancel" class="modal fade" tabindex="-1" data-width="760">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                              <h4 class="modal-title">Eliminar Objetivo</h4>
                           </div>
                          <div class="modal-body">
							  <h3>¿Desea Eliminar el Objetivo?</h3>
                          </div>
                          <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn blue" style="background-color:#3DB7E4; color:white">SÍ</button>
                              <button type="button" data-dismiss="modal" class="btn blue" style="background-color:#3DB7E4; color:white">NO</button>
                          </div>
                     </div>
					 
					 <div id="respAdd" class="modal fade" tabindex="-1" data-width="760">
                           <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                              <!--<h4 class="modal-title">Añadir Objetivo</h4>-->
                           </div>
                          <div class="modal-body" id="respAddData">
                          </div>
                          <div class="modal-footer">
                              <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#3DB7E4; color:white">Cerrar</button>
                              <!--<button type="button" class="btn blue">Guardar</button>-->
                          </div>
                     </div>      
			</div>
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>
   <script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
<?php	
	}
?>
</body>
<!-- END BODY -->
</html>