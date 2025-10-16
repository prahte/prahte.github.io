<?php

# select function,
function db_select($db, $query) {
	mysql_pconnect('208.112.107.92', 'ditcus', 'Hw893db9') or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	$result = mysql_query($query);
	if ($result) {
		for ($i=0;$i<mysql_num_rows($result);$i++) {
		$rows[$i] = mysql_fetch_assoc($result); }
		mysql_free_result($result);
	} else { $rows = ''; }
	return($rows);
}
# update funciton
function db_update($db, $query) {
	mysql_pconnect('208.112.107.92', 'ditcus', 'Hw893db9') or die(mysql_error());
	mysql_select_db($db) or die(mysql_error());
	mysql_query($query);
	return(mysql_affected_rows());
}
# insert function
function db_insert($db, $query) {
	mysql_pconnect('208.112.107.92', 'ditcus', 'Hw893db9') or die(mysql_error());
	mysql_select_db($db)or die(mysql_error());
	mysql_query($query);
	return mysql_insert_id();
}


?>