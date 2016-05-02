<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $idNoticia = $_POST["idNoticia"];
	   $_SESSION["page_id"]="mantenimiento_noticias.php";
	   
	   $sql = "UPDATE NOTICIA SET Activo=NULL"
			  ." WHERE NoticiaID=".$idNoticia;  
		ejecutarConsulta($sql);
		//echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  