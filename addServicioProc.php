<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $nombre = $_POST["nombre"];
	   $descripcion = $_POST["descripcion"];
	   $horario = $_POST["horario"];
	   $precio = $_POST["precio"];
	   $_SESSION["page_id"]="mantenimiento_servicios.php";
	   
	   	$sql = "Insert into Servicio(nombre,Descripcion,horario,precio,Activo) values ('".$nombre."','".$descripcion."','".$horario."','".$precio."','ACT');";
		ejecutarConsulta($sql);
		
		if(basename( $_FILES['imagen']['name'])){
			$sql = "select max(ServicioID) as nombreArchivo from Servicio;";
			$conn = conectarBD();
			$stmt = sqlsrv_query( $conn, $sql );
			$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
			$archivoID = $row['nombreArchivo'];
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
			
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
			$sql = "select max(ServicioID) as nombreArchivo from Servicio;";
			$conn = conectarBD();
			$stmt = sqlsrv_query( $conn, $sql );
			$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
			$archivoID = $row['nombreArchivo'];
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
			
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