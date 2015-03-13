<?php

function convertFrench($french_string) {
	$english_string = str_replace("à","&agrave;",str_replace("é","&eacute;",str_replace("ê","&ecirc;",str_replace("è","&egrave;",str_replace("ç","&ccedil;",trim($french_string))))));
	$english_string = str_replace("À","&Agrave;",str_replace("é","&Eacute;",str_replace("Ê","&Ecirc;",str_replace("è","&Egrave;",trim($english_string)))));

	return $english_string;
}

?>
