<h4 class="blue-text"><?=intl_clean($blog[0]['blog_title'],0,1)?></h4>

<p>Below is a list of Comments for the Blog Post <span class="bold italic"><?=intl_clean($post[0]['post_title'],0,1)?></span> of the <strong><?=intl_clean($blog[0]['blog_title'],0,1)?> Blog</strong>. 
To reply to a comment, click on the <strong>Reply</strong> button. To make changes to a comment or reply, click on the <strong>Edit</strong> button. 
To delete a comment (or a reply), click on the <strong>Delete</strong> button.</p>
	
<div id="blogComments">
<ul>
<?php
$fullCount = count($comments);
for($i=0; $i<$fullCount; $i++) {
?>
<li>
	<?php if($comments[$i]['comment_type'] == 1) { ?>
	<div class="comment">
		<p>"<?=intl_clean($comments[$i]['comment'],0,1)?>"</p>
		<p class="light-gray italic"><strong>Submitted By:</strong> <?=intl_clean($comments[$i]['name'],0,1)?> on <?=date('M j, Y \a\t g:sa',strtotime($comments[$i]['comment_date']))?></p>
		<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>&amp;cID=<?=$comments[$i]['id']?>" method="post" class="p-border gray-bkgd-fade" />
			<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this comment? This will also remove all replies you have posted to this comment.');" />
			<input name="submit" id="reply" type="submit" value="Reply" class="button" />
			<input name="submit" id="edit" type="submit" value="Edit" class="button" />
		</form>
    </div>
    <?php } else { ?>
    <div class="reply">
		<p class="italic">On <?=date('M j, Y \a\t g:sa',strtotime($comments[$i]['reply_date']))?> <strong><?=intl_clean($comments[$i]['name'],0,1)?></strong> replied:</p>
		<p>"<?=intl_clean($comments[$i]['comment'],0,1)?>"</p>
		<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>&amp;cID=<?=$comments[$i]['id']?>" method="post" class="p-border gray-bkgd-fade" />
			<input name="submit" id="edit" type="submit" value="Edit" class="button" />
			<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this reply?');" />
		</form>
    </div>
    <?php } ?>
</li>
<?php } ?>
<?php if(empty($comments)) { echo '<li><h6 class="italic">There are currently no comments for this blog entry.'; } ?>
</ul>
</div>

</div><!-- END #content -->

<div id="admin-sidebar">

<? if( $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<h5 class="left-arrow"><a href="../index.php?bID=<?=$post[0]['blog_id']?>">Back to List of Blog Entries</a></h5>
<?php } ?>

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>