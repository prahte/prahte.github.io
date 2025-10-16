<?php
# =====================================================================================
# Header Content
# =====================================================================================
$postQuery = "SELECT * FROM blogs_posts WHERE id = ".$_REQUEST['pID'];
$post = db_select(DITCDB, $postQuery);

$commentQuery = "SELECT * FROM blogs_posts_comments WHERE id = ".$_REQUEST['cID'];
$comment = db_select(DITCDB, $commentQuery);

$userQuery = "SELECT * FROM users WHERE id = ".$_SESSION['admin']['user_id'];
$user = db_select(DITCDB, $userQuery);

# convert query result values to SESSION values
while (list($k,$v) = each($comment[0])) { $_SESSION['form'][$k] = $v; }	

$processType = 'Save Edits';
$processText = 'Current Text';

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>