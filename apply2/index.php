<?php
require_once("../includes/global/constants.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Dekalb International Training Center - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - Apply Now</title>
 
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
		<img src="<?=constant('homepath')?>images/headerIMG-apply.jpg" width="500" height="153" border="0" alt="Apply Now" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title"><h3>&nbsp;</h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<?php if(isset($_SESSION['form']['processStatus']) && $_SESSION['form']['processStatus'] == 1) { ?>
	<h6>Thank you for applying with the DITC.</h6>
	<p>Your information has been submitted to the DITC staff for review. Once approved, you will receive an e-mail with information on how to access the application form.</p>

	<?php } else { ?>
	
	<h6>To Apply Now, please fill in the pre-application form below.</h6>
	<p>The DITC will contact you via e-mail with links to the application package. Before
	completing the application package, please be sure to read all about our <a href="policies.php">policies</a>. They will be beneficial in helping you understand all the
	requirements for qualifying to enter the DeKalb International Training Center.</p>
	
	<?php
	$tok = strtok($_SESSION['error']['fields'],',');
	while ($tok) {
		$class[$tok]= "class=\"red-text\"";
		$tok = strtok(","); 
	}
	?>
	
	<?=$_SESSION['error']['message'];?>
	
	<form action="AppProcessor.php" method="post" id="applicationform" name="applicationform">
	<table border="0" cellspacing="0" cellpadding="0" class="form-table">
		<tr class="gray-bkgd">
			<td class="label-cell align-right"><p <?=$class[1]?>>First Name:</p></td>
			<td><input name="fname" id="fname" type="text" size="30" value="<?=$_SESSION['form']['fname']?>" /></td>
		</tr>
		<tr>
			<td class="label-cell align-right"><p <?=$class[2]?>>Last Name:</p></td>
			<td><input name="lname" id="lname" type="text" size="30" value="<?=$_SESSION['form']['lname']?>" /></td>
		</tr>
		<tr class="gray-bkgd">
			<td class="label-cell align-right"><p <?=$class[3]?>>Street Address:</p></td>
			<td>
			<input name="address1" id="address1" type="text" size="30" value="<?=$_SESSION['form']['address1']?>" style="margin-bottom: 5px"/><br />
			<input name="address2" id="address2" type="text" size="30" value="<?=$_SESSION['form']['address2']?>" />
			</td>
		</tr>
		<tr>
			<td class="label-cell align-right"><p <?=$class[4]?>>City:</p></td>
			<td><input name="city" id="city" type="text" size="30" value="<?=$_SESSION['form']['city']?>" /></td>
		</tr>
		<tr>
			<td class="label-cell align-right"><p <?=$class[5]?>>State and Zip Code:</p></td>
			<td>
			<input name="state" id="state" type="text" size="3" value="<?=$_SESSION['form']['state']?>" />
			<input name="zip" id="zip" type="text" size="15" value="<?=$_SESSION['form']['zip']?>" />
			</td>
		</tr>
		<tr class="gray-bkgd">
			<td class="label-cell align-right"><p <?=$class[6]?>>Country:</p></td>
			<td>
			<input name="country" id="country" type="text" size="30" value="<?=$_SESSION['form']['country']?>" /><br />
			</td>
		</tr>
		<tr>
			<td class="label-cell align-right"><p <?=$class[7]?>>Phone Number:</p></td>
			<td>
			<input name="phone" id="phone" type="text" size="30" value="<?=$_SESSION['form']['phone']?>" />
			</td>
		</tr>
		<tr class="gray-bkgd">
			<td class="label-cell align-right"><p <?=$class[8]?>>E-mail address:</p></td>
			<td><input name="email" id="email" type="text" size="30" value="<?=$_SESSION['form']['email']?>" /></td>
		</tr>
		<tr>
			<td class="label-cell align-right"><p <?=$class[9]?>>Current School:</p></td>
			<td><input name="school" id="school" type="text" size="30" value="<?=$_SESSION['form']['school']?>" /></td>
		</tr>
		<tr class="gray-bkgd">
			<td class="label-cell align-right"><p <?=$class[10]?>>How did you find out about the DITC?:</p></td>
			<td><input name="ditc_ref" id="ditc_ref" type="text" size="30" value="<?=$_SESSION['form']['ditc_ref']?>" /></td>
		</tr>
		<tr>
			<td class="label-cell align-right"><p>Would you prefer the Application<br />on CD-Rom?:</p></td>
			<td>
			<p>
			<?php if($_SESSION['form']['cd_rom'] == 1) { $checked[1] = 'checked="checked"'; } else { $checked[2] = 'checked="checked"'; } ?>
			<input name="cd_rom" id="cd_rom_yes" type="radio" style="vertical-align: middle; border: none;" value="1" <?=$checked[1]?> /> <span class="bold" style="padding-right: 10px;">YES</span>
			<input name="cd_rom" id="cd_rom_no" type="radio" style="vertical-align: middle; border: none;" value="0" <?=$checked[2]?> /> <span class="bold" style="padding-right: 10px;">NO</span>
			</p>
			</td>
		</tr>
		<tr class="gray-bkgd">
			<td colspan="2" class="align-center"><input name="submit" id="submit" type="submit" value="SUBMIT" /></td>
		</tr>
	</table>
	</form>

	<!--<script language="JavaScript" type="text/javascript">-->
	<!--
	var string1 = "msanford";
	var string2 = "@";
	var string3 = "ditc.us";
	document.write("<h6>To receive the DITC Application Package on CD, please submit by fax or e-mail a written signed request to the <a href=" + "mail" + "to:" + string1 + string2 + string3 + ">DITC Sports Director.</a></h6>");
	//-->
	<!--</script>
	<noscript><h6>To receive the DITC Application Package on CD, please submit by fax or e-mail a written signed request to the DITC Sports Director.</h6></noscript>-->

	<p>When you receive the DITC Application Package please print and fill out all information and include the necessary copies of information as required.</p>
	
	<?php } ?>
	
	<h6>If you should have any questions, contact our office at:</h6>

	<p><span class="bold">Murray Sanford, Sports Director</span><br />
	770-901-6020 - DITC telephone<br />
	404-321-5774 - DITC fax</p>
	
	<h6><a href="policies.php">View the DITC Policies &raquo;</a></h6>
	
	<?php unset($_SESSION['form']); unset($_SESSION['error']); ?>
	
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php require(constant('homepath')."includes/modules/right-sidebar.php") ?>		
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