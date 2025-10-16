<p>To edit a document, click on the <strong>Edit</strong> button. To remove a document, click on the <strong>Delete</strong> button.</p>

<ul class="float-left width200">
<?php for($i=0; $i<count($activeListings); $i++) { ?>

<li class="pad5 t-border clearfix">
<h5 class="<?=$activeListings[$i]['type']?>"><a href="<?=homepath?>admin/access/assets/files/<?=$activeListings[$i]['file']?>"><?=intl_clean($activeListings[$i]['doc_title'],0,1)?></a></h5>
<p>
<span class="bold">Last updated:</span> <?=date('M j, Y', strtotime($activeListings[$i]['date']))?> at <?=date('g:i a', strtotime($activeListings[$i]['date']))?> 
&nbsp;&nbsp;&nbsp;<span class="bold">By:</span>
<?php
$userInfoQuery = "SELECT fname, lname, id FROM users WHERE id = ".$activeListings[$i]['user_id'];
$userInfo = db_select(DITCDB, $userInfoQuery);
?>
<a href="<?=homepath?>sponsors/admin/access/members/index.php?uID=<?=$userInfo[0]['id']?>">
<?=intl_clean($userInfo[0]['fname'],0,1)?> <?=intl_clean($userInfo[0]['lname'],0,1)?>
</a>
</p>
<p>
<span class="bold">Affiliations:</span>
<?php
$affilQuery = "SELECT g.name, g.id FROM groups AS g, group_docs_affil AS d WHERE
				d.doc_id = ".$activeListings[$i]['id']."
				AND
				d.group_id = g.id
				ORDER BY g.name ASC";
$affil = db_select(DITCDB, $affilQuery);
for($g=0; $g<count($affil); $g++) {
?>
<a href="<?=homepath?>sponsors/admin/access/groups/index.php?gID=<?=$affil[$g]['id']?>"><?=intl_clean($affil[$g]['name'],0,1)?></a>
<?php if($g < ( (count($affil))-1 ) ) { echo ', '; } ?>
<?php } ?>
</p>
<form action="<?=$_SERVER['PHP_SELF']?>?dID=<?=$activeListings[$i]['id']?>" method="post" class="p-border bottom-buffer gray-bkgd-fade clear-float" />
<input name="submit" id="edit" type="submit" value="Edit" class="button">
<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this document? This will delete it from all Affiliations.');" >
</form>
</li>

<?php } ?>

</ul>

<div class="float-right width200">

<? if( $_SESSION['admin']['access_level'] > 1 ) { ?>
<h5 class="plus"><a href="<?=homepath?>sponsors/admin/access/docs/index.php?n=1">Upload a New Document</a></h5>
<?php } ?>

</div>

<hr class="clear-float"/>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>