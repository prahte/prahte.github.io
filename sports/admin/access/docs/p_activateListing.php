<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# update member access to "0"
$query = "UPDATE users SET access = 1 WHERE id = ".$_REQUEST['uID'];
$do = db_update(DITCDB, $query);

# if failed to delete listing
if($do < 0) { $_SESSION['alert']['message'] = 'There was a problem activating the member. Please try again.'; require("p_currentListings.php"); }

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Member successfully activated!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php");

?>