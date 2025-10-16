<?php
# =====================================================================================
# Header Content
# =====================================================================================
$commentsQuery = "SELECT * FROM blogs_posts_comments WHERE post_id = ".$_REQUEST['pID']." ORDER BY comment_date DESC, comment_type ASC";
$comments = db_select(DITCDB, $commentsQuery);

$postQuery = "SELECT * FROM blogs_posts WHERE id = ".$_REQUEST['pID'];
$post = db_select(DITCDB, $postQuery);

$blogQuery = "SELECT * FROM blogs WHERE id = ".$post[0]['blog_id'];
$blog = db_select(DITCDB, $blogQuery);

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_currentListings.php";
?>