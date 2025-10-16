<?php
# =====================================================================================
# Header Content
# =====================================================================================
$listingQuery = "SELECT * FROM blogs_posts WHERE id = ".$_REQUEST['pID'];
$listing = db_select(DITCDB, $listingQuery);

$blogQuery = "SELECT * FROM blogs WHERE id = ".$_REQUEST['bID'];
$blog = db_select(DITCDB, $blogQuery);

$usersQuery = "SELECT fname, lname, id FROM users WHERE access = 3 ORDER BY lname ASC";
$users = db_select(DITCDB, $usersQuery);

# convert query result values to SESSION values
while (list($k,$v) = each($listing[0])) { $_SESSION['form'][$k] = $v; }

$_SESSION['form']['post_day'] = date('m/d/Y',strtotime($_SESSION['form']['post_date']));
$_SESSION['form']['post_time'] = date('h:i A',strtotime($_SESSION['form']['post_date']));

# get related docs
$assetsQuery = "SELECT * FROM blogs_assets WHERE post_id = ".$_REQUEST['pID']." ORDER BY id ASC";
$assets = db_select(DITCDB, $assetsQuery);

$_SESSION['form']['assetsArray'] = $assets;

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>