<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $eventoNombre = $_POST["eventoNombre"];
	   $descripcion = $_POST["descripcion"];
	   $fechaInicio = $_POST["fechaInicio"];
	   $fechaFin = $_POST["fechaFin"];
	   $lugarID = $_POST["lugarID"];
	   $costo = $_POST["costo"];
	  
        $_SESSION["page_id"]="mantenimiento_eventos.php";
	   //echo $target_path;
	   	$sql = "Insert into Evento(Nombre,Descripcion,FechaInicio,FechaFin,LugarID,Costo,Activo) values ('".$eventoNombre."','".$descripcion."',CONVERT(VARCHAR,'".$fechaInicio."',113),CONVERT(VARCHAR,'".$fechaFin."',113),".$lugarID.",'".$costo."','ACT');";
		//echo $sql;
		ejecutarConsulta($sql);
		
		if(basename( $_FILES['imagen']['name'])){
			$sql = "select max(EventoID) as nombreArchivo from Evento;";
			$conn = conectarBD();
			$stmt = sqlsrv_query( $conn, $sql );
			$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
			$archivoID = $row['nombreArchivo'];
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
			
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
			$sql = "select max(EventoID) as nombreArchivo from Evento;";
			$conn = conectarBD();
			$stmt = sqlsrv_query( $conn, $sql );
			$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
			$archivoID = $row['nombreArchivo'];
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
			
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