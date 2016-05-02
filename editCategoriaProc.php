<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idCategoria = $_POST["idCategoria"];
	   $nombre = $_POST["nombre"];
	   
	   $_SESSION["page_id"]="mantenimiento_categorias.php";
	   
		$sql = "UPDATE Categoria SET NOMBRE='".$nombre."' "
				." WHERE CategoriaID=".$idCategoria;  
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  