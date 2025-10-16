<p>To edit a news item, click on the <strong>Edit</strong> button. To Deactivate a news item, click on the <strong>Deactivate</strong> button (you
must first <strong>Deactivate</strong> an item before it can be <strong>Deleted</strong> permanently.</p>

<h4 class="blue-text"><?=substr($yearStart,0,4)?> News</h4>

<p><strong>Jump to Another Year:</strong> <?=$yearLinks?></p>
	
<h5 class="red-text">Active Listings</h5>

<ul class="divided-list">
<?php
$activeCount = 0;
for($i=0; $i<count($activeListings); $i++) {
if( $activeListings[$i]['status'] == 1 ) {
$activeCount ++;
?>
<li class="clearfix">
<?php if( $activeListings[$i]['thumb_photo'] != '' ) { ?>
<img src="/news-events/articles/photos/<?=$activeListings[$i]['thumb_photo']?>" width="90" class="float-left p-border" alt="" />
<?php } else { ?>
<img src="/news-events/articles/photos/ditc-thmb-default.jpg" width="90" class="float-left p-border" alt="" />
<?php } ?>
<h5><?=intl_clean($activeListings[$i]['title'],0,1)?></h5>
<?php if( $activeListings[$i]['subtitle'] != '' ) echo '<h6>'.intl_clean($activeListings[$i]['subtitle'],0,1).'</h6>'; ?>
<p><strong><?=intl_clean($activeListings[$i]['location'],0,1)?></strong> &mdash; <em><?=date_result($activeListings[$i]['start_date'],$activeListings[$i]['end_date'])?></em></p>
<?php if($activeListings[$i]['milestone'] != 0) echo '<p class="red-text italic bold">DITC Milestone</p>'; ?>
<form action="<?=$_SERVER['PHP_SELF']?>?nID=<?=$activeListings[$i]['id']?><? if( isset($_REQUEST['year']) ) echo '&amp;'.$_SERVER['QUERY_STRING']; ?>" method="post" class="p-border bottom-buffer gray-bkgd-fade clear-float" />
<input name="submit" id="edit" type="submit" value="Edit" class="button" />
<input name="submit" id="deactivate" type="submit" value="Deactivate" class="button" />
</form>
</li>
<?php } } ?>
<?php if( $activeCount == 0 ) echo '<li><p class="italic">There are no active news items for '.substr($yearStart,0,4).'</p></li>'; ?>
</ul>

<hr />

<h5 class="red-text">Inactive Listings</h5>

<ul class="divided-list">
<?php
$InactiveCount = 0;
for($i=0; $i<count($activeListings); $i++) {
if( $activeListings[$i]['status'] == 0 ) {
$InactiveCount ++;
?>
<li class="clearfix">
<?php if( $activeListings[$i]['thumb_photo'] != '' ) { ?>
<img src="/news-events/articles/photos/<?=$activeListings[$i]['thumb_photo']?>" width="90" class="float-left p-border" alt="" />
<?php } else { ?>
<img src="/news-events/articles/photos/ditc-thmb-default.jpg" width="90" class="float-left p-border" alt="" />
<?php } ?>
<h5><?=intl_clean($activeListings[$i]['title'],0,1)?></h5>
<?php if( $activeListings[$i]['subtitle'] != '' ) echo '<p>'.intl_clean($activeListings[$i]['subtitle'],0,1).'</p>'; ?>
<p><strong><?=intl_clean($activeListings[$i]['location'],0,1)?></strong> &mdash; <em><?=date_result($activeListings[$i]['start_date'],$activeListings[$i]['end_date'])?></em></p>
<?php if($activeListings[$i]['milestone'] != 0) echo '<p class="red-text italic bold">DITC Milestone</p>'; ?>
<form action="<?=$_SERVER['PHP_SELF']?>?nID=<?=$activeListings[$i]['id']?><? if( isset($_REQUEST['year']) ) echo '&amp;'.$_SERVER['QUERY_STRING']; ?>" method="post" class="p-border bottom-buffer gray-bkgd-fade clear-float" />
<input name="submit" id="activate" type="submit" value="Activate" class="button">
<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm('Are you sure you want to delete this news item?');" >
</form>
</li>
<?php } } ?>
<?php if( $InactiveCount == 0 ) echo '<li><p class="italic">There are no Inactive news items for '.substr($yearStart,0,4).'</p></li>'; ?>
</ul>

</div><!-- END #content -->

<div id="admin-sidebar">

<? if( $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<h5 class="plus"><a href="/admin/access/news/index.php?n=1">Post a News Article</a></h5>
<?php } ?>

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>