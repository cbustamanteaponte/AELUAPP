<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $nombre = $_POST["nombre"];
	   $_SESSION["page_id"]="mantenimiento_categorias.php";
	   
	   	$sql = "Insert into Categoria(Nombre,Activo) values ('".$nombre."','ACT');";
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  