<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games ::</title>
 
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
	
	<p>Enter your e-mail address below to have your password sent to you.</p>

	<?php
	$tok = strtok($_SESSION['alert']['fields'],',');
	while ($tok) { $class[$tok]= 'red-text'; $tok = strtok(","); }
	?>
	
	<?php if(isset($_SESSION['alert']['message'])) { echo '<h5 class="red-text">'.$_SESSION['alert']['message'].'</h5>'; } ?>

	<form action="recoverProcessor.php" method="post" name="contactForm">
	<fieldset class="t-border pad10">
	<p class="clearfix"><label for="email" class="bold <?=$class[1]?>">E-mail:</label><input name="email" id="email" class="textfield" value="<?=$_SESSION['form']['email']?>" /></p>
	<p class="align-center"><input name="submit" type="submit" value="Submit" class="button" /></p>
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