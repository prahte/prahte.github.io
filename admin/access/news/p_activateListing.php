<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# update member access to "0"
$query = "UPDATE ditc_news SET status = 1 WHERE id = ".$_REQUEST['nID'];
$do = db_update(DITCDB, $query);

# if failed to delete listing
if($do < 0) { $_SESSION['alert']['message'] = 'There was a problem activating the news item. Please try again.'; require("p_currentListings.php"); }

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'News item successfully activated!';
$_SESSION['alert']['type'] = 'green';
if( isset($_REQUEST['year']) ) { $queryString = '?'.$_SERVER['QUERY_STRING']; }
header("Location:index.php".$queryString."");

?>