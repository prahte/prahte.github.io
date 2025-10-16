<?php
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# update member access to "0"
$query = "UPDATE blogs SET blog_status = 1 WHERE id = ".$_REQUEST['bID'];
$do = db_update(DITCDB, $query);

# if failed to delete listing
if($do < 0) {
	$_SESSION['alert']['message'] = 'There was a problem activating the blog. Please try again.';
	$_SESSION['alert']['type'] = 'red';
	include('p_currentListings.php');
} else {
	$_SESSION['alert']['message'] = 'Blog successfully activated!';
	$_SESSION['alert']['type'] = 'green';
	header('Location:index.php');
}
?>