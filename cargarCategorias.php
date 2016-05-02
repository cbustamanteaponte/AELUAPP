<?php  
   session_start();
   { 
	   include "dbconex.php";
	   $idDeporte = $_POST["idDeporte"];
	   $sql = "select distinct(DCC.CategoriaID), C.Nombre FROM DeporteCategoriaClub DCC,Categoria C Where DCC.CategoriaID = C.CategoriaID AND C.Activo='ACT' and DCC.DeporteID=".$idDeporte;
		$conn = conectarBD();
		$stmt = sqlsrv_query( $conn, $sql );
		//echo '<select id="categoriaID" name="categoriaID" class="form-control input-medium select2me">';
		echo "<option value=0>Seleccione Categoría</option>\n"; 
		while ($col = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
			echo "<option value=".$col['CategoriaID'].">".utf8_encode($col['Nombre'])."</option>\n"; 
		}
		//echo '</select>';
	}
?>  