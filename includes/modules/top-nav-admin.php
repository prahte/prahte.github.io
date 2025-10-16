<?php
if(isset($_SESSION['admin']['user_id'])) {
?>
<div id="top-nav">
	<div>
		<p id="home-tnav"><a href="<?=homepath?>index1.php">DITC Home</a></p>
		<p id="topnav-admin">
			<a href="<?=homepath?>admin/access/">Admin Home</a>
			<?php if ($_SESSION['admin']['access_level'] > 1) { ?>
			&nbsp;&nbsp;|&nbsp;&nbsp; <a href="<?=homepath?>admin/access/groups">Affiliations</a> &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?=homepath?>admin/access/members">Members</a> &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?=homepath?>admin/access/docs">Documents</a> &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?=homepath?>admin/access/news">News</a> &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?=homepath?>admin/access/content.php">Content</a>
			<?php } ?>
		</p>
		<p id="contact-tnav"><a href="<?=homepath?>admin/logout.php">Log out</a></p>
	</div>
</div>
<? } else { ?>
<div id="top-nav">
	<div>
		<p id="home-tnav"><a href="<?=homepath?>index1.php">Home</a></p>
		<p id="topnav-sports"><a href="<?=homepath?>sports/cycling.php" id="cycling">Cycling</a> <a href="<?=homepath?>sports/pentathlon.php" id="pentathlon">Pentathlon</a> <a href="<?=homepath?>sports/swimming.php" id="swimming">Swimming</a> <a href="<?=homepath?>sports/team-handball.php" id="handball">Team Handball</a> <a href="<?=homepath?>sports/tennis.php" id="tennis">Tennis</a> <a href="<?=homepath?>sports/track-field.php" id="trackfield">Track &amp; Field</a></p>
		<p id="contact-tnav"><a href="<?=homepath?>contact">Contact Us</a></p>
	</div>
</div><!-- END top-nav -->
<div style="clear:both"></div>
<? } ?>