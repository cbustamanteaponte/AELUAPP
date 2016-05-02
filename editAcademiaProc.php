<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idAcademia = $_POST["idAcademia"];
	   $nombre = $_POST["nombre"];
	   
	   $_SESSION["page_id"]="mantenimiento_academias.php";
	   
		$sql = "UPDATE ACADEMIA SET NOMBRE='".$nombre."' "
				." WHERE AcademiaID=".$idAcademia;  
		ejecutarConsulta($sql);
		
		if(basename( $_FILES['imagen']['name'])){
			$archivoID = $idAcademia;
			
			//echo $archivoID;
			$target_path = "Academias/".$archivoID."_";
			$target_path = $target_path . basename( $_FILES['imagen']['name']); 
			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) { 
				//echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
			} else{
				//echo "Ha ocurrido un error, trate de nuevo!";
			}
			$target_path = $ruta.$target_path;
			
			$sql = "Update Academia SET imagen='".$target_path."' where AcademiaID='".$archivoID."';";
			//echo $sql;
			ejecutarConsulta($sql);
		}
		
		if(basename( $_FILES['logo']['name'])){
			$archivoID = $idAcademia;
			
			//echo $archivoID;
			$target_path = "Academias/".$archivoID."_";
			$target_path = $target_path . basename( $_FILES['logo']['name']); 
			if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_path)) { 
				//echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
			} else{
				//echo "Ha ocurrido un error, trate de nuevo!";
			}
			$target_path = $ruta.$target_path;
			
			$sql = "Update Academia SET Thumbnail='".$target_path."' where AcademiaID='".$archivoID."';";
			//echo $sql;
			ejecutarConsulta($sql);
		}
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  