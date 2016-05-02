<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idServicio = $_POST["idServicio"];
	   $nombre = $_POST["nombre"];
	   $descripcion = $_POST["descripcion"];
	   $horario = $_POST["horario"];
	   $precio = $_POST["precio"];
	   
	   $_SESSION["page_id"]="mantenimiento_servicios.php";
	   
		$sql = "UPDATE SERVICIO SET nombre='".$nombre."', Descripcion ='".$descripcion."', horario='".$horario."',precio='".$precio."'"
				." WHERE ServicioID=".$idServicio;  
		ejecutarConsulta($sql);
				
		if(basename( $_FILES['imagen']['name'])){
			$archivoID = $idServicio;
			
			//echo $archivoID;
			$target_path = "Servicios/".$archivoID."_";
			$target_path = $target_path . basename( $_FILES['imagen']['name']); 
			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) { 
				//echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
			} else{
				//echo "Ha ocurrido un error, trate de nuevo!";
			}
			
			$target_path = $ruta.$target_path;
			$sql = "Update Servicio SET imagen='".$target_path."' where ServicioID='".$archivoID."';";
			//echo $sql;
			ejecutarConsulta($sql);
		}
		if(basename( $_FILES['logo']['name'])){
			$archivoID = $idServicio;
			
			//echo $archivoID;
			$target_path = "Servicios/".$archivoID."_";
			$target_path = $target_path . basename( $_FILES['logo']['name']); 
			if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_path)) { 
				//echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
			} else{
				//echo "Ha ocurrido un error, trate de nuevo!";
			}
			
			$target_path = $ruta.$target_path;
			$sql = "Update Servicio SET Thumbnail='".$target_path."' where ServicioID='".$archivoID."';";
			//echo $sql;
			ejecutarConsulta($sql);
		}
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  