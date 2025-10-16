<?php
require_once("../../includes/global/constants.php");
require_once(homepath."includes/global/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Atlanta Dekalb International Training Center (ATLANTA DITC) - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - Team Handball</title>
 
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
		<a href="<?=homepath?>sports/team-handball.php"><img src="<?=homepath?>images/headerIMG-handball.jpg" width="500" height="153" border="0" alt="Team Handball" style="border-bottom: 2px solid #fff;"/></a>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title align-right" id="sports"><h3><a href="../admin/">Member Access</a></h3></div>

	<div class="pad15"><!-- START main body content -->
	
	<h3 class="red-text">Meet the Athletes</h3>
	
	<?php
		$teamQuery = "SELECT u.fname, u.mname, u.lname, u.id, u.city, u.state, u.country, u.title, u.photo, gr.name AS groupname FROM users AS u, group_affil AS g, groups AS gr WHERE
						g.group_id = 16
						AND
						gr.id = 16
						AND
						g.user_id = u.id
						ORDER BY u.lname ASC";
		$team = db_select(DITCDB, $teamQuery);
		
		$tryoutMenQuery = "SELECT u.fname, u.mname, u.lname, u.id, u.city, u.state, u.country, u.title, u.photo, gr.name AS groupname FROM users AS u, group_affil AS g, groups AS gr WHERE
						g.group_id = 15
						AND
						gr.id = 15
						AND
						g.user_id = u.id
						ORDER BY u.lname ASC";
		$tryoutMen = db_select(DITCDB, $tryoutMenQuery);
		
		$tryoutWomenQuery = "SELECT u.fname, u.mname, u.lname, u.id, u.city, u.state, u.country, u.title, u.photo, gr.name AS groupname FROM users AS u, group_affil AS g, groups AS gr WHERE
						g.group_id = 17
						AND
						gr.id = 17
						AND
						g.user_id = u.id
						ORDER BY u.lname ASC";
		$tryoutWomen = db_select(DITCDB, $tryoutWomenQuery);
	?>
	
	<h4 class="blue-text"><?=$team[0]['groupname']?></h4>
	
	<table border="0" cellspacing="0" cellpadding="0" class="teamListing">
		<?php
		$count = 0;
		for($i=0; $i<count($team); $i++) {
		if( $i == 0 ) echo "<tr>\n";
		if( $count == 4 ) { echo "</tr>\n<tr>\n"; $count = 0; }
		?>
			<td>
				<?php
				if( $team[$i]['photo'] != '' ) {
					echo '<img src="'.homepath.'admin/access/assets/photos/'.$team[$i]['photo'].'" height="100" alt="'.intl_clean($team[$i]['fname'],0,0).' '.intl_clean($team[$i]['lname'],0,0).'" class="p-border" />';
				} else { 
					echo '<img src="'.homepath.'images/photoComingSoon.jpg" width="100" height="100" alt="'.intl_clean($team[$i]['fname'],0,0).' '.intl_clean($team[$i]['lname'],0,0).'" class="p-border" />';
				}
				?>
				<h5 class="blue-text"><? echo intl_clean($team[$i]['fname'],0,0).' '; if( $team[$i]['mname']!= '' ) { echo intl_clean($team[$i]['mname'],0,0).' '; } echo strtoupper(intl_clean($team[$i]['lname'],0,0)); ?></h5>
				<p>
				<strong><? if( $team[$i]['city']!= '' ) { echo intl_clean($team[$i]['city'],0,0).', '; } if( $team[$i]['state']!= '' ) { echo intl_clean($team[$i]['state'],0,0); } if( $team[$i]['country']!= '' ) { echo intl_clean($team[$i]['country'],0,0); } ?></strong>
				<? if( $team[$i]['title']!= '' ) { echo '<br />'.intl_clean($team[$i]['title'],0,1); } ?>
				</p>
			</td>
		<?php
		$count++;
		}
		$xtras = (4-($count)); if( $xtras != 0 ) { for($i=0; $i<$xtras; $i++) { echo "<td>&nbsp;</td>\n"; } }
		?>
		</tr>
	</table>
	<p class="italic">*Athletes currently training on a regular basis with the ATLANTA DITC since November 2007	</p>
	
	<hr />
	
	<h4 class="blue-text"><?=$tryoutMen[0]['groupname']?></h4>
	
	<table border="0" cellspacing="0" cellpadding="0">
		<?php for($i=0; $i<count($tryoutMen); $i++) { ?>
		<tr <? if($i % 2) { echo 'class="gray-bkgd"'; } ?>>
			<td>
				<p><strong><? echo intl_clean($tryoutMen[$i]['fname'],0,0).' '; if( $tryoutMen[$i]['mname']!= '' ) { echo intl_clean($tryoutMen[$i]['mname'],0,0).' '; } echo strtoupper(intl_clean($tryoutMen[$i]['lname'],0,0)); ?></strong></p>
			</td>
			<td class="combined">
				<p><? if( $tryoutMen[$i]['city']!= '' ) { echo intl_clean($tryoutMen[$i]['city'],0,0).', '; } if( $tryoutMen[$i]['state']!= '' ) { echo intl_clean($tryoutMen[$i]['state'],0,0); } if( $tryoutMen[$i]['country']!= '' ) { echo intl_clean($tryoutMen[$i]['country'],0,0); } ?>&nbsp;</p>
			</td>
			<td class="combined">
				<p><? if( $tryoutMen[$i]['title']!= '' ) { echo '<em>'.intl_clean($tryoutMen[$i]['title'],0,1).'</em>'; } ?>&nbsp;</p>
			</td>
		</tr>
		<?php } ?>
	</table>
	
	<hr />
	
	<h4 class="blue-text"><?=$tryoutWomen[0]['groupname']?></h4>
	
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
<?php require(homepath."includes/modules/right-sidebar.php") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php require(homepath."includes/modules/footer.php") ?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1544491-1";
urchinTracker();
</script>
</body>
</html>