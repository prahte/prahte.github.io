<?php
# =====================================================================================
# Header Content
# =====================================================================================
$activeListingsQuery = "SELECT * FROM groups ORDER BY name ASC";
$activeListings = db_select(DITCDB, $activeListingsQuery);


$GroupAffilQuery = "SELECT group_access FROM group_affil WHERE group_id = '".$_REQUEST['gID']."' AND user_id = '".$_SESSION['admin']['user_id']."'";
$GroupAffil = db_select(DITCDB, $GroupAffilQuery);
$groupAccess = $GroupAffil[0]['group_access'];
# make sure they're part of this group, if not, boot 'em out
if( empty($GroupAffil) && $_SESSION['admin']['access_level'] < 2 ) { header("Location:../index.php"); }


# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_currentListings.php";
?>