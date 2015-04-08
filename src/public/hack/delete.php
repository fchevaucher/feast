<?php
include "../gsession.php";

function deleteclient($mid) {
	// Clean up input
	$mid = mysql_real_escape_string($mid);

	$baseq = "DELETE FROM %s WHERE mid=%s;";

	// Switch on field and run appropriate queries.
	$q1 = sprintf($baseq, "client", $mid);
	$q2 = sprintf($baseq, "member", $mid);
	$success = mysql_query($q1) and mysql_query($q2);

	// Send a response to the client with debugging info.
	$resp = array("success" => $success, 
		"numrows" => mysql_affected_rows(),
		"query" => $q1 . $q2,
		"error" => mysql_error() );

	return $resp;
}

// Sanity check and main call
if (isset($_GET['mid'])) {
	if ($_GET['mid'] != "") {
		$mid = $_GET['mid'];
		echo json_encode(deleteclient($mid));
	} else {
		echo json_encode(array("success" => false, "numrows" => 0,
			"query" => "nil",
			"error" => "MID was blank"));
} } else {
echo json_encode(array("success" => false, "numrows" => 0,
	"query" => "nil",
	"error" => "MID was blank"));

}

?>
