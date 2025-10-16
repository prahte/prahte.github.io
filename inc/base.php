<?php
define('homepath', $_SERVER['DOCUMENT_ROOT']);

# array variable for relative root path
$URLarray = explode("/", $_SERVER['REQUEST_URI']);

# database name constant
define('DITCDB', 'ditcus');

# access level constants
define('NoAccess', '1');
define('StandardAccess', '2');
define('AdminAccess', '3');

/*
* Include Old School DB functions
*/
require("/home/12/65/2036512/web/ditcdbConnectOlSc.php");

/*
* Text formatting functions (intl_clean)
*/
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
}

# uses above 2 functions to convert "int'l" chars into entity, plus stand-alone ampersands and "<" ">"
# allows for option of converting quotes and adding line breaks (<br />)
function intl_clean($text, $quotes, $newline) {
	//$encoded = unicode_to_entities(utf8_to_unicode($text));
	if($quotes) { $encoded = str_replace ('"', '&#34;', $textd); }
	if($newline) { $encoded = nl2br($text); }
	$encoded = str_replace(' & ', ' &#38; ', $text);
	$encoded = str_replace(' < ', '&#60;', $text);
	$encoded = str_replace(' > ', '&#62;', $text);
	return stripslashes($text);
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

/*
* Slideshow generator
*/
function generateSlides($directory) {
	$fileArray = array();
	if (is_dir($_SERVER['DOCUMENT_ROOT'].'/images/slideshows/'.$directory)) {
		// open directory stream
		if ($dir_handler = opendir($_SERVER['DOCUMENT_ROOT'].'/images/slideshows/'.$directory)) { 
			while (($file = readdir($dir_handler)) != false) {
				if (($file != ".") && ($file != ".."))
					array_push($fileArray, $file);
			}
		}
		// close directory stream
		closedir($dir_handler);
		if( !empty($fileArray) ) {
			sort($fileArray);
			$limit = count($fileArray);
			for($i=0;$i<$limit;++$i) {
				$list .= '<li><img src="/images/slideshows/'.$directory.'/'.$fileArray[$i]."\" alt=\"\" /></li>\n";
			}
		}
		
	} else {
		$list = '<li><em>Directory not found.</em></li>';
	}
	
	return $list;
}

/*
* Maintain all sessions
*/
session_start();

/*
* Access level checks
*/
# log in status check - site admin section
if( $URLarray[2] == 'access' ) {
	if( !isset($_SESSION['admin']['user_id']) OR $_SESSION['admin']['user_id'] == '' ) {
		header('Location:/admin/logout.php');
	}
	# reset access if access level changes
	#require('');
	$currentStatusQuery = "SELECT * FROM users WHERE id = ".$_SESSION['admin']['user_id'];
	$currentStatus = db_select(DITCDB, $currentStatusQuery);
	if( ( $currentStatus[0]['access'] != $_SESSION['admin']['access_level'] ) || !$currentStatus ) {
		header("Location:".homepath."admin/logout.php");
	}
}

# log in status check - sports admin section
if( $URLarray[3] == 'access' ) { 
	if (!isset($_SESSION['admin']['user_id']) OR $_SESSION['admin']['user_id'] == '' ) {
		header('Location:/sports/admin/logout.php');
	}
	# reset access if access level changes
	#require('');
	$currentStatusQuery = "SELECT * FROM users WHERE id = ".$_SESSION['admin']['user_id'];
	$currentStatus = db_select(DITCDB, $currentStatusQuery);
	if( ( $currentStatus[0]['access'] != $_SESSION['admin']['access_level'] ) || !$currentStatus ) {
		header('Location:/sports/admin/logout.php');
	}
}

/*
 * Page title flag
 * Default is 0 (use the default site title)
 * Flag set to 1 for custom title 
 */
 $custom_title = 0;
?>
