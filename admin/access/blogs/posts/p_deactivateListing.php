<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# update member access to "0"
$query = "UPDATE blogs SET blog_status = 0 WHERE id = ".$_REQUEST['bID'];
$do = db_update(DITCDB, $query);

# if failed to delete listing
if($do < 0) {
	$_SESSION['alert']['message'] = 'There was a problem deactivating the blog. Please try again.'; include("p_currentListings.php");
	$_SESSION['alert']['type'] = 'red';
} else {
	$_SESSION['alert']['message'] = 'Blog successfully deactivated!';
	$_SESSION['alert']['type'] = 'green';
	header('Location:index.php');
}
?>