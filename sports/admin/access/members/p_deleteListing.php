<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# get listing info
$query = "SELECT * FROM users WHERE id = ".$_REQUEST['uID'];
$do = db_select(DITCDB, $query);

if($do[0]['photo'] != '') { @unlink($_SERVER['DOCUMENT_ROOT']."/admin/access/assets/photos/".$do[0]['photo']); }

# delete listings
$deleteQuery = "DELETE FROM users WHERE id = ".$_REQUEST['uID'];
$deleteDo = db_update(DITCDB, $deleteQuery);

# if failed to delete listing
if($deleteDo < 0) { $_SESSION['alert']['message'] = 'There was a problem deleting the member account. Please try again.'; require("p_currentListings.php"); }

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Member account successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php");

?>