<?php
# =====================================================================================
# Header Content
# =====================================================================================
$listingQuery = "SELECT * FROM group_docs WHERE id = ".$_REQUEST['dID'];
$listing = db_select(DITCDB, $listingQuery);

$affilQuery = "SELECT * FROM group_docs_affil WHERE doc_id = ".$_REQUEST['dID'];
$affil = db_select(DITCDB, $affilQuery);
for($i=0; $i<count($affil); $i++) {
	$_SESSION['form']['affil_'.$affil[$i]['group_id']] = $affil[$i]['group_id'];
}

# Convert query result values to SESSION values
while (list($k,$v) = each($listing[0])) { $_SESSION['form'][$k] = $v; }

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>