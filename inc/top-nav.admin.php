<?php
if(isset($_SESSION['admin']['user_id'])) {
?>
<div id="top-nav">
	<div>
		<p id="home-tnav"><a href="/index1.php">DITC Home</a></p>
		<p id="topnav-admin">
			<a href="/admin/access/">Admin Home</a>
			<?php if ($_SESSION['admin']['access_level'] > 1) { ?>
			&nbsp;&nbsp;|&nbsp;&nbsp; <a href="/admin/access/groups">Affiliations</a> &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="/admin/access/members">Members</a> &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="/admin/access/docs">Documents</a> &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="/admin/access/news">News</a> &nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="/admin/access/content.php">Content</a>
			<?php } ?>
		</p>
		<p id="contact-tnav"><a href="/admin/logout.php">Log out</a></p>
	</div>
</div>
<? } else { ?>
<div id="top-nav">
	<div>
		<p id="home-tnav"><a href="/index1.php">Home</a></p>
		<p id="topnav-sports"><a href="/sports/cycling.php" id="cycling">Cycling</a> <a href="/sports/pentathlon.php" id="pentathlon">Pentathlon</a> <a href="/sports/swimming.php" id="swimming">Swimming</a> <a href="/sports/team-handball.php" id="handball">Team Handball</a> <a href="/sports/tennis.php" id="tennis">Tennis</a> <a href="/sports/track-field.php" id="trackfield">Track &amp; Field</a></p>
		<p id="contact-tnav"><a href="/contact">Contact Us</a></p>
	</div>
</div><!-- END top-nav -->
<div style="clear:both"></div>
<? } ?>