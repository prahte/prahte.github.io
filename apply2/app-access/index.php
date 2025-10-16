<?php
require_once("../../includes/global/constants.php");
require_once("../../includes/global/functions.php");

$error = 0;

if(isset($_REQUEST['aID']) && $_REQUEST['aID'] != '' && isset($_REQUEST['appID']) && $_REQUEST['appID'] != '' ) {
	$app_query = "SELECT * FROM application WHERE id = ".$_REQUEST['aID'];
	$app = db_select(DITCDB,$app_query);
	if(empty($app) || $app[0]['app_id'] != 0) { $error++; $error_message = '<h5 class="red-text">There was an error processing your request. The applicant may not exisit, or may have already received approval to access the application.</h5>';
	} else { $app_access = 'admin'; }
}

elseif(isset($_REQUEST['uID']) && $_REQUEST['uID'] != '') {
	$app_query = "SELECT * FROM application WHERE u_id = '".$_REQUEST['uID']."'";
	$app = db_select(DITCDB,$app_query);
	if(empty($app)) { $error++; $error_message = '<h5 class="red-text">There was an error processing your request. The application information could not be verified.</h5>';
	} else { $app_access = 'user'; }
}
else { $error++;
	$error_message = '<h5 class="red-text">ERROR<br />You have not provided valid information to access the DITC application.</h5>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Dekalb International Training Center - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - Application</title>
 
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
	
	<?php if($error == 0) { ?>
	
		<?php if($app_access == "admin") { ?>
		
		<?php 
		$u_id = md5(date('Y-m-d H:i:s'));
		$app_update_query = "UPDATE application SET app_id = ".$_REQUEST['appID'].", date_approved = '".date('Y-m-d H:i:s')."', u_id = '".$u_id."' WHERE id = ".$_REQUEST['aID'];
		$app_update = db_update(DITCDB,$app_update_query);	
		
		$mailto = $app[0]['email'];
		$subject = "DITC Application Access";
		$message = "<p><strong>Welcome to the DeKalb International Training Center application process.</strong></p>";
		$message .= "<p>Please click on the link below to download the Application Package and the appropriate International Financial Statement form. Please fill out the pages using Acrobat Reader or print the blank pages first.</p>";
		$message .= "<p><strong>Important:</strong> You will not be able to save the information you enter, if using Acrobat Reader. Therefore, print the completed pages before exiting Acrobat Reader. A checklist is provided for you. Please review it before sending your signed application package.</p>";
		$message .= "<hr>";
		$message .= "<p>Click on the link below, or copy and paste it into your browser, to access to the DITC application.</p>";
		$message .= "<p><a href=\"http://ditc.us/apply2/app-access/index.php?uID=".$u_id."\">http://ditc.us/apply2/app-access/index.php?uID=".$u_id."</a></p>";
		$message .= "<hr>";
		$message .= "<p>Sincerely,<br />Dr. Marc Daniel Gutekunst<br />DITC Co-Founder &amp; CEO</p>";
		$headers = "From: The Dekalb International Training Center <info@ditc.us>\n";
		$headers .= "Reply-To: The Dekalb International Training Center <info@ditc.us>\n";
		$headers .= "Return-Path: <info@ditc.us>\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-Type: text/html; ";
		$headers .= "charset=ISO-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 7bit\n\n";
		
		mail($mailto,$subject,$message,$headers);
		?>
		
		<h4 class="blue-text">Application Link Sucessfully Sent</h4>
		
		<p>A link to access the Region <?=$_REQUEST['appID']?> Application has been sent to <?=$app[0]['fname']?> <?=$app[0]['lname']?>.</p>
		
		<p><span class="bold"><?=$app[0]['fname']?> <?=$app[0]['lname']?></span><br />
		<?=$app[0]['address1']?><br />
		<?php if($app[0]['address2'] != '') { ?><?=$app[0]['address2']?><br /><?php } ?>
		<?=$app[0]['city']?>, <?=$app[0]['state']?> <?=$app[0]['zip']?><br />
		Phone: <?=$app[0]['phone']?><br />
		E-mail: <a href="mailto:<?=$app[0]['email']?>"><?=$app[0]['email']?></a></p>
		
		<?php } ?>
	 
		<?php if($app_access == "user") { ?>
		
		<h4 class="blue-text">Welcome to the DeKalb International Training Center application process.</h4>
		
		<p>Below is a link to an Adobe Acrobat version of the Application Package and the appropriate International Financial Statement form. Please
		fill out the pages using Acrobat Reader or print the blank pages first.</p>
		
		<h6 class="pdf"><a href="DITC_Application.pdf">DITC Application</a></h6>
		<h6 class="pdf"><a href="DITC_IntFinancial_<?=$app[0]['app_id']?>.pdf">DITC Financial Worksheet</a></h6>
		
		<p><span class="bold">Important:</span> You will not be able to save the information you enter, if using <a href="http://www.adobe.com/products/acrobat/readstep2.html" onclick="window.open('http://www.adobe.com/products/acrobat/readstep2.html'); return false;">Acrobat Reader</a>. Therefore, print the
		completed pages before exiting Acrobat Reader. A checklist is provided for you. Please review it before sending your signed application package.</p>
		
		<p>To download a copy of Acrobat Reader, visit the <a href="http://www.adobe.com/products/acrobat/readstep2.html" onclick="window.open('http://www.adobe.com/products/acrobat/readstep2.html'); return false;">Adobe Acrobat Web site</a></p>

		<p>Sincerely,<br />
		<span class="bold">Dr. Marc Daniel Gutekunst</span><br />
		DITC Co-Founder & CEO</p>
		
		<h6>If you should have any questions, contact our office at 770-901-6020.</h6>
		
		<?php } ?>
		
	<?php } else { ?>
	
	<?=$error_message?>
	
	<?php } ?>
	
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