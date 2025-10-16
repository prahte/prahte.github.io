<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php $custom_title = 1 ?>
<title>ATLANTA 1996 :: The Legacy Institution of the Atlanta 1996 Centennial Olympic Games :: Team Handball</title> 
<?php include(homepath."/inc/head.inc") ?>
<style type="text/css">
#DonationForm { font-weight: bold; padding: 10px 0 20px 0; text-align: center; width: 275px; }
#DonationForm p { margin-bottom: .5em; }
.teamhandballTeamPage { background: url(/images/bkgdTeamHandballTeamPage.gif) no-repeat right top; }
</style>
<script type="text/javascript">
// <![CDATA[
function check_form() { 
		if(document._xclick.os0.value == "") {
				alert('Please select a team member.');
				document._xclick.os0.focus(); 
				return false;
		}
		if(document._xclick.amount.value == ""){
				alert('Please enter the amount you wish to donate.');
				document._xclick.amount.focus(); 
				return false;
		}
		return true;
}
// ]]>
</script>
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

	<div class="pad15 teamhandballTeamPage"><!-- START main body content -->
	
	
	
	<?php
		$teamQuery = "SELECT u.fname, u.mname, u.lname, u.id, u.city, u.state, u.country, u.title, u.photo, gr.name AS groupname FROM users AS u, group_affil AS g, groups AS gr WHERE
						g.group_id = 16
						AND
						gr.id = 16
						AND
						g.user_id = u.id
						ORDER BY u.lname ASC";
		$team = db_select(DITCDB, $teamQuery);
	?>
	
	<div class="float-right">
		<form name="_xclick" action="https://www.paypal.com/us/cgi-bin/webscr" method="post" id="DonationForm" onsubmit="return(check_form())">
		<input type="hidden" name="cmd" value="_donations" />
		<input type="hidden" name="business" value="merch@ditc.us" />
		<input type="hidden" name="item_name" value="Team Handball Team Member Support" />
		<input type="hidden" name="no_shipping" value="1" />
		<input type="hidden" name="return" value="http://ditc.us/merchandise/complete.php">
		<input type="hidden" name="cn" value="Add A Message">
		<input type="hidden" name="currency_code" value="USD">
		<input type="hidden" name="tax" value="0">
		<input type="hidden" name="lc" value="US">
		<input type="hidden" name="bn" value="PP-DonationsBF">
		<input type="hidden" name="on0" value="Team Member" />
		<p class="align-center">
			<select id="os0" name="os0">
				<option value="">Select a Team Member</option>
				<?php
					for($i=0; $i<count($team); $i++) {
						echo '<option value="'.intl_clean($team[$i]['fname'],0,0).' '.intl_clean($team[$i]['lname'],0,0).'">'.intl_clean($team[$i]['fname'],0,0).' '.intl_clean($team[$i]['lname'],0,0).'</option>';
						echo "\n";
					}
				?>
			</select>
		$ <input type="text" name="amount" value="25.00" size="5" class="textfieldSmall" id="DonationAmount" />
		</p>
		<input type="image" src="http://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="Make a donation with PayPal - it's fast, free and secure!" />
		</form>
	</div>
	
	<!--<h3 class="blue-text">Meet the Team</h3>-->
	
	<h4 class="red-text align-center"><?=$team[0]['groupname']?></h4>
	
	<table border="0" cellspacing="0" cellpadding="0" class="teamListing clear-float">
		<?php
		$count = 0;
		for($i=0; $i<count($team); $i++) {
		if( $i == 0 ) echo "<tr>\n";
		if( $count == 4 ) { echo "</tr>\n<tr>\n"; $count = 0; }
		?>
			<td>
				<?php
				if( $team[$i]['photo'] != '' ) {
					echo '<img src="/admin/access/assets/photos/'.$team[$i]['photo'].'" height="90" alt="'.intl_clean($team[$i]['fname'],0,0).' '.intl_clean($team[$i]['lname'],0,0).'" class="p-border" />';
				} else { 
					echo '<img src="/images/photoComingSoon.jpg" width="90" height="90" alt="'.intl_clean($team[$i]['fname'],0,0).' '.intl_clean($team[$i]['lname'],0,0).'" class="p-border" />';
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