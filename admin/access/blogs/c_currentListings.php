<p>Below is a list of DITC Blogs. To configure the settings of a Blog (i.e., add user access, change the title, etc.), click on the <strong>Configure Settings</strong> button. 
To post a new entry to a blog, click on the <strong>Post a New Entry</strong> button.</p>
	
<h5 class="red-text">Active Blogs</h5>

<ul class="divided-list">
<?php
$activeCount = 0;
for($i=0; $i<count($blogs); $i++) {
if( $blogs[$i]['blog_status'] == 1 ) {
$activeCount ++;
?>
<li class="clearfix">
	<h5 class="clearfix"><?=intl_clean($blogs[$i]['blog_title'],0,1)?></h5>
	<?php
	$updatesQuery = "SELECT p.post_date, p.id, u.fname, u.lname FROM blogs_posts AS p, users AS u WHERE p.blog_id = '".$blogs[$i]['id']."' AND p.user_id = u.id ORDER BY p.post_date DESC";
	$updates = db_select(DITCDB, $updatesQuery);
	if(!empty($updates)) {
		$updateDate = date('M j, Y \a\t g:sa', strtotime($updates[0]['post_date'])).' by '.intl_clean($updates[0]['fname'],0,1).' '.intl_clean($updates[0]['lname'],0,1);
	} else { $updateDate = 'No entries have been made'; $moreLink = ''; }
	?>
	<p><em>Last Updated: <a href="posts/index.php?bID=<?=$blogs[$i]['id']?>"><?=$updateDate?></a></em></p>
	<h6 class="plus"><a href="posts/index.php?bID=<?=$blogs[$i]['id']?>&amp;n=1">Post a New Entry</a></h6>
	<form action="<?=$_SERVER['PHP_SELF']?>?bID=<?=$blogs[$i]['id']?>" method="post" class="p-border gray-bkgd-fade clear-float" />
		<input name="submit" id="configure" type="submit" value="Configure Settings" class="button" />
		<input name="submit" id="deactivate" type="submit" value="Deactivate" class="button" />
	</form>
</li>
<?php } } ?>
<?php if( $activeCount == 0 ) echo '<li><p class="italic">There are currently no active blogs.</p></li>'; ?>
</ul>

<hr />

<h5 class="red-text">Inactive Blogs</h5>

<ul class="divided-list">
<?php
$InactiveCount = 0;
for($i=0; $i<count($blogs); $i++) {
if( $blogs[$i]['blog_status'] == 0 ) {
$InactiveCount ++;
?>
<li class="clearfix">
	<h5><?=intl_clean($blogs[$i]['blog_title'],0,1)?></h5>
	<form action="<?=$_SERVER['PHP_SELF']?>?bID=<?=$blogs[$i]['id']?>" method="post" class="p-border gray-bkgd-fade clear-float" />
		<input name="submit" id="activate" type="submit" value="Activate" class="button" />
		<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this blog?');" />
	</form>
</li>
<?php } } ?>
<?php if( $InactiveCount == 0 ) echo '<li><p class="italic">There are currently no Inactive blogs.</p></li>'; ?>
</ul>

</div><!-- END #content -->

<div id="admin-sidebar">

<? if( $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<h5 class="plus"><a href="<?=$_SERVER['PHP_SELF']?>?n=1">Create a New Blog</a></h5>
<?php } ?>

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>