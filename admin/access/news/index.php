<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

# Get process key for this section
require("processKey.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Dekalb International Training Center - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - Site Administration</title>
 
<?php include(homepath."/inc/head.admin.inc") ?>
<style type="text/css">
/* Flickr specific styles */
#flickr_badge_wrapper { padding: 0; float: left; margin: 0 0 10px 0; }
.flickr_badge_image { margin: 0 12px 12px 0; float: left; padding: 5px; border: 1px solid #666; background-color: #fff; }
.flickr_badge_image img { border: 1px solid #000; }
#flickr_badge_source { text-align:left; margin:0 10px 0 10px; }
#flickr_badge_icon {float:left; margin-right:5px;}
#flickr_badge_source { padding:0 !important; font: 51px Arial, Helvetica, Sans serif !important; color:#666666 !important; }
</style>
<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.lightbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".lightbox").lightbox();
});
</script>
</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.admin.php") ?>

<div id="body-container" class="clearfix admin-body">

<div id="content" class="admin-content">
		
	<h2>ATLANTA DITC News</h2>
	
	<?php if(isset($_SESSION['alert']['message'])) { 
		$color = $_SESSION['alert']['type'];
		echo '<h5 class="'.$color.'-alert">'.$_SESSION['alert']['message'].'</h5>'; } ?>
	
	<?php
	$tok = strtok($_SESSION['alert']['fields'],',');
	while ($tok) { $class[$tok] = 'red-text'; $tok = strtok(","); }
	?>
	
	<!--<pre>
	<?=print_r($_SESSION['alert']);?>
	</pre>-->
	
	<?php require($content); ?>

</div><!-- END body-container -->
</div><!-- END main-container -->

<?php include(homepath."/inc/footer.inc") ?>

</body>
</html>