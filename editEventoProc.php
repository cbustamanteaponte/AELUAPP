<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idEvento = $_POST["idEvento"];
	   $eventoNombre = $_POST["eventoNombre"];
	   $descripcion = $_POST["descripcion"];
	   $fechaInicio = $_POST["fechaInicio"];
	   $fechaFin = $_POST["fechaFin"];
	   $lugarID = $_POST["lugarID"];
	   $costo = $_POST["costo"];
	   
	   $_SESSION["page_id"]="mantenimiento_eventos.php";
	   
		$sql = "UPDATE EVENTO SET Nombre='".$eventoNombre."', Descripcion='".$descripcion."',FechaInicio=CONVERT(VARCHAR,'".$fechaInicio."',113),FechaFin=CONVERT(VARCHAR,'".$fechaFin."',113),LugarID=".$lugarID.",Costo='".$costo."'"
				." WHERE EventoID=".$idEvento;  
		ejecutarConsulta($sql);
		
		if(basename( $_FILES['imagen']['name'])){
			$archivoID = $idEvento;
			
			//echo $archivoID;
			$target_path = "Eventos/".$archivoID."_";
			$target_path = $target_path . basename( $_FILES['imagen']['name']); 
			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) { 
				//echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
			} else{
				//echo "Ha ocurrido un error, trate de nuevo!";
			}
			
			$target_path = $ruta.$target_path;
			$sql = "Update Evento SET imagen='".$target_path."' where EventoID='".$archivoID."';";
			//echo $sql;
			ejecutarConsulta($sql);
		}
		if(basename( $_FILES['logo']['name'])){
			$archivoID = $idEvento;
			
			//echo $archivoID;
			$target_path = "Eventos/".$archivoID."_";
			$target_path = $target_path . basename( $_FILES['logo']['name']); 
			if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_path)) { 
				//echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
			} else{
				//echo "Ha ocurrido un error, trate de nuevo!";
			}
			
			$target_path = $ruta.$target_path;
			$sql = "Update Evento SET Thumbnail='".$target_path."' where EventoID='".$archivoID."';";
			//echo $sql;
			ejecutarConsulta($sql);
		}
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  