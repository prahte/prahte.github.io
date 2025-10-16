<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# get listing info
$query = "SELECT * FROM groups WHERE id = ".$_REQUEST['gID'];
$do = db_select(DITCDB, $query);

if($do[0]['logo'] != '') { @unlink($_SERVER['DOCUMENT_ROOT']."/admin/access/assets/logos/".$do[0]['logo']); }

# delete listings
$deleteQuery = "DELETE FROM groups WHERE id = ".$_REQUEST['gID'];
$deleteDo = db_update(DITCDB, $deleteQuery);

# if failed to delete listing
if($deleteDo < 0) { $_SESSION['alert']['message'] = 'There was a problem deleting the affiliation. Please try again.'; require("p_currentListings.php"); }

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Affiliation successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php");

?>