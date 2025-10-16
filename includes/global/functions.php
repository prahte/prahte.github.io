<?php

/*
* Include Old School DB functions
*/
require('/vservers/ditcus/ditcdbConnectOlSc.php');

# converts all characters in a string into an array of unicode number equivalents
function utf8_to_unicode( $str ) {
	for ($i = 0; $i < strlen( $str ); $i++ ) {
		$thisValue = ord( $str[ $i ] );
		$unicode[] = $thisValue;
	}
	return $unicode;
}
	
# converts all in the array resulting from above function into an HTML entity (if greater than 128 -- most normal char. are <= 128)
function unicode_to_entities( $unicode ) {
        
        $entities = '';
        foreach( $unicode as $value ) if($value > 128) { $entities .= '&#' . $value . ';'; } else { $entities .= chr($value); }
        return $entities;
        
} // unicode_to_entities

# uses above 2 functions to convert "int'l" chars into entity, plus stand-alone ampersands and "<" ">"
# allows for option of converting quotes and adding line breaks (<br />)
function intl_clean($text, $quotes, $newline) {
	$encoded = unicode_to_entities(utf8_to_unicode($text));
	if($quotes) { $encoded = str_replace ('"', '&#34;', $encoded); }
	if($newline) { $encoded = nl2br($encoded); }
	$encoded = str_replace(' & ', ' &#38; ', $encoded);
	$encoded = str_replace(' < ', '&#60;', $encoded);
	$encoded = str_replace(' > ', '&#62;', $encoded);
	return stripslashes($encoded);
}

// get format for date display
function date_result($start, $stop) {
	 if(($stop != '' && $stop != "0000-00-00") && date('Y-m-d', strtotime($start)) != date('Y-m-d', strtotime($stop))) { 
		if(date('Y', strtotime($stop)) != date('Y', strtotime($start)) || date('m', strtotime($stop)) != date('m', strtotime($start))) {
			$date = date('F j, Y', strtotime($start))." - ".date('M j, Y', strtotime($stop)); }
		else {  
			$date = date('F j', strtotime($start))." - ".date('j', strtotime($stop)).", ".date('Y', strtotime($stop)); } }
	else { $date = date('F j, Y', strtotime($start)); }	
	return ($date);
}

// access change boot -- will kick user out of admin area if their status has changed
if( $URLarray[2] == 'access' ) {
	$currentStatusQuery = "SELECT * FROM users WHERE id = ".$_SESSION['admin']['user_id'];
	$currentStatus = db_select(DITCDB, $currentStatusQuery);
	if( ( $currentStatus[0]['access'] != $_SESSION['admin']['access_level'] ) || !$currentStatus ) { header("Location:".homepath."admin/logout.php"); }
}

// access change boot -- will kick user out of SPORTS admin area if their status has changed
if( $URLarray[3] == 'access' ) {
	$currentStatusQuery = "SELECT * FROM users WHERE id = ".$_SESSION['admin']['user_id'];
	$currentStatus = db_select(DITCDB, $currentStatusQuery);
	if( ( $currentStatus[0]['access'] != $_SESSION['admin']['access_level'] ) || !$currentStatus ) { header("Location:".homepath."sports/admin/logout.php"); }
}
?>