<?php 
include "../gsession.php";

// Get member ID from first and last name.
// TODO: check unicode support.
function loadmid($firstname, $lastname) {
	$query = sprintf("SELECT mid FROM member WHERE 
		first_name='%s' and 
		last_name='%s';", 
		mysql_real_escape_string($firstname), 
		mysql_real_escape_string($lastname)
	);

	$row = mysql_fetch_assoc(mysql_query($query));
	return $row['mid'] ? $row['mid'] : "nothing";

}

// Get value for client from database.
function loadfield($mid, $field) {

	// Clean up input
	$table = 'client';
	$mid = mysql_real_escape_string($mid);
	$field = mysql_real_escape_string($field); 
	$table = mysql_real_escape_string($table);

	// Check if should be accessible
	$legitfields = array('bday', 'alertmsg', 'mlang', 'clang', 'rNotes');
	if (! in_array($field, $legitfields)) { die(); }

	// Build (very basic) query
	$query = sprintf("SELECT %s FROM %s WHERE mid=%s",
		$field, 
		$table,
		$mid 
	);

	// Load up the row as dict, and return string
	// 'nothing' if entry was blank.
	$row = mysql_fetch_assoc(mysql_query($query));
	return $row[$field] ? $row[$field] : "nothing";

}

// Main calls
if (isset($_GET['firstname'], $_GET['lastname'])) {

	echo json_encode(array('mid' => loadmid($_GET['firstname'], $_GET['lastname']) ));

}

if (isset($_GET['field'], $_GET['mid'])) {

	$field = $_GET['field'];
	$mid = $_GET['mid'];

	echo json_encode(array("value" => loadfield($mid, $field) ));

}

?>
