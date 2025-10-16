<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php $custom_title = 1 ?>
<title>ATLANTA 1996 :: The Legacy Institution of the Atlanta 1996 Centennial Olympic Games :: News Archive</title> 
<?php include(homepath."/inc/head.inc") ?>

</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content">
	<div class="body-header">
		<img src="/images/headerIMG-news-events.jpg?v=2" width="500" height="153" border="0" alt="News &amp; Events" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title"><h3>NEWS ARCHIVE</h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<!--<h4 class="blue-text">RECENT NEWS</h4>-->
	
	<?php
	$year_link_date = (date('Y'))."-12-31";
	$year_link_query = "SELECT * FROM ditc_news WHERE start_date <= '".$year_link_date."' AND status = 1 ORDER BY start_date DESC";
	$year_link = db_select(DITCDB, $year_link_query);
	
	if(isset($_REQUEST['year']) && $_REQUEST['year'] != '') { $active_year = $_REQUEST['year']; }
	else { $active_year = date('Y', strtotime($year_link[0]['start_date'])); }
	$search_start = $active_year."-01-01";
	$search_end = $active_year."-12-31";
	
	$news_query = "SELECT * FROM ditc_news WHERE start_date >= '".$search_start."' AND start_date <= '".$search_end."' AND status = 1 ORDER BY start_date DESC";
	$news = db_select(DITCDB, $news_query);
	
	$current_year = 0;
	echo '<h5 class="blue-text">';
	for ($i=0; $i<count($year_link); $i++) { 
		if(date('Y', strtotime($year_link[$i]['start_date'])) != $current_year) { 
			if($i != 0) { echo(" | "); } 
			if(date('Y', strtotime($year_link[$i]['start_date'])) == $active_year) {
				echo date('Y', strtotime($year_link[$i]['start_date']));
			} else {
				echo '<a href="index.php?year='.date('Y', strtotime($year_link[$i]['start_date'])).'">'.date('Y', strtotime($year_link[$i]['start_date'])).'</a>';
			}
		}
		$current_year = date('Y', strtotime($year_link[$i]['start_date']));
	} 
	echo '</h5>';
	?>
	
	<?php
	for ($i=0; $i<count($news); $i++) {
		echo "<div class=\"news-summary clearfix\"";
		if($i == 0) { echo " style=\"padding-top:0\""; }
		echo ">\n";
	?>
	
	<?php if($news[$i]['thumb_photo'] != '') { ?>
	<img src="/news-events/articles/photos/<?=$news[$i]['thumb_photo']?>" width="90" alt="<?=intl_clean($news[$i]['title'],1,0)?>" class="" />
	<?php } else { ?>
	<img src="/news-events/articles/photos/ditc-thmb-default.jpg" width="90" alt="<?=intl_clean($news[$i]['title'],1,0)?>" class="" />
	<?php } ?>

	<?php
	# setting up title link - if at least one of the content fields is NOT blank (text_1, custom content, related docs, flickr gallery, etc.) 
	if($news[$i]['text_1'] != '' || $news[$i]['custom_content'] != 0 || $news[$i]['flickr_id'] != '' || $news[$i]['related_links'] != '' || $news[$i]['related_docs'] != 0) {
		# set the title to have a link, and "MORE" to be true
		$title_link = "<a href=\"articles/article.php?id=".$news[$i]['id']."&amp;year=".date('Y', strtotime($news[$i]['start_date']))."\">".intl_clean($news[$i]['title'],0,1)."</a>";
		$more_link = 1;
		# else just display the title w/o a link
	} else {
		$title_link = intl_clean($news[$i]['title'],0,1); $more_link = 0;
	} ?>
	
	<h6><?=$title_link?></h6>
	<?php
	if($news[$i]['subtitle'] != '') { echo '<p><span class="bold">'.intl_clean($news[$i]['subtitle'],0,1).'</span></p>'; }
	if(substr($news[$i]['summary_text'],0,2) != '<p' && $news[$i]['summary_text'] != '') {
		$news[$i]['summary_text'] = '<p>'.$news[$i]['summary_text'].'</p>';
	}
	echo '<p>';
	echo '<span class="bold">'.intl_clean($news[$i]['location'],0,1).'</span>';
	echo ' ('.date_result($news[$i]['start_date'],$news[$i]['end_date']).')';
	if($news[$i]['summary_text'] != '') { echo '<br />'.substr(intl_clean(substr($news[$i]['summary_text'],0,(strlen($news[$i]['summary_text'])-4)),0,1),3); }
	if($more_link > 0) { echo '<br /><a href="articles/article.php?id='.$news[$i]['id'].'&amp;year='.date('Y', strtotime($news[$i]['start_date'])).'"><strong><em>MORE</em>&nbsp;&rsaquo;&rsaquo;</strong></a>'; }
	echo '</p>';
	?>
	
	</div>
	<?php } ?>
	
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php include(homepath."/inc/right-sidebar.inc") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php include(homepath."/inc/footer.inc") ?>
<?php include(homepath."/inc/ga.inc") ?>
</body>
</html>