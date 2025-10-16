<?php for($i=0; $i<count($activeListings); $i++) {
	
	if( $_REQUEST['gID'] == $activeListings[$i]['id'] ) { ?>
	
	<?php
	# display logo if it exists 
	if($activeListings[$i]['logo'] != '') { ?>
	<img src="<?=homepath?>admin/access/assets/logos/<?=$activeListings[$i]['logo']?>" alt="" width="50" class="float-right p-border" />
	<?php } ?>
	
	<h4><?=intl_clean($activeListings[$i]['name'],0,1)?></h4>
	
	<hr class="clear-float" />
	
	<div class="float-left width200">
	
	<p>
	<?php if($activeListings[$i]['description'] != '') { echo intl_clean($activeListings[$i]['description'],0,1).'<br />'; } ?>
	<?php if($activeListings[$i]['address1'] != '') { echo intl_clean($activeListings[$i]['address1'],0,1).'<br />'; } ?>
	<?php if($activeListings[$i]['address2'] != '') { echo intl_clean($activeListings[$i]['address2'],0,1).'<br />'; } ?>
	<?php if($activeListings[$i]['city'] != '') { echo intl_clean($activeListings[$i]['city'],0,1).' '; } ?>
	<?php if($activeListings[$i]['state'] != '') { echo intl_clean($activeListings[$i]['state'],0,1).' '; } ?>
	<?php if($activeListings[$i]['zip'] != '') { echo intl_clean($activeListings[$i]['zip'],0,1).' '; } ?>
	<?php if($activeListings[$i]['country'] != '') { echo '<br />'.intl_clean($activeListings[$i]['country'],0,1).' '; } ?>
	</p>
	</div>
	
	<div class="float-right width200">
	<?php
	# get all associated files
	$filesQuery = "SELECT d.id, d.doc_title, d.file, d.type FROM group_docs AS d, group_docs_affil AS a
					WHERE
					a.group_id = '".$_REQUEST['gID']."'
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
		<a href="<?=homepath?>admin/access/assets/files/<?=$files[$i]['file']?>"><?=intl_clean($files[$i]['doc_title'],0,0)?></a>
		</h6>
		<?php if( ($_SESSION['admin']['access_level'] > 2) || $groupAccess > 2 ) { ?>
		<form action="<?=homepath?>sponsors/admin/access/docs/index.php?dID=<?=$files[$i]['id']?>&amp;gID=<?=$_REQUEST['gID']?>" method="post" class="p-border gray-bkgd-fade">
		<input name="submit" id="edit" type="submit" value="Edit" class="button" />
		<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this document?');" />
		</form>
		<?php } # END edit/delete options ?>
	</li>
	<?php } } else { ?>
	<li><p class="italic">There are currently no documents associated with this group.</p></li>
	<?php } ?>
	</ul>
	
	<?php if( ($_SESSION['admin']['access_level'] > 2) || $groupAccess > 2 ) { ?>
	<h5 class="plus"><a href="<?=homepath?>sponsors/admin/access/docs/index.php?n=1&amp;gID=<?=$_REQUEST['gID']?>">Add a Document</a></h5>
	<?php } ?>
	
	</div>
	
	<?php } # END if request id == loop id ?>

<?php } # END loop of active listings ?>
	
	<hr class="clear-float" />
	
<?php
# If user has greater than basic access, display group members
if( $_SESSION['admin']['access_level'] > 2 || $groupAccess > 1 ) { ?>
	

	
	<h4>Group Members</h4>
	<ul class="divided-list">
	<?php
	$membersQuery = "SELECT u.fname, u.lname, u.mname, u.title, u.photo, u.id FROM users AS u, group_affil AS g
					WHERE
					u.id = g.user_id
					AND
					g.group_id = '".$_REQUEST['gID']."'				
					ORDER BY u.lname ASC";
	$members = db_select(DITCDB, $membersQuery);
	for($g=0; $g<count($members); $g++) { 
	?>
	<li class="clearfix">
	<?php if($members[$g]['photo'] != '') { echo '<img src='.homepath.'admin/access/assets/photos/'.$members[$g]['photo'].' width="50" class="float-left p-border" />'; } ?>
	<p>
	<?php if( $members[$g]['id'] == $_SESSION['admin']['user_id'] ) { echo '<span class="blue-text italic bold uppercase">You &gt; </span>'; } else { ?>
	<a href="<?=homepath?>sponsors/admin/access/members/index.php?uID=<?=$members[$g]['id']?>&amp;gID=<?=$_REQUEST['gID']?>">
	<?php } ?>
	<span class="bold">
	<?=intl_clean($members[$g]['fname'],0,1)?> <?php echo ' '.intl_clean($members[$g]['mname'],0,1); ?> <?=intl_clean($members[$g]['lname'],0,1)?>
	</span>
	<?php if( $members[$g]['id'] != $_SESSION['admin']['user_id'] ) { echo '</a>'; } ?>
	<? if( $members[$g]['title'] != '' ) echo '<br /><span class="italic">'.intl_clean($members[$g]['title'],0,1).'</span>'; ?>
	</p>
	</li>
	<?php } # END Group Members loop ?>
	<? if( empty($members) ) echo '<li><p class="italic">There are currently no members associated with this affiliation.</p></li>'; ?>
	</ul>
	
<?php } # END if can view group members ?>
		
<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>