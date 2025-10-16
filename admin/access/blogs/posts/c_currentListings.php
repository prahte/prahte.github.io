<h4 class="blue-text"><?=intl_clean($blog[0]['blog_title'],0,1)?></h4>

<p>Below is a list of DITC Blog entries for <strong><?=intl_clean($blog[0]['blog_title'],0,1)?> Blog</strong>. To make updates to an entry, click on the <strong>Edit</strong> button. 
To post a new entry, click on the <strong><a href="<?=$_SERVER['PHP_SELF']?>?bID=<?=$_REQUEST['bID']?>&amp;n=1">Post a New Entry</a></strong> button.</p>
	
<ul class="divided-list">
<?php
$activeCount = 0;
$fullCount = count($posts);
for($i=0; $i<$fullCount; $i++) {
?>
<li class="clearfix">
	<h5><?=intl_clean($posts[$i]['post_title'],0,0)?></h5>
	<?php
	$authorQuery = "SELECT fname, lname, id FROM users WHERE id = ".$posts[$i]['user_id'];
	$author = db_select(DITCDB, $authorQuery);
	?>
	<p><em><strong>Posted by:</strong> <?=intl_clean($author[0]['fname'],0,0).' '.intl_clean($author[0]['lname'],0,0)?> on <?=date('M j, Y \a\t g:i a', strtotime($posts[$i]['post_date']))?></em></p>
	<?php
	$postTextArray = explode(' ',strip_tags($posts[$i]['post_content']));
	if(count($postTextArray) < 25) {
	    $text = $posts[$i]['post_content'];
	} else {
	    for($c=0; $c<25; ++$c) {
	        $text .= $postTextArray[$c].' ';
	     }
	     $text .= '&hellip;';
	}
	$commentsQuery = "SELECT id FROM blogs_posts_comments WHERE comment_type = 1 AND post_id = ".$posts[$i]['id'];
	$comments = db_select(DITCDB,$commentsQuery);
	if( !empty($comments) ) {
		$commentText = '<p class="italic"><a href="comments/index.php?pID='.$posts[$i]['id'].'">['.count($comments).'] Comments</a></p>';
	} else {
		$commentText = '';
	}
	?>
	<p><?=$text?></p>
	<?=$commentText?>
    <form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>&amp;pID=<?=$posts[$i]['id']?>" method="post" class="p-border gray-bkgd-fade clear-float" />
        <input name="submit" id="edit" type="submit" value="Edit" class="button" />
        <input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this blog entry?');" />
    </form>
</li>
<?php
$text = '';
}
if(empty($posts)) { echo '<li><h6 class="italic">There are currently no entries for this blog. <a href="'.$_SERVER['PHP_SELF'].'?bID='.$_REQUEST['bID'].'&amp;n=1">Make a new entry &gt;</a></h6></li>'; }
?>
</ul>

</div><!-- END #content -->

<div id="admin-sidebar">

<? if( $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<h5 class="plus"><a href="<?=$_SERVER['PHP_SELF']?>?bID=<?=$_REQUEST['bID']?>&amp;n=1">Post a New Entry</a></h5>
<h5 class="left-arrow"><a href="../index.php">Back to List of Blogs</a></h5>
<?php } ?>

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>