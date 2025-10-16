<?php
# =====================================================================================
# Header Content
# =====================================================================================
$activeListingsQuery = "SELECT * FROM users WHERE access > 0 ORDER BY lname ASC";
$activeListings = db_select(DITCDB, $activeListingsQuery);

$INactiveListingsQuery = "SELECT * FROM users WHERE access = 0 ORDER BY lname ASC";
$INactiveListings = db_select(DITCDB, $INactiveListingsQuery);

$GroupAffilQuery = "SELECT id FROM group_affil WHERE group_id = ".$_REQUEST['gID']." AND user_id = ".$_SESSION['admin']['user_id']." AND group_access > 1";
$GroupAffil = db_select(DITCDB, $GroupAffilQuery);
##### if user is not an admin, and not a standard or higher member of this group, boot 'em out
if( empty($GroupAffil) && $_SESSION['admin']['access_level'] < AdminAccess ) { header("Location:../index.php"); }

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_currentListings.php";
?>