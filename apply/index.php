<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php $custom_title = 1 ?>
<title>ATLANTA 1996 :: The Legacy Institution of the Atlanta 1996 Centennial Olympic Games :: Apply</title>  
<?php include(homepath."/inc/head.inc") ?>

</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content">
	<div class="body-header">
		<img src="/images/headerIMG-apply.jpg" width="500" height="153" border="0" alt="Apply Now" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title"><h3>&nbsp;</h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<script language="JavaScript" type="text/javascript">
	<!--
	var string1 = "msanford";
	var string2 = "@";
	var string3 = "ditc.us";
	document.write("<h6>To receive the ATLANTA 1996 Application Package on CD, please submit by fax or e-mail a written signed request to the <a href=" + "mail" + "to:" + string1 + string2 + string3 + ">ATLANTA 1996 Sports Director.</a></h6>");
	//-->
	</script>
	<noscript>
	<h6>Before completing the application package, please be sure to <a href="#policies">read all about our policies</a>. They will be beneficial in helping you understand all
	the requirements for qualifying to enter the ATLANTA 1996.</h6>
	</noscript>
	<p>When you received the ATLANTA 1996 Application Package please print and fill out all information and include the necessary copies of information as required.</p>

	<h6>If you should have any questions, contact:</h6>

	<p><a href="mailto:msanford@atlanta1996.us">Murray SANFORD</a><br />
	  SPORTS Director,<br />
	  ATLANTA 1996, Inc. <br />
	  PO Box 15206<br />
	Atlanta, GA 30333<br />
	USA
    <br />
	  Tel:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 404-992-9916<br />
	  Fax:&nbsp;&nbsp;&nbsp;&nbsp; 404-321-5774<br />
      <br />
</p>
	<h4 class="blue-text" id="policies">ATLANTA 1966 Policies</h4>
	
	<p><a href="policies.php?print=1" onclick="window.open('policies.php?print=1'); return false;">View a <span class="bold">printer friendly version</span> of the ATLANTA 1996 Policies</a></p> 
	
	<div id="policies-wrapper">
	<?php include("policies.php") ?>		
	</div>
	
	<p><a href="#policies">BACK TO TOP</a></p>
	
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