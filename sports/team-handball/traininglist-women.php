<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php $custom_title = 1 ?>
<title>ATLANTA 1996 :: The Legacy Institution of the Atlanta 1996 Centennial Olympic Games :: Team Handball</title>
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
		<a href="/sports/team-handball.php"><img src="/images/headerIMG-handball.jpg" width="500" height="153" border="0" alt="Team Handball" style="border-bottom: 2px solid #fff;"/></a>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title align-right" id="sports"><h3><a href="../admin/">Member Access</a></h3></div>

	<div class="pad15"><!-- START main body content -->
		
	<?php
		$tryoutWomenQuery = "SELECT u.fname, u.mname, u.lname, u.id, u.city, u.state, u.country, u.title, u.photo, gr.name AS groupname FROM users AS u, group_affil AS g, groups AS gr WHERE
						g.group_id = 17
						AND
						gr.id = 17
						AND
						g.user_id = u.id
						ORDER BY u.lname ASC";
		$tryoutWomen = db_select(DITCDB, $tryoutWomenQuery);
	?>
	
	<h5 class="red-text"><?=$tryoutWomen[0]['groupname']?></h5>
	
	<table border="0" cellspacing="0" cellpadding="0">
		<?php for($i=0; $i<count($tryoutWomen); $i++) { ?>
		<tr <? if($i % 2) { echo 'class="gray-bkgd"'; } ?>>
			<td>
				<p><strong><? echo intl_clean($tryoutWomen[$i]['fname'],0,0).' '; if( $tryoutWomen[$i]['mname']!= '' ) { echo intl_clean($tryoutWomen[$i]['mname'],0,0).' '; } echo strtoupper(intl_clean($tryoutWomen[$i]['lname'],0,0)); ?></strong></p>
			</td>
			<td class="combined">
				<p><? if( $tryoutWomen[$i]['city']!= '' ) { echo intl_clean($tryoutWomen[$i]['city'],0,0).', '; } if( $tryoutWomen[$i]['state']!= '' ) { echo intl_clean($tryoutWomen[$i]['state'],0,0); } if( $tryoutWomen[$i]['country']!= '' ) { echo intl_clean($tryoutWomen[$i]['country'],0,0); } ?>&nbsp;</p>
			</td>
			<td class="combined">
				<p><? if( $tryoutWomen[$i]['title']!= '' ) { echo '<em>'.intl_clean($tryoutWomen[$i]['title'],0,1).'</em>'; } ?>&nbsp;</p>
			</td>
		</tr>
		<?php } ?>
	</table>
	
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php include(homepath."/inc/right-sidebar.inc") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php include(homepath."/inc/footer.inc") ?>
<?php include(homepath."/inc/ga.inc"); ?>
</body>
</html>