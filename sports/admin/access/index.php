<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

# Get info for user
$userInfoQuery = "SELECT * FROM users WHERE id = ".$_SESSION['admin']['user_id'];
$userInfo = db_select(DITCDB, $userInfoQuery);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games ::</title>
 
<?php include(homepath."/inc/head.inc") ?>

</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container" class="clearfix">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content" class="">
		
	<div class="body-header">
		<img src="/images/headerIMG-memberaccess.jpg" width="500" height="153" border="0" alt="Pentathlon" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title align-right" id="sports"><h3><a href="/sports/admin/logout.php">Log Out</a></h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<?php if(isset($_SESSION['alert']['message'])) { echo '<h5 class="'.$_SESSION['alert']['type'].'-alert">'.$_SESSION['alert']['message'].'</h5>'; } ?>
	
	<h2 class="blue-text">Welcome, <?=intl_clean($userInfo[0]['fname'],0,1)?>.</h2>
	
	<p>Your <strong>ATLANTA 1996 Groups</strong> and <strong>Contact Information</strong> are listed below. Click on the Group name to access associated
	documents. Click on the <strong>Edit</strong> button to change your contact information.</p>
	
	<hr />
	
	<div class="float-left width200">
	
	<? if($userInfo[0]['photo'] != '') { ?>
	<img src="/admin/access/assets/photos/<?=$userInfo[0]['photo']?>" width="50" class="p-border" />
	<? } ?>
	
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
	<? } else { $blank = 1; } ?>
	
	<? if($userInfo[0]['phone1'] != '' || $userInfo[0]['phone2'] != '' || $userInfo[0]['email'] != '') { ?>
	<p>
	<? if($userInfo[0]['phone1'] != '') echo '<strong>Office Phone:</strong> '.$userInfo[0]['phone1'].'<br />'; ?>
	<? if($userInfo[0]['phone2'] != '') echo '<strong>Cell Phone:</strong> '.$userInfo[0]['phone2'].'<br />'; ?>
	<? if($userInfo[0]['email'] != '') echo '<strong>E-mail:</strong> '.$userInfo[0]['email']; ?>
	</p>
	<? } else { $blank++; }?>
	<?php if( $blank >= 1 ) { echo '<p class="italic clear-float">Contact information is not available.</p>'; } ?>
	
	<form action="/sports/admin/access/members/index.php?uID=<?=$userInfo[0]['id']?>" method="post" class="p-border bottom-buffer gray-bkgd-fade clear-float" />
	<input name="submit" id="edit" type="submit" value="Edit" class="button">
	</form>

	</div>
	
	<div class="float-right width200">
	
	<h4>Your ATLANTA 1996 Groups</h4>
	<ul class="divided-list">
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
	<?php if( !$groups ) { echo '<li><p class="italic">You are not currently affiliated with any groups.</p></li>'; } ?>
	</ul>

	</div>
	
	<hr class="clear-float"/>
	
	<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>
	
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