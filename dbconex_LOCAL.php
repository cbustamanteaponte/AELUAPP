<?php
		function conectarBD(){
			$serverName = "THONY-VAIO"; //serverName\instanceName
			$dbName = "AELU";
			$userName ="sa";
			$password ="123456";
			
			$connectionInfo = array( "Database"=>$dbName, "UID"=>$userName, "PWD"=>$password);
			$conn = sqlsrv_connect( $serverName, $connectionInfo);
			
			
			if( $conn ) {
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