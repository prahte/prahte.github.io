<?php
require_once("../../../../includes/global/constants.php");
require_once(homepath."includes/global/functions.php");

# Get process key for this section
require("processKey.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>Atlanta Dekalb International Training Center (ATLANTA DITC) - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - Sponsor Access</title>
 
<?php require(homepath."includes/modules/head.php") ?>

</head>

<body>

<div id="main-container">

<?php require(homepath."includes/modules/masthead.php") ?>

<?php require(homepath."includes/modules/top-nav.php") ?>

<div id="body-container" class="clearfix">

<?php require(homepath."includes/modules/left-nav.php") ?>

<div id="content" class="">
		
	<div class="body-header">
		<img src="<?=homepath?>images/headerIMG-sponsoraccess.jpg" width="500" height="153" border="0" alt="Pentathlon" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title align-right" id="sports"><h3><a href="<?=homepath?>sponsors/admin/logout.php">Log Out</a></h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<p><a href="../index.php">Sponsor Access Home</a> | ATLANTA DITC Groups</p>
	
	<h2 class="blue-text">DITC Groups</h2>
	
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
<?php require(constant('homepath')."includes/modules/right-sidebar.php") ?>		
<div class="body-clear"></div>
</div><!-- END body-container -->
</div><!-- END main-container -->

<?php require(homepath."includes/modules/footer.php") ?>

</body>
</html>