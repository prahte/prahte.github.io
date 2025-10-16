<?php
# =====================================================================================
# Header Content
# =====================================================================================
$listingQuery = "SELECT * FROM athletes_competing WHERE id = ".$_REQUEST['cID'];
$listing = db_select(DITCDB, $listingQuery);

# Convert query result values to SESSION values
while (list($k,$v) = each($listing[0])) { $_SESSION['form'][$k] = $v; }

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>