<?php
# =====================================================================================
# Header Content
# =====================================================================================
$listingQuery = "SELECT * FROM users WHERE id = ".$_REQUEST['uID'];
$listing = db_select(DITCDB, $listingQuery);

# set up values for group affiliations
$groupQuery = "SELECT * FROM group_affil WHERE user_id = ".$_REQUEST['uID'];
$group = db_select(DITCDB, $groupQuery);
if(!empty($group)) { 
	for($i=0; $i<count($group); $i++) {
		$_SESSION['form']['affil_'.$group[$i]['group_id']] = $group[$i]['group_access'];
	}
}

# Convert query result values to SESSION values
while (list($k,$v) = each($listing[0])) { $_SESSION['form'][$k] = $v; }

/* clear password value */
unset($_SESSION['form']['pw']);

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>