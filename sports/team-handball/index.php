<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<?php $custom_title = 1 ?>
<title>ATLANTA 1996 :: The Legacy Institution of the Atlanta 1996 Centennial Olympic Games :: Team Handball</title>
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
		<a href="/sports/team-handball.php"><img src="/images/headerIMG-handball.jpg" width="500" height="153" border="0" alt="Team Handball" style="border-bottom: 2px solid #fff;"/></a>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title align-right" id="sports"><h3><a href="../admin/">Member Access</a></h3></div>

	<div class="pad15"><!-- START main body content -->
	
	<h3 class="blue-text">Meet the Team</h3>
	
	<ul>
		<li>
		  <h5><a href="team.php" class="alt-link">Team Handball US Men's National Team with the ATLANTA DITC (2007-2008) &raquo;</a></h5>
		</li>
		<li><h5><a href="traininglist-men.php" class="alt-link">Men Team Handball players who attended training at the ATLANTA DITC since November 2007 &raquo;</a></h5></li>
		<li><h5><a href="traininglist-women.php" class="alt-link">Women Team Handball players who attended training at the ATLANTA DITC since November 2007 &raquo;</a></h5></li>
	</ul>
	
	<hr />
	
	<?php
		$handballNewsQuery = "SELECT n.id, n.title, n.subtitle, n.thumb_photo, n.summary_text, n.text_1, n.related_links, n.location, n.start_date, n.end_date, n.related_docs, n.custom_content, n.flickr_id, a.cat_id, a.news_id
								FROM ditc_news AS n, ditc_news_catassoc AS a
								WHERE
								a.cat_id = 2
								AND
								a.news_id = n.id
								ORDER BY n.start_date DESC";
		$handballNews = db_select(DITCDB, $handballNewsQuery);
	?>
	
	<h3 class="blue-text">Team Handball News</h3>
	
	<?php
	for ($i=0; $i<count($handballNews); $i++) {
		echo "<div class=\"news-summary clearfix\"";
		if($i == 0) { echo " style=\"padding-top:0\""; }
		echo ">\n";
	?>
	
	<?php if($handballNews[$i]['thumb_photo'] != '') { ?>
	<img src="/news-events/articles/photos/<?=$handballNews[$i]['thumb_photo']?>" width="90" alt="<?=intl_clean($handballNews[$i]['title'],1,0)?>" class="" />
	<?php } else { ?>
	<img src="/news-events/articles/photos/ditc-thmb-default.jpg" width="90" alt="<?=intl_clean($handballNews[$i]['title'],1,0)?>" class="" />
	<?php } ?>

	<?php
	# setting up title link - if at least one of the content fields is NOT blank (text_1, custom content, related docs, flickr gallery, etc.) 
	if($handballNews[$i]['text_1'] != '' || $handballNews[$i]['custom_content'] != 0 || $handballNews[$i]['flickr_id'] != '' || $handballNews[$i]['related_links'] != '' || $handballNews[$i]['related_docs'] != 0) {
		# set the title to have a link, and "MORE" to be true
		$title_link = "<a href=\"/news-events/articles/article.php?id=".$handballNews[$i]['id']."&amp;year=".date('Y', strtotime($handballNews[$i]['start_date']))."\">".intl_clean($handballNews[$i]['title'],0,1)."</a>";
		$more_link = 1;
		# else just display the title w/o a link
	} else {
		$title_link = intl_clean($handballNews[$i]['title'],0,1); $more_link = 0;
	} ?>
	
	<h6><?=$title_link?></h6>
	<?php
	if($handballNews[$i]['subtitle'] != '') { echo '<p><span class="bold">'.intl_clean($handballNews[$i]['subtitle'],0,1).'</span></p>'; }
	if(substr($handballNews[$i]['summary_text'],0,2) != '<p' && $handballNews[$i]['summary_text'] != '') {
		$handballNews[$i]['summary_text'] = '<p>'.$handballNews[$i]['summary_text'].'</p>';
	}
	echo '<p>';
	echo '<span class="bold">'.intl_clean($handballNews[$i]['location'],0,1).'</span>';
	echo ' ('.date_result($handballNews[$i]['start_date'],$handballNews[$i]['end_date']).')';
	if($handballNews[$i]['summary_text'] != '') { echo '<br />'.substr(intl_clean(substr($handballNews[$i]['summary_text'],0,(strlen($handballNews[$i]['summary_text'])-4)),0,1),3); }
	if($more_link > 0) { echo '<br /><a href="'.homepath.'news-events/articles/article.php?id='.$handballNews[$i]['id'].'&amp;year='.date('Y', strtotime($handballNews[$i]['start_date'])).'"><strong><em>MORE</em>&nbsp;&rsaquo;&rsaquo;</strong></a>'; }
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
<?php include(homepath."/inc/ga.inc"); ?>
</body>
</html>