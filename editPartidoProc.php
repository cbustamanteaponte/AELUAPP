<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idPartido = $_POST["idPartido"];
	   $deporteID = $_POST["deporteID"];
	   $categoriaID = $_POST["categoriaID"];
	   $club1ID = $_POST["club1ID"];
	   $club2ID = $_POST["club2ID"];
	   $lugarID = $_POST["lugarID"];
	   $fecha = $_POST["fecha"];
	   
	   $_SESSION["page_id"]="mantenimiento_partidos.php";
	   
		$sql = "UPDATE PARTIDO SET DeporteID=".$deporteID.", CategoriaID=".$categoriaID.", ClubID1=".$club1ID.", ClubID2=".$club2ID.", LugarID=".$lugarID.", Fecha=CONVERT(VARCHAR,'".$fecha."',113)"
				." WHERE PartidoID=".$idPartido;  
		echo $sql;
		ejecutarConsulta($sql);
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=menu.php" >';
	}
?>  