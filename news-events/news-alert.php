<?php
require_once("../includes/global/constants.php");

if($_POST['submit'] == "CANCEL") { header("Location:index.php"); }
if($_POST['submit'] == "SUBMIT") { 
	
	$errors = 0;
	
	if($_POST['name'] == '') { $errors++; $error_message = "Please provide a name.<br />"; }
	if($_POST['email'] == '') { $errors++; $error_message .= "Please provide an E-mail address.<br />"; }
	if($_POST['zip'] == '') { $errors++; $error_message .= "Please provide a Zip code."; }
	
	if($errors == 0) {
#$mailto = "eric@erichuffman.com";
$mailto = "pr@ditc.us";
$subject = "DITC News Alert Request";
$message = "<p>You have received a news alert request from $name. Their e-mail address is $email, their zip code is $zip.</p>";
$message .= "\n"; 		
$headers = "From: ".$name." <".$email.">\n";
$headers .= "Reply-To: ".$name." <".$email.">\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/html; boundary=\"MIME_BOUNDRY\"\n";
$headers .= "X-Sender: ".$_SERVER['REMOTE_ADDR']."\n";
$headers .= "X-Mailer: phMailerv1.3\n"; 
$headers .= "X-Priority: 3\n"; 
$headers .= "Return-Path: <".$email.">\n";
		
mail($mailto,$subject,$message,$headers);

$error_message .= "Thank you for signing up! We look forward to sharing exciting DITC news with you.";

}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php $custom_title = 1 ?>
<title>ATLANTA 1996 :: The Legacy Institution of the Atlanta 1996 Centennial Olympic Games :: News Archive</title> 
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
	
	<h4 class="blue-text">ATLANTA 1996  News Flash</h4>
	
	<?php if($_POST) { ?><h6 class="blue-text"><?=$error_message?></h6><?php ; } ?>
	
	<?php if(!$_POST) { ?>
	<h6>Stay tuned with the latest news about the ATLANTA 1996, the athletes, the games and more. Simply add your email address to our mailing list.</h6>
	<?php ; } ?>
	
	<?php if(!$_POST || $errors > 0) { ?>
	
	<p class="italic red-text">All fields are required.</p>
	
	<form action="news-alert.php" method="post">
	<table border="0" cellspacing="0" cellpadding="0" class="form-table" style="width: 70%;">
		<tr class="gray-bkgd">
			<td class="label-cell"><label for="name">Name:</label></td>
			<td><input name="name" id="name" type="text" size="30" value="<?=$name?>" /></td>
		</tr>
		<tr>
			<td class="label-cell"><label for="email">E-mail address:</label></td>
			<td><input name="email" id="email" type="text" size="30" value="<?=$email?>" /></td>
		</tr>
		<tr class="gray-bkgd">
			<td class="label-cell"><label for="zip">Zip Code:</label></td>
			<td><input name="zip" id="zip" type="text" size="30" value="<?=$zip?>" /></td>
		</tr>
		<tr>
			<td colspan="2" class="align-center"><input name="submit" id="submit" type="submit" value="SUBMIT" /><input name="submit" id="cancel" type="submit" value="CANCEL" /></td>
		</tr>
	</table>
	</form>
	<?php ; } ?>
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php require(constant('homepath')."includes/modules/right-sidebar-subpages.php") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php require(constant('homepath')."includes/modules/footer.php") ?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1544491-1";
urchinTracker();
</script>
</body>
</html>