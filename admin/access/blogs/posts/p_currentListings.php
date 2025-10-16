<?php
# =====================================================================================
# Header Content
# =====================================================================================
$postQuery = "SELECT * FROM blogs_posts WHERE blog_id = " . $_REQUEST['bID'] . " ORDER BY post_date DESC";
$posts = db_select(DITCDB, $postQuery);

$blogQuery = "SELECT * FROM blogs WHERE id = ".$_REQUEST['bID'];
$blog = db_select(DITCDB, $blogQuery);

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_currentListings.php";
?>