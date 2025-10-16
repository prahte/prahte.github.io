<?php if( isset($_REQUEST['gID']) && ( $groupAccess > 2 || $_SESSION['admin']['access_level'] > StandardAccess ) ) { ?>
<p>To change the Affiliation's information, click on the <strong>Edit</strong> button.
<? if( $_SESSION['admin']['access_level'] > StandardAccess ) echo ' To delete the Affiliation, click on the <strong>Delete</strong> button.<br />'; ?>
To change or delete a related document, click on the <strong>Edit</strong> or
<strong>Delete</strong> buttons. To add a new document, click on the <strong>Add a Document</strong> link.</p>
<?php } ?>

<?php if( !isset($_REQUEST['gID']) ) { ?>
<p>Click on an Affiliation's name for more information.</p>
<?php } ?>

<ul class="">
<?php for($i=0; $i<count($activeListings); $i++) {
##### if gID is specified, display only the corresponding group -- if not, display only if user is admin
if( ( isset($_REQUEST['gID']) && $_REQUEST['gID'] == $activeListings[$i]['id'] ) ||
	( !isset($_REQUEST['gID']) && $_SESSION['admin']['access_level'] > StandardAccess ) )
{
?>
<li class="pad5 t-border clearfix">

<?php
##### display logo if it exists 
if($activeListings[$i]['logo'] != '') { ?>
<img src="/admin/access/assets/logos/<?=$activeListings[$i]['logo']?>" alt="" width="50" class="float-right p-border" />
<?php } ?>

<h5>
<?php
##### if admin browsing (no gID is set), then add link to group name
if( !isset($_REQUEST['gID']) && $_SESSION['admin']['access_level'] > StandardAccess ) { echo '<a href="/admin/access/groups/index.php?gID='.$activeListings[$i]['id'].'">'; } ?>
<?=intl_clean($activeListings[$i]['name'],0,1)?>
<?php if( !isset($_REQUEST['gID']) && $_SESSION['admin']['access_level'] > StandardAccess ) { echo '</a>'; } ?>
</h5>
<p>
<?php if($activeListings[$i]['description'] != '') { echo intl_clean($activeListings[$i]['description'],0,1).'<br />'; } ?>
<?php if($activeListings[$i]['address1'] != '') { echo intl_clean($activeListings[$i]['address1'],0,1).'<br />'; } ?>
<?php if($activeListings[$i]['address2'] != '') { echo intl_clean($activeListings[$i]['address2'],0,1).'<br />'; } ?>
<?php if($activeListings[$i]['city'] != '') { echo intl_clean($activeListings[$i]['city'],0,1).' '; } ?>
<?php if($activeListings[$i]['state'] != '') { echo intl_clean($activeListings[$i]['state'],0,1).' '; } ?>
<?php if($activeListings[$i]['zip'] != '') { echo intl_clean($activeListings[$i]['zip'],0,1).' '; } ?>
<?php if($activeListings[$i]['country'] != '') { echo '<br />'.intl_clean($activeListings[$i]['country'],0,1).' '; } ?>
</p>

<?php
##### if manager of group, or admin, display form w/ edit option
if( ( $groupAccess > 2 ) || ( $_SESSION['admin']['access_level'] > StandardAccess ) ) { ?>

<form action="<?=$_SERVER['PHP_SELF']?>?gID=<?=$activeListings[$i]['id']?>" method="post" class="p-border bottom-buffer gray-bkgd-fade clear-float" />
<input name="submit" id="edit" type="submit" value="Edit" class="button">
<?php
##### only display delete if site admin
if( $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this affiliation?');" />
<?php } ?>
</form>
<?php } ?>

</li>

<?php
##### If gID set (and user has greater than basic access), display group members
if( isset($_REQUEST['gID']) && ( $groupAccess > 1 || $_SESSION['admin']['access_level'] > StandardAccess ) ) { ?>
<li class="pad5 t-border">
<h4>Affiliated Members</h4>
<ul class="divided-list">
<?php
$membersQuery = "SELECT u.fname, u.lname, u.mname, u.title, u.photo, u.id FROM users AS u, group_affil AS g
				WHERE
				u.id = g.user_id
				AND
				g.group_id = ".$_REQUEST['gID']."				
				ORDER BY u.lname ASC";

$members = db_select(DITCDB, $membersQuery);
#echo '<pre>';
#print_r($members);
#echo '</pre>';

for($g=0; $g<count($members); $g++) { 
?>
<li class="clearfix">
<?php if($members[$g]['photo'] != '') { echo '<img src=/admin/access/assets/photos/'.$members[$g]['photo'].' width="50" class="float-left p-border" />'; } ?>
<p><a href="/admin/access/members/index.php?uID=<?=$members[$g]['id']?>&amp;gID=<?=$_REQUEST['gID']?>">
<span class="bold"><?=intl_clean($members[$g]['fname'],0,1)?> <?php echo ' '.intl_clean($members[$g]['mname'],0,1); ?> <?=intl_clean($members[$g]['lname'],0,1)?></span>
</a>
<? if( $members[$g]['title'] != '' ) echo '<br /><span class="italic">'.intl_clean($members[$g]['title'],0,1).'</span>'; ?>
</p>
</li>
<?php } ?>
<? if( empty($members) ) echo '<li><p class="italic">There are currently no members associated with this affiliation.</p></li>'; ?>
</ul>
</li>
<?php } ##### END display of group members ?>

<?php } ?>
<?php } ?>
</ul>

</div><!-- END #content -->

<div id="admin-sidebar">

<? if( isset($_REQUEST['gID']) ) {
##### If gID is set, get all associated files
$filesQuery = "SELECT d.id, d.doc_title, d.file, d.type FROM group_docs AS d, group_docs_affil AS a
				WHERE
				a.group_id = ".$_REQUEST['gID']."
				AND
				d.id = a.doc_id
				ORDER BY d.doc_title ASC";
$files = db_select(DITCDB, $filesQuery);
?>
<h4 class="blue-text">Documents</h4>
<ul class="divided-list">
<?php
if( !empty($files) ) {
for($i=0; $i<count($files); $i++) { ?>
<li>
	<h6 class="bold <?=$files[$i]['type']?>">
	<a href="/admin/access/assets/files/<?=$files[$i]['file']?>"><?=intl_clean($files[$i]['doc_title'],0,0)?></a>
	</h6>
	<?php if( ($_SESSION['admin']['access_level'] > StandardAccess) || $groupAccess > 2 ) { ?>
	<form action="/admin/access/docs/index.php?dID=<?=$files[$i]['id']?>&amp;gID=<?=$_REQUEST['gID']?>" method="post" class="p-border gray-bkgd-fade">
	<input name="submit" id="edit" type="submit" value="Edit" class="button" />
	<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this document?');" />
	</form>
	<?php } ##### END edit/delete options ?>
</li>
<?php } } else { ?>
<li><p class="italic">There are currently no documents associated with this affiliation.</p></li>
<?php } ?>
</ul>

<?php if( ($_SESSION['admin']['access_level'] > StandardAccess) || $groupAccess > 2 ) { ?>
<h5 class="plus"><a href="/admin/access/docs/index.php?n=1&amp;gID=<?=$_REQUEST['gID']?>">Add a Document</a></h5>
<?php } ?>

<?php } else {
##### Else display 'add new group' button ?>
<h5 class="plus"><a href="/admin/access/groups/index.php?n=1">Create a New Affiliation</a></h5>
<?php } ?>

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>