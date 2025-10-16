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

if(!$processText) { $processText = 'Your Reply'; } 
# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>