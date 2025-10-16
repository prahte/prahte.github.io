<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php $custom_title = 1 ?>
<title>ATLANTA 1996 :: The Legacy Institution of the Atlanta 1996 Centennial Olympic Games :: Our Purpose - Video</title>
<?php include(homepath."/inc/head.inc") ?>
<script type="text/javascript">
swfobject.embedSWF("ditc_video.swf", "flashcontent", "240", "200", "5.0.0");
</script>
</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content">

	<div class="pad15 plain-content"><!-- START main body content -->
	
	<h4 class="align-center blue-text">The ATLANTA 1996 in Action</h4>
	<p class="align-center">Produced by Diamond Lewis, Director of DCTV Channel 23</p>
	<div style="padding-left:110px;">
	<p id="flashcontent" class="pad20 align-center">
		The Version 7.0 or greater Flash Player plug-in is required to view the video.<br/>
		Visit the <a href="http://www.macromedia.com/go/getflashplayer">Flash Player Web site</a> to download the latest plug-in.
	</p>
	</div>

	<p class="align-center"><a href="index.php">BACK to <span class="bold">Our Purpose</span></a></p>

	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php include(homepath."/inc/right-sidebar.inc") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php include(homepath."/inc/footer.inc") ?>
<?php include(homepath."inc/ga.inc") ?>
</body>
</html>