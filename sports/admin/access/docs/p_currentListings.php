<?php
# =====================================================================================
# Header Content
# =====================================================================================
$activeListingsQuery = "SELECT * FROM group_docs ORDER BY doc_title ASC";
$activeListings = db_select(DITCDB, $activeListingsQuery);

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_currentListings.php";
?>