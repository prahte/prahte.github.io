<ul class="">
<?php for($i=0; $i<count($activeListings); $i++) {
##### if uID is specified, display only the corresponding group -- if not, display only if user is admin
if( isset($_REQUEST['uID']) && $_REQUEST['uID'] == $activeListings[$i]['id'] ) {
?>

<li class="clearfix">

<?php
##### display photo if it exists 
if( $activeListings[$i]['photo'] != '' ) { ?>
<img src="<?=homepath?>admin/access/assets/photos/<?=$activeListings[$i]['photo']?>" alt="" width="50" class="float-left p-border" />
<?php } ?>
<div class="float-left">
<h5>
<?=intl_clean($activeListings[$i]['fname'],0,1)?><? echo ' '.intl_clean($activeListings[$i]['mname'],0,1); ?> <?=intl_clean($activeListings[$i]['lname'],0,1)?>
</h5>
<?php if($activeListings[$i]['title'] != '') { echo '<h6>'.intl_clean($activeListings[$i]['title'],0,1).'</h6>'; } ?>
<p>
<?php if($activeListings[$i]['address1'] != '') { echo intl_clean($activeListings[$i]['address1'],0,1).'<br />'; } ?>
<?php if($activeListings[$i]['address2'] != '') { echo intl_clean($activeListings[$i]['address1'],0,1).'<br />'; } ?>
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
</div>

</li>

<?php } } ?>

</ul>

<hr />

<p class="italic"><a href="<?=homepath?>sponsors/admin/access/groups/index.php?gID=<?=$_REQUEST['gID']?>">&lt; Back to group information</a></p>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>