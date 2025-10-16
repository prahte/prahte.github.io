<?php
# function for determining the path back to the root directory to create dynamic relative paths
$URLarray = explode("/", $_SERVER['REQUEST_URI']);

define('RPATH', $_SERVER['DOCUMENT_ROOT']);

# database constant
define('DITCDB', 'ditcus');

# access levels
define('NoAccess', '1');
define('StandardAccess', '2');
define('AdminAccess', '3');

session_start();

// log in status check - site admin section
if($URLarray[2] == 'access' && ( !isset($_SESSION['admin']['user_id']) || $_SESSION['admin']['user_id'] == '' ) ) { header("Location:".homepath."admin/logout.php"); }

// log in status check - sports admin section
if($URLarray[3] == 'access' && ( !isset($_SESSION['admin']['user_id']) || $_SESSION['admin']['user_id'] == '' ) ) { header("Location:".homepath."sports/admin/logout.php"); }


?>