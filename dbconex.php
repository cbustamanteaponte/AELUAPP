<?php
	$ruta = "http://localhost:8080/AELU/";
		function conectarBD(){
							$serverName = "aelu.database.windows.net"; //serverName\instanceName

				$serverName = "tcp:aelu.database.windows.net, 1433";
				$connectionOptions = array( "Database" => "aelu_db", 
											"UID" => "aelu@aelu",
											"PWD" => "#Carlos1234");
				$conn = sqlsrv_connect($serverName, $connectionOptions);

			//ini_set('default_charset', 'UTF-8');		
			
			if( $conn ) {
				echo "ggggwwww.<br />";
				return $conn;
			}else{
				 echo "Conexión no se pudo establecer.<br />";
				 die( print_r( sqlsrv_errors(), true));
				return 0;
			}
		}
		
		function imprimePrueba(){
			echo "hola";
		}
		
		function ejecutarConsulta($sql){
			$conn = conectarBD();
			$sql = utf8_decode($sql);
			$stmt = sqlsrv_query( $conn, $sql);
				
			if( !$stmt ) {
				die( print_r( sqlsrv_errors(), true));
			}else{
				sqlsrv_commit( $conn );
				//echo "sentencia correcta<br />";
			}
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close($conn);
		}
		/*	
		//Rutina para realizar un select 
		$sql = "select * from deporte;";
		$conn = conectarBD();
		$stmt = sqlsrv_query( $conn, $sql );
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			echo $row['DeporteID'].", ".$row['Nombre']."<br />";
		}
		sqlsrv_free_stmt( $stmt);
		sqlsrv_close($conn);
		
		
		echo "===========================";
		//Rutina para realizar una ejecucion
		$sql = "Insert into deporte(Nombre) values ('Clavados');";
		ejecutarConsulta($sql);
		
		//Rutina para realizar un select 
		$sql = "select * from deporte;";
		$conn = conectarBD();
		$stmt = sqlsrv_query( $conn, $sql );
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			echo $row['DeporteID'].", ".$row['Nombre']."<br />";
		}
		sqlsrv_free_stmt( $stmt);
		sqlsrv_close($conn);
		*/
?>