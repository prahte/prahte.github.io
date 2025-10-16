<?php
# =====================================================================================
# Header Content
# =====================================================================================
$newsQuery = "SELECT * FROM ditc_news ORDER BY start_date DESC";
$news = db_select(DITCDB, $newsQuery);

if( isset($_REQUEST['year']) ) {
	$yearStart = $_REQUEST['year'].'-01-01';
	$yearEnd = $_REQUEST['year'].'-12-31';
} else {
	$yearStart = date('Y', strtotime($news[0]['start_date'])).'-01-01';
	$yearEnd = date('Y', strtotime($news[0]['start_date'])).'-12-31';
}

$yearArray = array();
for($i=0; $i<count($news); $i++) {
	if( !in_array(substr($news[$i]['start_date'],0,4),$yearArray) ) { 
		if( substr($news[$i]['start_date'],0,4) != substr($yearStart,0,4) ) {
			$yearLinks .= '<a href="index.php?year='.substr($news[$i]['start_date'],0,4).'">'.substr($news[$i]['start_date'],0,4).'</a>';
		} else { $yearLinks .= substr($news[$i]['start_date'],0,4); }
		if( $i != ((count($news))-1) ) { $yearLinks .= ' | '; }
		array_push($yearArray,substr($news[$i]['start_date'],0,4));
	}
}

$activeListingsQuery = "SELECT * FROM ditc_news WHERE start_date >= '".$yearStart."' AND start_date <= '".$yearEnd."' ORDER BY start_date DESC";
$activeListings = db_select(DITCDB, $activeListingsQuery);

# =====================================================================================
# Content Variables
# =====================================================================================
$content = "c_currentListings.php";
?>