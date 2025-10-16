<?php
# =====================================================================================
# Header Content
# =====================================================================================
$listingQuery = "SELECT * FROM ditc_news WHERE id = ".$_REQUEST['nID'];
$listing = db_select(DITCDB, $listingQuery);

# convert query result values to SESSION values
while (list($k,$v) = each($listing[0])) { $_SESSION['form'][$k] = $v; }

# format dates
$_SESSION['form']['start_date'] = date('m/d/Y', strtotime($_SESSION['form']['start_date']));
if( $_SESSION['form']['end_date'] != '' && $_SESSION['form']['end_date'] != "0000-00-00" ) {
	$_SESSION['form']['end_date'] = date('m/d/Y', strtotime($_SESSION['form']['end_date']));
} else {
	$_SESSION['form']['end_date'] = '';
}	

# get associated categories
$assocCategoriesQuery = "SELECT cat_id FROM ditc_news_catassoc WHERE news_id = ".$_REQUEST['nID'];
$assocCategories = db_select(DITCDB, $assocCategoriesQuery);

# get related docs
$relatedDocsQuery = "SELECT * FROM ditc_news_docs WHERE news_id = ".$_REQUEST['nID']." ORDER BY doc_title ASC";
$relatedDocs = db_select(DITCDB, $relatedDocsQuery);

# get custom content
$customQuery = "SELECT content FROM ditc_news_custom WHERE news_id = ".$_REQUEST['nID'];
$custom = db_select(DITCDB, $customQuery);

# set up category array session value
$catArray = array();
if($assocCategories) {
	for($i=0; $i<count($assocCategories); $i++) {
		 array_push($catArray, $assocCategories[$i]['cat_id']);
	}
}
$_SESSION['form']['categories'] = $catArray;

# set other session  values (if they exist)
if( !empty($relatedDocs) ) { $_SESSION['form']['docs'] = $relatedDocs; }
if( !empty($custom) ) { $_SESSION['form']['custom'] = $custom[0]['content']; }

# set comma sep. list for tinyMCE options
$richTextAreas = 'text_1,text_2,related_links';
$basicTextAreas = 'summary_text,caption_1,caption_2';

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_createEditListing.php";
?>