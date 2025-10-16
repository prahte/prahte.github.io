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
	
	<h2 class="blue-text">Welcome</h2>
	
	<p>Below is your profile.
	<? if( $_SESSION['admin']['access_level'] > 1 ) echo 'To make changes to your profile, click on the <strong>Edit</strong> button.'; ?>
	<br />
	<strong>ATLANTA 1996 affiliations</strong> are listed on the right. Click on the affiliation name to make changes to the affiliation.</p>
	
	<div class="clearfix pad10 t-border">
	
	<? if($userInfo[0]['photo'] != '') { ?>
	<div class="float-left">
	<img src="/admin/access/assets/photos/<?=$userInfo[0]['photo']?>" width="50" class="p-border" />
	</div>
	<? } ?>
	
	<div class="float-left">
	<h4><?=intl_clean($userInfo[0]['fname'],0,1)?> <?=intl_clean($userInfo[0]['mname'],0,1)?> <?=intl_clean($userInfo[0]['lname'],0,1)?></h4>
	<? if( $userInfo[0]['title'] != '' ) echo '<h6>'.intl_clean($userInfo[0]['title'],0,1).'</h6>'; ?>
	
	<? if($userInfo[0]['address1'] != '' || $userInfo[0]['city'] != '') { ?>
	<p>
	<? if($userInfo[0]['address1'] != '') echo intl_clean($userInfo[0]['address1'],0,1).'<br />' ?>
	<? if($userInfo[0]['address2'] != '') echo intl_clean($userInfo[0]['address2'],0,1).'<br />'; ?>
	<? if($userInfo[0]['city'] != '') echo intl_clean($userInfo[0]['city'],0,1).', '; ?>
	<? if($userInfo[0]['state'] != '') echo intl_clean($userInfo[0]['state'],0,1).' '; ?>
	<? if($userInfo[0]['zip'] != '') echo intl_clean($userInfo[0]['zip'],0,1).' '; ?>
	<? if($userInfo[0]['country'] != '') echo intl_clean($userInfo[0]['country'],0,1).' '; ?>
	</p>
	<? } ?>
	
	<? if($userInfo[0]['phone1'] != '' || $userInfo[0]['phone2'] != '' || $userInfo[0]['email'] != '') { ?>
	<p>
	<? if($userInfo[0]['phone1'] != '') echo '<strong>Phone:</strong> '.$userInfo[0]['phone1'].'<br />'; ?>
	<? if($userInfo[0]['phone2'] != '') echo '<strong>Cell Phone:</strong> '.$userInfo[0]['phone2'].'<br />'; ?>
	<? if($userInfo[0]['email'] != '') echo '<strong>E-mail:</strong> '.$userInfo[0]['email']; ?>
	</p>
	<? } ?>
	</div>
	
	<?php if( $_SESSION['admin']['access_level'] > 1 ) { ?>
	<form action="/admin/access/members/index.php?uID=<?=$userInfo[0]['id']?>" method="post" class="p-border bottom-buffer gray-bkgd-fade clear-float" />
	<input name="submit" id="edit" type="submit" value="Edit" class="button">
	</form>
	<?php } ?>
	
	</div>
	
	<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>
		
</div><!-- END content -->

<!-- Right Sidebar -->
<div id="admin-sidebar">

	<?php if($_SESSION['admin']['access_level'] > 1) { ?>
	<!-- ADMIN ACCESS OPTIONS -->
		<h4>All ATLANTA 1996 Affiliations</h4>
		<ul class="divided-list">
		<?php
		$groupsQuery = "SELECT * FROM groups ORDER BY name ASC";
		$groups = db_select(DITCDB, $groupsQuery);
		for($i=0; $i<count($groups); $i++) {
		?>
		<li><h6><a href="groups/index.php?gID=<?=$groups[$i]['id']?>"><?=intl_clean($groups[$i]['name'],0,1)?></a></h6></li>
		<?php } ?>
		</ul>
	<!-- END ADMIN ACCESS OPTIONS -->
	<?php } ?>
	
	<?php if( $_SESSION['admin']['access_level'] == 1 ) { ?>
	<!-- STANDARD ACCESS OPTIONS -->
		<h4>Your ATLANTA 1996 Affiliations</h4>
		<ul>
		<?php
		$groupsQuery = "SELECT g.name, g.id FROM groups AS g, group_affil AS ga
						WHERE
						ga.user_id = ".$_SESSION['admin']['user_id']."
						AND
						g.id = ga.group_id
						ORDER BY name ASC";
		$groups = db_select(DITCDB, $groupsQuery);
		for($i=0; $i<count($groups); $i++) {
		?>
		<li><h6><a href="groups/index.php?gID=<?=$groups[$i]['id']?>"><?=$groups[$i]['name']?></a></h6></li>
		<?php } ?>
		</ul>
	<!-- END STANDARD ACCESS OPTIONS -->
	<?php } ?>

</div>

</div><!-- END body-container -->
</div><!-- END main-container -->

<?php include(homepath."/inc/footer.inc") ?>

</body>
</html>