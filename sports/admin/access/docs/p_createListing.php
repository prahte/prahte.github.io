<?php
# =====================================================================================
# Header Content
# =====================================================================================

# check to make sure user has access to this group and rights to upload documents (or is a sys admin)
$docInfoQuery = "SELECT user_id FROM group_affil
				WHERE group_id = '".$_REQUEST['gID']."'
				AND user_id = '".$_SESSION['admin']['user_id']."'
				AND group_access = 3";
$docInfo = db_select(DITCDB, $docInfoQuery);
#if(empty($docInfo) && $_SESSION['admin']['access_level'] < 2) { header("Location:../groups/index.php?gID=".$_REQUEST['gID']); }

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>