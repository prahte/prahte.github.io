<?php
# delete new entry
$deleteQuery = "DELETE FROM blogs WHERE id = ".$_REQUEST['bID'];
$delete = db_update(DITCDB, $deleteQuery);

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Blog successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php?".$_SERVER['QUERY_STRING']);
?>