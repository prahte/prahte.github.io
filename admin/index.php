<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

# if already logged in, forward to admin home page
if(isset($_SESSION['admin']['user_id']) && $_SESSION['admin']['user_id'] != '') { header("Location:access/"); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games :: </title>
 
<?php include(homepath."/inc/head.inc") ?>

</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content">
	
	<div class="pad15"><!-- START main body content -->
	
	<h4 class="blue-text">ATLANTA 1996 Web Site Administration</h4>
	
	<p>Enter your username and password below to continue.<br />
	<span class="italic">(Forget your password? <a href="pwrecover.php">CLICK HERE</a>)</span>
	</p>

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