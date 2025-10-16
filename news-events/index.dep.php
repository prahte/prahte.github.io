<?php
require_once("../includes/global/constants.php");
require_once(homepath."includes/global/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>ATLANTA DITC - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - News &amp; Events</title>
 
<?php require(constant('homepath')."includes/modules/head.php") ?>

</head>

<body>

<div id="main-container">

<?php require(constant('homepath')."includes/modules/masthead.php") ?>

<?php require(constant('homepath')."includes/modules/top-nav.php") ?>

<div id="body-container">

<?php require(constant('homepath')."includes/modules/left-nav.php") ?>

<div id="content">
	<div class="body-header">
		<img src="<?=constant('homepath')?>images/headerIMG-news-events.jpg" width="500" height="153" border="0" alt="News &amp; Events" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title"><h3><span class="highlight">NEWS &amp; EVENTS</span> | <a href="archive.php">NEWS &amp; EVENTS ARCHIVE</a></h3></div>
	
	<div class="pad15"><!-- START main body content -->
	
	<!--<h4 class="blue-text">RECENT NEWS</h4>-->
	
	<?php
	$current_year_start = date('Y')."-01-01";
	$news_query = "SELECT * FROM ditc_news WHERE start_date >= '".$current_year_start."' AND start_date <= '".date('Y-m-d')."' AND status = 1 ORDER BY start_date DESC";
	$news = db_select(DITCDB, $news_query);
	if(!$news || count($news) < 5) {
	$current_year_start = (date('Y')-1)."-01-01";
	$news_query = "SELECT * FROM ditc_news WHERE start_date >= '".$current_year_start."' AND start_date <= '".date('Y-m-d')."' AND status = 1 ORDER BY start_date DESC";
	$news = db_select(DITCDB, $news_query);
	}
	?>
	<div></div>
	<?php
	$first_item = 0;
	for ($i=0; $i<count($news); $i++) {
	?>
	<?php if($first_item == 0) { ?>
	<div class="news-summary" style="padding-top: 0;">
	<?php ; } else { ?>
	<div class="news-summary">
	<?php ; } ?>
		<?php if($news[$i]['thumb_photo'] != '') { ?>
		<img src="<?=homepath?>news-events/articles/photos/<?=$news[$i]['thumb_photo']?>" width="90" height="90" border="0" alt="<?=strip_tags($news[$i]['title'])?>" class="" />
		<?php ; } else { ?>
		<img src="<?=homepath?>news-events/articles/photos/ditc-thmb-default.jpg" width="90" height="90" border="0" alt="<?=strip_tags($news[$i]['title'])?>" class="" />
		<?php ; } ?>
		<?php
		# setting up title link - if at least one of the content fields is NOT blank (text_1, custom content, related docs, flickr gallery, etc.) 
		if($news[$i]['text_1'] != '' || $news[$i]['custom_content'] > 0 || $news[$i]['flickr_id'] != '' || $news[$i]['related_links'] != '' || $news[$i]['related_docs'] > 0) {
		# set the title to have a link, and "MORE" to be true
		$title_link = "<a href=\"articles/article.php?id=".$news[$i]['id']."\">".intl_clean($news[$i]['title'],0,1)."</a>";
		$more_link = 1; }
		# else just display the title w/o a link
		else { $title_link = intl_clean($news[$i]['title'],0,1); $more_link = 0; } ?>
		<h6><?=$title_link?></h6>
		<?php if($news[$i]['subtitle'] != '') { ?>
		<p><span class="bold"><?=intl_clean($news[$i]['subtitle'],0,1)?></span></p>
		<?php ; } ?>
		<p><span class="bold"><?=intl_clean($news[$i]['location'],0,1)?></span> 
		<?php 
			# setting up the dates (checking for 2 dates - an end and a start, if same month, etc.)
			if($news[$i]['end_date'] != '') { ?>
			<?php
			if(date('m y', strtotime($news[$i]['start_date'])) == date('m y', strtotime($news[$i]['end_date']))) {
			$displaydate = date('F j', strtotime($news[$i]['start_date']))."-".date('j, Y', strtotime($news[$i]['end_date'])); }
			else { $displaydate = date('F j, Y', strtotime($news[$i]['start_date']))." - ".date('F j, Y', strtotime($news[$i]['end_date'])); } }
			else { $displaydate = date('F j, Y', strtotime($news[$i]['start_date'])); }
		?>
		(<?=$displaydate?>) <?php if($news[$i]['summary_text'] != '') { ?>&mdash; <?=intl_clean($news[$i]['summary_text'],0,1)?> <?php ; } ?>
		<?php
		# setting up the "MORE" link based on above variable
		if($more_link > 0) { ?>
		<a href="articles/article.php?id=<?=$news[$i]['id']?>"><em>MORE</em>&nbsp;&rsaquo;&rsaquo;</a>
		<?php ; } ?>
		</p>
	</div>
	<?php $first_item++; ?>
	<?php ; } ?>

	<h6 style="clear: left; padding: 20px 0;">Visit the <a href="http://www.fnt-usa.org/news/fntnews.php">Forging New Tomorrows Web site</a> for all published articles to date on the DITC.</h6>
	
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php require(constant('homepath')."includes/modules/right-sidebar.php") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php require(constant('homepath')."includes/modules/footer.php") ?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1544491-1";
urchinTracker();
</script>
</body>
</html>