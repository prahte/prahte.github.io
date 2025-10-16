<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

if( !isset($_REQUEST['uID']) ) {
	header('Location:index.php');
	exit;
}

require('/var/www/vhosts/42/232937/webspace/httpdocs/ditcdbConnect.php');

$query = "SELECT * FROM blogs_posts_comments WHERE unique_id = '".$_REQUEST['uID']."'";
$result = mysql_query($query);
if(mysql_num_rows($result) == 0) {
	$message = "Error: No comment was found.";
	$type = "red-alert";
} else {
	
	$comment = mysql_fetch_assoc($result);

	if( $_REQUEST['process'] == 1 ) {
		$query = "UPDATE blogs_posts_comments SET status = 1 WHERE unique_id = '".$_REQUEST['uID']."'";
		$result = mysql_query($query);
		$flagQuery = "UPDATE blogs_posts SET comment_flag = 1 WHERE id = ".$comment['post_id'];
		$flagResult = mysql_query($flagQuery);
		$message = "Blog Comment was successfully approved. <a href=\"post.php?pID=".$comment['post_id']."#commentsHeader\">You can view it here.</a>";
		$type = "green-alert";
	}
	
	if( $_REQUEST['process'] == 0 ) {
		$query = "DELETE FROM blogs_posts_comments WHERE unique_id = '".$_REQUEST['uID']."'";
		$result = mysql_query($query);
		
		$commentsTotalQuery = "SELECT id FROM blogs_posts_comments WHERE post_id = ".$comment['post_id'];
		$commentsTotalResult = mysql_query($commentsTotalQuery);
		
		if(mysql_num_rows($commentsTotalResult) == 0) {
			$flagQuery = "UPDATE blogs_posts SET comment_flag = 0 WHERE id = ".$comment['post_id'];
			$flagResult = mysql_query($flagQuery);
		}
		$message = "Blog Comment was successfully removed.";
		$type = "green-alert";
	}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games :: &quot;Beijing Olympics&quot; Blog</title>
 
<?php include(homepath."/inc/head.beijing.inc") ?>
<link rel="stylesheet" type="text/css" media="screen" href="/beijing/css/local.css" />
<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.lightbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".lightbox").lightbox();
});
</script>
<link rel="alternate" type="application/rss+xml" href="http://ditc.us/beijing/rss/inde.php" title="RSS 2.0 feed of the ATLANTA Dekalb International Training Center's (ATLANTA DITC) Beijing Blog" />
</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content">
	<div class="body-header clearfix">
		<a href="/beijing"><img src="/images/headerIMG-BeijingBlog.jpg" width="500" height="153" border="0" alt="Beijing Olympics Blog" style="border-bottom: 2px solid #fff;"/></a>
	</div>
	
	<div class="body-section-title"><h3 style="text-align: right;">&nbsp;<a href="rss/" title="RSS Feed of the ATLANTA DITC Beijing Blog"><img src="/images/icon-rss-large.gif" alt="RSS Feed of the ATLANTA DITC Beijing Blog" width="12" height="12" /></a></h3></div>
	
	<div id="blogBody" class="pad20"><!-- START main body content -->
	
	<h5 class="<?=$type?>"><strong><?=$message?></strong></h5>	
	
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