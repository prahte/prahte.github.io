<?php
require_once("../../../includes/global/constants.php");
require_once(homepath."includes/global/functions.php");

# Get process key for this section
require("processKey.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Dekalb International Training Center - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - Site Administration</title>
 
<?php require(homepath."includes/modules/head-admin.php") ?>
<link rel="stylesheet" href="css/local.css" media="screen" />
</head>

<body>

<div id="main-container">

<?php require(homepath."includes/modules/masthead.php") ?>

<?php require(homepath."includes/modules/top-nav-admin.php") ?>

<div id="body-container" class="clearfix admin-body">

<div id="content" class="admin-content">
		
	<h2>ATLANTA DITC Athletes Competing History</h2>
	
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

</div><!-- END body-container -->
</div><!-- END main-container -->

<?php require(homepath."includes/modules/footer.php") ?>

</body>
</html>