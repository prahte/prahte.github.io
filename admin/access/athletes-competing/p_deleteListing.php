<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# delete listings
$deleteQuery = "DELETE FROM athletes_competing WHERE id = ".$_REQUEST['cID'];
$deleteDo = db_update(DITCDB, $deleteQuery);

# if failed to delete listing
if($deleteDo < 0) { $_SESSION['alert']['message'] = 'There was a problem deleting the listing. Please try again.'; require("p_currentListings.php"); }

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Listing successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php");

?>