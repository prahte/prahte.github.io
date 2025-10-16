<?php
# =====================================================================================
# Header Content
# =====================================================================================
$activeListingsQuery = "SELECT * FROM athletes_competing ORDER BY comp_date DESC";
$activeListings = db_select(DITCDB, $activeListingsQuery);

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_currentListings.php";
?>