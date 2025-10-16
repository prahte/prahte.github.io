<?php
# =====================================================================================
# Header Content
# =====================================================================================
$blogQuery = "SELECT * FROM blogs WHERE id = ".$_REQUEST['bID'];
$blog = db_select(DITCDB, $blogQuery);

$usersQuery = "SELECT fname, lname, id FROM users WHERE access = 3 ORDER BY lname ASC";
$users = db_select(DITCDB, $usersQuery);

if( !isset($_SESSION['form']['post_date']) ) {
	$_SESSION['form']['post_day'] = date('m\/d\/Y');
	$_SESSION['form']['post_time'] = date('h:i A');
} else {
	$_SESSION['form']['post_day'] = date('m/d/Y',strtotime($_SESSION['form']['post_date']));
	$_SESSION['form']['post_time'] = date('h:i A',strtotime($_SESSION['form']['post_date']));
}

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>