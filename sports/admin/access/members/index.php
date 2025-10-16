<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

# Get process key for this section
require("processKey.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Dekalb International Training Center - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - Site Administration</title>
 
<?php include(homepath."/inc/head.inc") ?>

</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container" class="clearfix">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content" class="">
		
	<div class="body-header">
		<img src="/images/headerIMG-memberaccess.jpg" width="500" height="153" border="0" alt="Pentathlon" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title align-right" id="sports"><h3><a href="/sports/admin/logout.php">Log Out</a></h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<p><a href="../index.php">Member Access Home</a> | Member Information</p>
	
	<h2 class="blue-text">Member Information</h2>
	
	<?php if(isset($_SESSION['alert']['message'])) { 
		$color = $_SESSION['alert']['type'];
		echo '<h5 class="'.$color.'-alert">'.$_SESSION['alert']['message'].'</h5>'; } ?>
	
	<?php
	$tok = strtok($_SESSION['alert']['fields'],',');
	while ($tok) { $class[$tok]= 'red-text'; $tok = strtok(","); }
	?>
	
	<!--<pre>
	<?=print_r($_SESSION['form']);?>
	</pre>-->
	
	<?php require($content); ?>
	
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