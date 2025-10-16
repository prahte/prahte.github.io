<?php
require_once("../../includes/global/constants.php");
require_once("../../includes/global/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Dekalb International Training Center - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - News &amp; Events</title>
 
<?php require(constant('homepath')."includes/modules/head.php") ?>

</head>

<body>

<div id="main-container">

<?php require(constant('homepath')."includes/modules/masthead.php") ?>

<?php require(constant('homepath')."includes/modules/top-nav.php") ?>

<div id="body-container">

<?php require(constant('homepath')."includes/modules/left-nav.php") ?>

<div id="content">
	<div class="body-header">
		<img src="<?=constant('homepath')?>images/headerIMG-news-events.jpg" width="500" height="153" border="0" alt="News &amp; Events" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title"><h3>&nbsp;</h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<?php
	$test_query = "SELECT * FROM ditc_news";
	$test = db_select("ditc", $test_query);
	#require("http://www.erichuffman.com/ditc/news-events/index.php");
	?>
	<h4><?=$test[0]['title']?></h4>
	<p><?=$test[0]['flickr_id']?></p>
	
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php require(constant('homepath')."includes/modules/right-sidebar-subpages.php") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php require(constant('homepath')."includes/modules/footer.php") ?>

</body>
</html>