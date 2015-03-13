
<?php 
include "../gsession.php";

function savefield($mid, $field, $value) {

	// Clean up input
	$table = 'client';
	$mid = mysql_real_escape_string($mid);
	$field = mysql_real_escape_string($field); 
	$table = mysql_real_escape_string($table);
	$value = mysql_real_escape_string($value);

	// Check to make sure the field should be written to.
	$legitfields = array('bday', 'alertmsg', 'mlang', 'clang', 'rNotes');
	if (! in_array($field, $legitfields)) { 
		return array("success" => false, 
		"numrows" => 0,
		"query" => "",
		"error" => "Not in legit fields." ); 
	}

	$baseq = "UPDATE %s SET %s=%s WHERE mid=%s";

	// Switch on field and run appropriate queries.
	switch ($field) {
	case "alertmsg":
		$q1 = sprintf($baseq, $table, "alert", "1", $mid);
		$q2 = sprintf($baseq, $table, $field, sprintf("'%s'", $value), $mid);
		$q = $q2;
		$success = mysql_query($q1) and mysql_query($q2);
		break;
	case "bday":
		$value = sprintf("STR_TO_DATE('%s', '%%Y-%%m-%%d')", $value);
		$q = sprintf($baseq, $table, $field, $value, $mid);
		$success = mysql_query($q);
		break;
	case "mlang":
		$q = sprintf($baseq, $table, $field, sprintf("'%s'", $value), $mid);
		$success = mysql_query($q);
		break;
	case "clang":
		$q = sprintf($baseq, $table, $field, sprintf("'%s'", $value), $mid);
		$success = mysql_query($q);
		break;
	case "rNotes":
		$q = sprintf($baseq, $table, $field, sprintf("'%s'", $value), $mid);
		$success = mysql_query($q);
		break;
	}

	// Send a response to the client with debugging info.
	$resp = array("success" => $success, 
		"numrows" => mysql_affected_rows(),
		"query" => $q,
		"error" => mysql_error() );

	return $resp;
}

// Sanity check and main call
if (isset($_GET['mid'], $_GET['field'], $_GET['value'])) {
	if ($_GET['mid'] != "" and $_GET['field'] != "" and $_GET['value'] != "" ) {

		$field = $_GET['field'];
		$mid = $_GET['mid'];
		$value = $_GET['value'];

		echo json_encode(savefield($mid, $field, $value ));
	}
}

?>
