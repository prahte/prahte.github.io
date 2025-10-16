<?php
echo "<p>To change an Athletes Competing listing, click on the <strong>Edit</strong> button. To delete the listing, click on the <strong>Delete</strong> button. To add a new listing, click on the <strong>Add a New Listing</strong> link.</p>\n";
echo "<dl id=\"athletesCompetingList\">\n";
$year = '';
for($i=0; $i<count($activeListings); $i++) {
	if( date('Y', strtotime($activeListings[$i]['comp_date'])) != $year ) {
		if( $i != 0 ) { echo '</ul></dd>'; }
		echo '<dt>'.date('Y', strtotime($activeListings[$i]['comp_date'])).'</dt>';
		echo "<dd><ul>\n";
		echo '<li class="clearfix">';
		echo '<form action="'.$_SERVER['PHP_SELF'].'?cID='.$activeListings[$i]['id'].'" method="post" class="p-border gray-bkgd-fade float-right" />';
		echo '<input name="submit" id="edit" type="submit" value="Edit" class="button">';
		echo '<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm(\'Are you sure you want to delete this listing?\');" />';
		echo '</form>';
		echo intl_clean($activeListings[$i]['comp_title']).' '.intl_clean($activeListings[$i]['comp_location']).'<em>'.date('M j, Y',strtotime($activeListings[$i]['comp_date'])).'</em></li>';
	} else {
		echo '<li class="clearfix">';
		echo '<form action="'.$_SERVER['PHP_SELF'].'?cID='.$activeListings[$i]['id'].'" method="post" class="p-border gray-bkgd-fade float-right" />';
		echo '<input name="submit" id="edit" type="submit" value="Edit" class="button">';
		echo '<input name="submit" id="delete" type="submit" value="Delete" class="button" onclick="return confirm(\'Are you sure you want to delete this listing?\');" />';
		echo '</form>';
		echo intl_clean($activeListings[$i]['comp_title']).' '.intl_clean($activeListings[$i]['comp_location']).'<em>'.date('M j, Y',strtotime($activeListings[$i]['comp_date'])).'</em></li>';
	}
	$year = date('Y', strtotime($activeListings[$i]['comp_date']));
}
echo "</ul>\n</dd>\n</dl>\n";	
echo "</div>\n";
echo "<div id=\"admin-sidebar\">";
echo '<h5 class="plus"><a href="'.$_SERVER['PHP_SELF'].'?n=1">Create a New Listing</a></h5>';
echo "</div>\n";
unset($_SESSION['form']);
unset($_SESSION['alert']);
?>