<?php
//Basically unchanged from the example
function connect(){
	$conn = oci_connect('jayden1', 'Dragonxp12345t');
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	return $conn;
}
?>
