<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idCategoria = $_POST["idCategoria"];
	   $_SESSION["page_id"]="mantenimiento_categorias.php";
	   
	   $sql = "UPDATE CATEGORIA SET ACTIVO=NULL"
			  ." WHERE CategoriaID=".$idCategoria;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  