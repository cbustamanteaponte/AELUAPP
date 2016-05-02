<?php  
   
// conectamos de no forma no persistente  
//$conn = oci_connect("SF_EVADES", "evadesprep", "172.16.2.143:1521/M4PREP");  
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.2.143)(PORT = 1521)))(CONNECT_DATA = (SID = M4PREP)))"; 

$conn = oci_connect("SF_EVADES","evadesprep",$db) or die( "Could not connect to Oracle database!");
// controlmos el error  
if (!$conn) {  
    $e = oci_error();  
    echo $e['message']."<br>";  
   //exitexit;  
}  
  
// sql preparado para sustituir  
//$sql = "select id_RH, nombre from localidades where id = :id";  
  $sql = "select ID_RH, NOMBRE from USUARIOS";  
  
// preparamos el statement para la consulta  
$st = oci_parse($conn, $sql);  
  
// aplicamos la sustitución como si fuera un prepare statement  
//$miId = 101;  
//oci_bind_by_name($s, ":id", $miId);  
  
// ejecutamos la query  
oci_execute($st);  
  //echo $sql;
  
   $ok = oci_fetch_all($st,$results);
	foreach ($results as $col) {
		foreach ($col as $item) {
			echo " ".($item !== null ? htmlentities($item, ENT_QUOTES) : "")."\n";
		}
	}

// liberamos los recursos   
oci_free_statement($st);  
  
// cerramos la conexion  
oci_close($conn);  
?>  