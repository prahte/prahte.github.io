<?php
/**
* The database host server
*/
$DB_HOST = '208.112.107.92';

/**
* The database name
*/
$DATABASE = 'ditcus';

/**
* Open a persistent connection to the database server
*/
mysql_pconnect( $DB_HOST, 'ditcus', 'Hw893db9' ) or die(mysql_error());

/**
* Select the database
*/
mysql_select_db($DATABASE) or die(mysql_error());
?>