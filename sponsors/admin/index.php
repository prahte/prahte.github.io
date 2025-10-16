<?php
require_once("../../includes/global/constants.php");
require_once(homepath."includes/global/functions.php");

# if already logged in, forward to admin home page
#if(isset($_SESSION['admin']['user_id']) && $_SESSION['admin']['user_id'] != '') { header("Location:access/"); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games ::</title>
 
<?php require(homepath."includes/modules/head.php") ?>

</head>

<body>

<div id="main-container">

<?php require(homepath."includes/modules/masthead.php") ?>

<?php require(homepath."includes/modules/top-nav.php") ?>

<div id="body-container">

<?php require(homepath."includes/modules/left-nav.php") ?>

<div id="content">
	
	<div class="body-header">
		<img src="<?=homepath?>images/headerIMG-sponsoraccess.jpg" width="500" height="153" border="0" alt="Pentathlon" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title" id="sports"><h3>&nbsp;</h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<h4 class="blue-text">Welcome to the ATLANTA 1996 Sponsor Access Section.</h4>
	
	<p>Enter your username and password below to continue.</p>

	<?php
	$tok = strtok($_SESSION['alert']['fields'],',');
	while ($tok) { $class[$tok]= 'red-text'; $tok = strtok(","); }
	?>
	
	<?php if(isset($_SESSION['alert']['message'])) { echo '<h5 class="red-text">'.$_SESSION['alert']['message'].'</h5>'; } ?>

	<form action="loginProcessor.php" method="post" name="contactForm">
	<fieldset class="t-border pad10">
	<p class="clearfix"><label for="username" class="bold <?=$class[1]?>">Username:</label><input name="username" id="username" class="textfield" value="<?=$_SESSION['form']['username']?>" /></p>
	<p class="clearfix"><label for="password" class="bold <?=$class[2]?>">Password:</label><input name="password" id="password" class="textfield" type="password" /></p>
	<p class="align-center"><input name="submit" type="submit" value="Log-in" class="button" /></p>
	</fieldset>
	</form>
	
	<!--<p class="italic">(Forget your password? <a href="pwrecover.php">CLICK HERE</a>)</p>-->
	
	<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>
	
	</div><!-- END main body content -->
	
</div><!-- END content -->

<?php require(homepath."includes/modules/right-sidebar.php") ?>		

<div class="body-clear"></div>		

</div><!-- END body-container -->
</div><!-- END main-container -->

<?php require(homepath."includes/modules/footer.php") ?>


</body>
</html>