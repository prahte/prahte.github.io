<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php $custom_title = 1 ?>
<title>ATLANTA 1996 :: The Legacy Institution of the Atlanta 1996 Centennial Olympic Games :: Athletes</title> 
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
		<img src="/images/headerIMG-athletes.jpg" width="500" height="153" border="0" alt="Current Athletes" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title"><h3><a href="index.php">ATHLETES IN TRAINING</a> | <span class="highlight">ATHLETES COMPETING</span></h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<h6>Since the ATLANTA 1996 was inaugurated on May 6, 2002, athletes in training at the ATLANTA 1996 have competed at the following venues</h6>
	
	<?php
	$compQuery = "SELECT * FROM athletes_competing ORDER BY comp_date DESC";
	$comp = db_select(DITCDB, $compQuery);
	for($i=0;$i<count($comp);$i++) {
		if( date('Y',strtotime($comp[$i]['comp_date'])) != $year ) {
			if($i != 0) { echo "</ul>\n</div>\n"; }
			echo "<div class=\"athletes-competing\">\n";
			echo "<h4 class=\"white-text float-left\">".date('Y',strtotime($comp[$i]['comp_date']))."</h4>\n";
			echo "<ul>\n";
			echo "<li>".intl_clean($comp[$i]['comp_title'])." ".intl_clean($comp[$i]['comp_location'])."</li>";
		} else {
			echo "<li>".intl_clean($comp[$i]['comp_title'])." ".intl_clean($comp[$i]['comp_location'])."</li>";
		}
		$year = date('Y',strtotime($comp[$i]['comp_date']));
	}
	echo "</ul>\n</div>";
	?>
	
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php include(homepath."/inc/right-sidebar.inc") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php include(homepath."/inc/footer.inc") ?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1544491-1";
urchinTracker();
</script>
</body>
</html>