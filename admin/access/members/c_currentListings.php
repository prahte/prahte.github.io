<?php if( isset($_REQUEST['uID']) && $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<p>To change member information, click on the <strong>Edit</strong> button. To deactivate the member's account, click on the <strong>Deactivate</strong> button (you must first Deactivate the member account before you can delete it entirely).</p>
<?php } ?>

<?php if( !isset($_REQUEST['uID']) ) { ?>
<p>Click on a member's name for more information.</p>

<h4 class="blue-text">Active Member Accounts</h4>
<?php } ?>

<ul class="">
<?php for($i=0; $i<count($activeListings); $i++) {
##### if uID is specified, display only the corresponding group -- if not, display only if user is admin
if( ( isset($_REQUEST['uID']) && $_REQUEST['uID'] == $activeListings[$i]['id'] ) ||
	( !isset($_REQUEST['uID']) && $_SESSION['admin']['access_level'] > StandardAccess ) )
{
?>

<li class="pad5 t-border clearfix">

<?php
##### display logo if it exists 
if($activeListings[$i]['photo'] != '') { ?>
<img src="/admin/access/assets/photos/<?=$activeListings[$i]['photo']?>" alt="" width="50" class="float-left p-border" />
<?php } ?>
<div class="float-left">
<h5>
<?php
##### if admin browsing (no gID is set), then add link to group name
if( !isset($_REQUEST['uID']) && $_SESSION['admin']['access_level'] > StandardAccess ) { echo '<a href="/admin/access/members/index.php?uID='.$activeListings[$i]['id'].'">'; } ?>
<?=intl_clean($activeListings[$i]['fname'],0,1)?><? echo ' '.intl_clean($activeListings[$i]['mname'],0,1); ?> <?=intl_clean($activeListings[$i]['lname'],0,1)?>
<?php if( !isset($_REQUEST['uID']) && $_SESSION['admin']['access_level'] > StandardAccess ) { echo '</a>'; } ?>
</h5>
<?php if($activeListings[$i]['title'] != '') { echo '<h6>'.intl_clean($activeListings[$i]['title'],0,1).'</h6>'; } ?>
<?php if( !isset($_REQUEST['uID']) ) { ?>
<p>
<span class="bold">Affiliations:</span>
<?php
$affilQuery = "SELECT g.name, g.id FROM groups AS g, group_affil AS a WHERE
				a.user_id = ".$activeListings[$i]['id']."
				AND
				a.group_id = g.id
				ORDER BY g.name ASC";
$affil = db_select(DITCDB, $affilQuery);
for($g=0; $g<count($affil); $g++) {
?>
<a href="/admin/access/groups/index.php?gID=<?=$affil[$g]['id']?>"><?=intl_clean($affil[$g]['name'],0,1)?></a>
<?php if($g < ( (count($affil))-1 ) ) { echo ', '; } ?>
<?php } ?>
</p>
<?php } ?>
<?php if( isset($_REQUEST['uID']) ) { ?>
<p>
<?php if($activeListings[$i]['address1'] != '') { echo intl_clean($activeListings[$i]['address1'],0,1).'<br />'; } ?>
<?php if($activeListings[$i]['address2'] != '') { echo intl_clean($activeListings[$i]['address2'],0,1).'<br />'; } ?>
<?php if($activeListings[$i]['city'] != '') { echo intl_clean($activeListings[$i]['city'],0,1).' '; } ?>
<?php if($activeListings[$i]['state'] != '') { echo intl_clean($activeListings[$i]['state'],0,1).' '; } ?>
<?php if($activeListings[$i]['zip'] != '') { echo intl_clean($activeListings[$i]['zip'],0,1).' '; } ?>
<?php if($activeListings[$i]['country'] != '') { echo '<br />'.intl_clean($activeListings[$i]['country'],0,1); } ?>
</p>
<?php if($activeListings[$i]['phone1'] != '' || $activeListings[$i]['phone2'] != '' || $activeListings[$i]['email'] != '') { ?>
<p>
<?php if($activeListings[$i]['phone1'] != '') { echo '<strong>Office Phone:</strong> '.intl_clean($activeListings[$i]['phone1'],0,1).'<br />'; } ?>
<?php if($activeListings[$i]['phone2'] != '') { echo '<strong>Cell Phone:</strong> '.intl_clean($activeListings[$i]['phone2'],0,1).'<br />'; } ?>
<?php if($activeListings[$i]['email'] != '') { echo '<strong>E-mail:</strong> '.intl_clean($activeListings[$i]['email'],0,1); } ?>
</p>
<?php } ?>
<?php } ##### END if uID exists ?>
</div>

<?php
##### if admin, display form w/ edit option
if( $_SESSION['admin']['access_level'] > StandardAccess ) { ?>

<form action="<?=$_SERVER['PHP_SELF']?>?uID=<?=$activeListings[$i]['id']?>" method="post" class="p-border bottom-buffer gray-bkgd-fade clear-float" />
<input name="submit" id="edit" type="submit" value="Edit" class="button">
<input name="submit" id="deactivate" type="submit" value="Deactivate" class="button">
</form>

<?php } ##### END if admin ?>

</li>

<?php
##### If uID set (and user has greater than basic access), display group members
if( isset($_REQUEST['uID']) && $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<li class="pad5 t-border">
<h4>Affiliations</h4>
<ul class="divided-list">
<?php
$groupsQuery = "SELECT g.id, g.logo, g.name FROM groups AS g, group_affil AS ga
				WHERE
				g.id = ga.group_id
				AND
				ga.user_id = ".$_REQUEST['uID']."				
				ORDER BY g.name ASC";
$groups = db_select(DITCDB, $groupsQuery);

for($g=0; $g<count($groups); $g++) { 
?>
<li class="clearfix">
<?php if($groups[$g]['logo'] != '') { echo '<img src="/admin/access/assets/logos/'.$groups[$g]['logo'].'" width="50" class="float-right p-border" />'; } ?>
<p class="bold"><a href="/admin/access/groups/index.php?gID=<?=$groups[$g]['id']?>">
<?=intl_clean($groups[$g]['name'],0,1)?></a>
</p>
</li>
<?php } ?>
<? if( empty($groups) ) echo '<li><p class="italic">This member is not currently associated with any groups.</p></li>'; ?>
</ul>
</li>

<?php } ##### END display of affiliations ?>

<?php } ?>

<?php } ?>

</ul>

<?php if( !isset($_REQUEST['uID']) ) { ?>
<h4 class="blue-text">Inactive Member Accounts</h4>
<ul class="">
<?php for($i=0; $i<count($INactiveListings); $i++) { ?>
<li class="pad5 t-border clearfix">
<h5>
<?=intl_clean($INactiveListings[$i]['fname'],0,1)?><? echo ' '.intl_clean($INactiveListings[$i]['mname'],0,1); ?> <?=intl_clean($INactiveListings[$i]['lname'],0,1)?>
</h5>

<form action="<?=$_SERVER['PHP_SELF']?>?uID=<?=$INactiveListings[$i]['id']?>" method="post" class="p-border bottom-buffer gray-bkgd-fade clear-float" />
<input name="submit" id="activate" type="submit" value="Activate" class="button">
<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this member?');" />
</form>
</li>
<?php } ?>
	<?php if( empty($INactiveListings) ) { ?>
	<li><p class="italic">There are currently no inactive member accounts.</p></li>
	<?php } ?>
</ul>
<?php } ?>

</div><!-- END #content -->

<div id="admin-sidebar">

<? if( $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<h5 class="plus"><a href="/admin/access/members/index.php?n=1">Create a New Member</a></h5>
<?php } ?>

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>