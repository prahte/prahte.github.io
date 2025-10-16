<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# change comment flag for post if this was the only comment
$commentCheckQuery = "SELECT id FROM blogs_posts_comments WHERE post_id = ".$_REQUEST['pID']." AND comment_type = 1";
$commentCheck = db_select(DITCDB, $commentCheckQuery);
if( count($commentCheck) == 1 ) {
	$updatePostQuery = "UPDATE blogs_posts SET comment_flag = 0 WHERE id = ".$_REQUEST['pID'];
	$updatePost = db_update(DITCDB,$updatePostQuery);
}

# delete comment
$deleteQuery = "DELETE FROM blogs_posts_comments WHERE id = ".$_REQUEST['cID'];
$delete = db_update(DITCDB, $deleteQuery);

# check for replies, and delete those too.
$replyDeleteQuery = "DELETE FROM blogs_posts_comments WHERE org_id = ".$_REQUEST['cID'];
$replyDelete = db_update(DITCDB, $replyDeleteQuery);


unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Comment successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php?pID=".$_REQUEST['pID']);
?>