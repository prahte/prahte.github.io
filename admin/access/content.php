<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

# Get info for user
$userInfoQuery = "SELECT * FROM users WHERE id = ".$_SESSION['admin']['user_id'];
$userInfo = db_select(DITCDB, $userInfoQuery);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Dekalb International Training Center - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - Site Administration</title>
 
<?php include(homepath."/inc/head.admin.inc") ?>

</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.admin.php") ?>

<div id="body-container" class="clearfix admin-body">

<div id="content" class="admin-content">
		
	<?php if(isset($_SESSION['alert']['message'])) { echo '<h5 class="red-text">'.$_SESSION['alert']['message'].'</h5>'; } ?>
	
	<h2>Content</h2>
		
	<h5><a href="blogs/">Blogs</a></h5>
	
	<h5><a href="athletes-competing/">Athletes Competing History Listings</a></h5>
		
</div><!-- END content -->

<!-- Right Sidebar -->
<div id="admin-sidebar">

	

</div>

</div><!-- END body-container -->
</div><!-- END main-container -->

<?php include(homepath."/inc/footer.inc") ?>

</body>
</html>