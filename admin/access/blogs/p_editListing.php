<?php
# =====================================================================================
# Header Content
# =====================================================================================
$listingQuery = "SELECT * FROM blogs WHERE id = ".$_REQUEST['bID'];
$listing = db_select(DITCDB, $listingQuery);

# convert query result values to SESSION values
while (list($k,$v) = each($listing[0])) { $_SESSION['form'][$k] = $v; }

# set comma sep. list for tinyMCE options
# $richTextAreas = 'text_1,text_2,related_links';
# $basicTextAreas = 'summary_text,caption_1,caption_2';

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>