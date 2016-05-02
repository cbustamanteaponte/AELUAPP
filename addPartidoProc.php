<?php  
   session_start();
	{ 
	   include "dbconex.php";
	   $deporteID = $_POST["deporteID"];
	   $categoriaID = $_POST["categoriaID"];
	   $club1ID = $_POST["club1ID"];
	   $club2ID = $_POST["club2ID"];
	   $lugarID = $_POST["lugarID"];
	   $fecha = $_POST["fecha"];
	   $_SESSION["page_id"]="mantenimiento_partidos.php";
	   
	   	$sql = "Insert into partido(DeporteID,CategoriaID,ClubID1,ClubID2,Fecha,LugarID,Activo) values (".$deporteID.",".$categoriaID.",".$club1ID.",".$club2ID.",CONVERT(VARCHAR,'".$fecha."',113),".$lugarID.",'ACT');";
		//echo $sql;
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  