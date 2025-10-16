<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

session_start();

if($_POST) { include('commentProcessor.php'); }

include('/var/www/vhosts/42/232937/webspace/httpdocs/ditcdbConnect.php');
$blogPostsQuery = "SELECT p.id, p.blog_id, p.user_id, p.post_title, p.post_content, p.asset_flag, p.comment_flag, p.post_date, u.fname, u.lname
				   FROM blogs_posts AS p, users AS u 
				   WHERE
				   p.blog_id = 5
				   AND
				   u.id = p.user_id
				   ORDER BY p.post_date DESC";
$result = mysql_query($blogPostsQuery);
for($i=0;$i<mysql_num_rows($result);$i++) {
	$posts[$i] = mysql_fetch_assoc($result);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php include(homepath."/inc/head.london.inc") ?>
<link rel="stylesheet" type="text/css" media="screen" href="/london/css/local.css" />
<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.lightbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".lightbox").lightbox();
});
</script>
<link rel="alternate" type="application/rss+xml" href="http://ditc.us/london/rss/index.php" title="RSS 2.0 feed of the ATLANTA 1996 International Training Center's London 2012 WUOC House™ Blog" />
</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content">
	<div class="body-header clearfix">
		<a href="/london"><img src="/images/headerIMG-LondonBlog.jpg" width="500" height="153" border="0" alt="Beijing Olympics Blog" style="border-bottom: 2px solid #fff;"/></a>
	</div>
	
	<div class="body-section-title"><h3 style="text-align: right;">&nbsp;<a href="rss/" title="RSS Feed of the ATLANTA 1996 London 2012 WUOC House™ Blog"><img src="/images/icon-rss-large.gif" alt="RSS Feed of the ATLANTA DITC Beijing Blog" width="12" height="12" /></a></h3></div>
	
	<div id="blogBody" class="pad20"><!-- START main body content -->
		
	<ul id="blogPosts">
		<?php if(isset($_REQUEST['bID'])) {
			$limit = count($posts);
			for( $i=0; $i<$limit; $i++ ) {
				echo "<li>\n";
				echo '<h5 class="postTitle"><a href="post.php?pID='.$posts[$i]['id'].'">'.intl_clean($posts[$i]['post_title'],0,0)."</a></h5>\n";
				echo '<p class="postInfo">Posted on '.date('M j, Y \a\t g:sa',strtotime($posts[$i]['post_date'])).' by '.intl_clean($posts[$i]['fname'],0,0).' '.intl_clean($posts[$i]['lname'],0,0)."</p>\n</li>\n";
			}
		} else {
			$limit = count($posts);
			for( $i=0; $i<$limit; $i++ ) {
				if($posts[$i]['id'] == $_REQUEST['pID']) {
				$index = $i;
		?>
				<li>
					<h3 class="postTitle"><?=intl_clean($posts[$i]['post_title'],0,0)?></h3>
					<p class="postInfo">Posted on <?=date('M j, Y \a\t g:sa',strtotime($posts[$i]['post_date']))?> by <?=intl_clean($posts[$i]['fname'],0,0)?> <?=intl_clean($posts[$i]['lname'],0,0)?></p>
					<div class="postContent">
					<?=intl_clean($posts[$i]['post_content'],0,1)?>
					</div>
					<?php
						if($posts[$i]['asset_flag'] == 1) {
							echo "<h4 id=\"assetsHeader\"><em>Photos</em></h4>\n";
							echo "<ul class=\"blogPostAssets clearfix\">\n";
							$assetsQuery = "SELECT * FROM blogs_assets WHERE post_id = ".$posts[$i]['id']." ORDER BY id ASC";
							$assetsResult = mysql_query($assetsQuery);
							for($a=0; $a<mysql_num_rows($assetsResult); $a++) {
								$asset[$a] = mysql_fetch_assoc($assetsResult);
								echo '<li><a href="/news-events/articles/photos/'.$asset[$a]['file'].'" class="lightbox" rel="photos" title="'.intl_clean($asset[$a]['caption'],1,1).'"><img src="/news-events/articles/photos/'.$asset[$a]['thumbnail']."\" alt=\"\" /></a></li>\n";
							}
							echo "</ul>\n";
						}
						echo '<ul id="blogPostsItemNav" class="clearfix">';
						$next = ($index - 1);
						$previous = ($index + 1);
						echo "<li class=\"nextPost\">\n";
						if($posts[$next]['post_title'] != '') {
							$nextText = '<p class="activeNextLink"><a href="'.$_SERVER['PHP_SELF'].'?pID='.$posts[$next]['id'].'"><em>Next Post</em></a></p>';
							$nextText .= '<h5>'.intl_clean($posts[$next]['post_title'],0,0).'</h5>';
							$nextText .= '<p><em>'.date('M j, Y \a\t g:sa',strtotime($posts[$next]['post_date']))."</em></p>\n";
						} else {
							$nextText = '<p class="inActiveNextLink">&nbsp;</p>';
						}
						echo $nextText;
						echo "</li>\n";
						echo "<li class=\"previousPost\">\n";
						if($posts[$previous]['post_title'] != '') {
							$prevText = '<p class="activePrevLink"><a href="'.$_SERVER['PHP_SELF'].'?pID='.$posts[$previous]['id'].'"><em>Previous Post</em></a></p>';
							$prevText .= '<h5>'.intl_clean($posts[$previous]['post_title'],0,0).'</h5>';
							$prevText .= '<p><em>'.date('M j, Y \a\t g:sa',strtotime($posts[$previous]['post_date']))."</em></p>\n";
						} else { 
							$prevText = '<p class="inActivePrevLink">&nbsp;</p>';
						}
						echo $prevText;
						echo "</li>\n";
						echo '<li class="allPosts"><a href="'.$_SERVER['PHP_SELF'].'?bID='.$posts[0]['blog_id'].'"><em>View All Posts</em></a></li>';
						echo '</ul>';
						if($posts[$i]['comment_flag'] == 1) {
							echo "<h4 id=\"commentsHeader\"><em>Comments</em></h4>\n";
							echo "<ul class=\"blogPostComments clearfix\">\n";
							$commentsQuery = "SELECT * FROM blogs_posts_comments WHERE post_id = ".$posts[$i]['id']." AND status = 1 ORDER BY comment_date DESC, comment_type ASC";
							$commentsResult = mysql_query($commentsQuery);
							for($c=0; $c<mysql_num_rows($commentsResult); $c++) {
								$comment[$c] = mysql_fetch_assoc($commentsResult);
								echo '<li';
								if( $comment[$c]['comment_type'] == 1 ) {
									echo ' class="comment" >';
									echo '<p>&ldquo;'.intl_clean($comment[$c]['comment'],1,1).'&rdquo;</p>';
									echo '<p class="commentInfo"><strong>Submitted by:</strong> '.intl_clean($comment[$c]['name'],1,0).' on '.date('M j, Y \a\t g:sa',strtotime($comment[$c]['comment_date'])).'</p>';
									echo "</li>\n";
								} else {
									echo ' class="reply" >';
									echo '<p class="commentInfo">On '.date('M j, Y \a\t g:sa',strtotime($comment[$c]['reply_date'])).' <strong>'.intl_clean($comment[$c]['name'],1,0).'</strong> replied:</p>';
									echo '<p>&ldquo;'.intl_clean($comment[$c]['comment'],1,1).'&rdquo;</p>';
									echo "</li>\n";
								}
							}
							echo "</ul>\n";
						}
					?>
					<?php if($variable == 1) { ?>
					<!--<form action="<?=$_SERVER['PHP_SELF']?>?pID=<?=$posts[$i]['id']?>&amp;bID=<?=$posts[$i]['blog_id']?>" method="post" id="commentForm">
						<h4 id="commentFormHeader"><em>Post a Comment</em></h4>
						<p><em>*All fields required, no HTML tags allowed. To prevent spam, all comments are submitted for review prior to being published to this blog. Your e-mail address will not be shown in your comment.</em></p>
						<?php
						if(isset($_SESSION['alert']['message'])) { 
							$color = $_SESSION['alert']['type'];
							echo '<h5 class="'.$color.'-alert">'.$_SESSION['alert']['message'].'</h5>';
						}
						$tok = strtok($_SESSION['alert']['fields'],',');
						while ($tok) { $class[$tok] = 'red-text'; $tok = strtok(","); }
						?>
						<fieldset>
						<p class="clearfix"><label for="name" class="<?=$class['name']?>">Name:</label> <input name="name" id="name" type="text" maxlength="100" value="<?=intl_clean($_SESSION['form']['name'],1,0)?>" size="30" /></p>
						<p class="clearfix"><label for="email" class="<?=$class['email']?>">E-mail Address:</label> <input name="email" id="email" type="text" maxlength="50" value="<?=intl_clean($_SESSION['form']['email'],1,0)?>" size="30"/></p>
						<p class="clearfix"><label for="comment" class="<?=$class['comment']?>">Your Comment:</label> <textarea name ="comment" id="comment" rows="5" cols="35"><?=stripslashes($_SESSION['form']['comment'])?></textarea></p>
						<p class="hidden"><label for="field1">If you can see this field, leave it blank:</label> <input name="field1" id="field1" type="text" maxlength="50" value="<?=intl_clean($_SESSION['form']['field1'],1,0)?>" size="30"/></p>
						<p class="align-center" id="submitButton"><input name="submit" id="submit" type="submit" value="Submit" /></p>
						</fieldset>
					</form>-->
					<?php } ?>
				</li>
		<?php } } } ?>
	</ul>
	<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?> 
	
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php include(homepath."/inc/right-sidebar.inc") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php include(homepath."/inc/footer.inc") ?>
<?php include(homepath."/inc/ga.inc") ?>
</body>
</html>