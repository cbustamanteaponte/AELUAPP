<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idNoticia = $_POST["idNoticia"];
	   $titulo = $_POST["titulo"];
	   
	   $_SESSION["page_id"]="mantenimiento_noticias.php";
	   
		$sql = "UPDATE NOTICIA SET titulo='".$titulo."',Fecha=getdate()"
				." WHERE NoticiaID=".$idNoticia;  
		ejecutarConsulta($sql);
		
		if(basename( $_FILES['imagen']['name'])){
			$archivoID = $idNoticia;
			
			//echo $archivoID;
			$target_path = "Noticias/".$archivoID."_";
			$target_path = $target_path . basename( $_FILES['imagen']['name']); 
			if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target_path)) { 
				//echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
			} else{
				//echo "Ha ocurrido un error, trate de nuevo!";
			}
			$target_path = $ruta.$target_path;
			$sql = "Update Noticia SET imagen='".$target_path."' where NoticiaID='".$archivoID."';";
			//echo $sql;
			ejecutarConsulta($sql);
		}
		if(basename( $_FILES['logo']['name'])){
			$archivoID = $idNoticia;
			//echo $archivoID;
			$target_path = "Noticias/".$archivoID."_";
			$target_path = $target_path . basename( $_FILES['logo']['name']); 
			if(move_uploaded_file($_FILES['logo']['tmp_name'], $target_path)) { 
				//echo "El archivo ". basename( $_FILES['imagen']['name']). " ha sido subido";
			} else{
				//echo "Ha ocurrido un error, trate de nuevo!";
			}
			$target_path = $ruta.$target_path;
			$sql = "Update Noticia SET Thumbnail='".$target_path."' where NoticiaID='".$archivoID."';";
			//echo $sql;
			ejecutarConsulta($sql);
		}
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  