<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idCategoria = $_POST["idCategoria"];
	   $idDeporte = $_POST["idDeporte"];
	   $sql = "select distinct(DCC.ClubID), C.Nombre FROM DeporteCategoriaClub DCC,Club C Where DCC.ClubID = C.ClubID AND C.Activo='ACT' and DCC.DeporteID=".$idDeporte." and DCC.CategoriaID=".$idCategoria;
		$conn = conectarBD();
		$stmt = sqlsrv_query( $conn, $sql );
		//echo '<select id="categoriaID" name="categoriaID" class="form-control input-medium select2me">';
		while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
			echo "<option value=".$col['ClubID'].">".utf8_encode($col['Nombre'])."</option>\n"; 
		}
		//echo '</select>';
	}
?>  