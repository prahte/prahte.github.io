<?php
require_once("includes/global/constants.php");
require_once(homepath."includes/global/functions.php");

$milestonesQuery = "SELECT * FROM ditc_news WHERE milestone = 1 AND status = 1 ORDER BY start_date DESC";
$milestones = db_select(DITCDB, $milestonesQuery);
$randomMilestones = array_rand($milestones, 2);

$numbers = array('n1'=>1,'n2'=>2,'n3'=>3,'n4'=>4,'n5'=>5,'n6'=>6);
$random = array_rand($numbers, 3);
$milestonesArray = array();
for($m=1; $m<count($random); $m++) {
	array_push($milestonesArray, $random[$m]{1});
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>Atlanta Dekalb International Training Center (ATLANTA DITC) - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games</title>
 
<?php require(homepath."includes/modules/head.php") ?>
<style type="text/css" media="screen">
#masthead { background: #E1AB11 url(../images/bkgd-masthead-beijing.jpg) no-repeat center top; }
</style>
</head>

<body>

<div id="main-container">

<?php require(homepath."includes/modules/masthead.php") ?>

<?php require(homepath."includes/modules/top-nav.php") ?>

<div id="body-container">

<?php require(homepath."includes/modules/left-nav.php") ?>

<div id="content">
	<div class="body-header" id="home-title">
		<div class="body-header-left">
			<div style="padding: 10px 5px 10px 15px;">
			<h2>Welcome</h2>
			<p>You have reached the <strong>Atlanta DeKalb International Training Center (ATLANTA DITC)</strong> official website. Here we hope to inspire true passion in those striving to continue the legacy of the <strong>1996 Atlanta Olympic Games</strong>.</p>
			<p>Our goal is to prepare the way for athletes from all over the world for a chance to train at the top of their level and compete in international athletic events such as the Olympic Games.</p>
			</div>
		</div>
		<div class="body-header-right" id="flashcontent"></div>
		
		<script type="text/javascript">
		// <![CDATA[
		var so = new SWFObject("images/home-movie-rotation.swf", "homemovie", "290", "217", "5", "#fff");
		so.write("flashcontent");
		// ]]>
		</script>
	
	</div>
		
	<div class="body-section-title" id="home"><h3 class="clearfix"><span class="block float-left">Current News</span><span class="block float-right"><a href="<?=homepath?>news-events/newsletters/">Newsletters</a></span></h3></div>
	
	<div class="pad15 clearfix"><!-- START main body content -->
	
	<?php
	$current_year_start = date('Y')."-01-01";
	$news_query = "SELECT * FROM ditc_news WHERE start_date >= '".$current_year_start."' AND start_date <= '".date('Y-m-d')."' AND status = 1 ORDER BY start_date DESC";
	$news = db_select(DITCDB, $news_query);
	if(!$news || count($news) < 3) {
	$current_year_start = (date('Y')-1)."-01-01";
	$news_query = "SELECT * FROM ditc_news WHERE start_date >= '".$current_year_start."' AND start_date <= '".date('Y-m-d')."' AND status = 1 ORDER BY start_date DESC";
	$news = db_select(DITCDB, $news_query);
	}
	?>
	
	<?php
	if(count($news) < 3) { $count = count($news); } else { $count = 3; }
	for ($i=0; $i<$count; $i++) {
	echo "<div class=\"news-summary clearfix\"";
		if($i == 0) { echo " style=\"padding-top:0\""; }
		echo ">\n";
	?>
	
	<?php if($news[$i]['thumb_photo'] != '') { ?>
	<img src="<?=homepath?>news-events/articles/photos/<?=$news[$i]['thumb_photo']?>" width="90" alt="<?=intl_clean($news[$i]['title'],1,0)?>" class="" />
	<?php } else { ?>
	<img src="<?=homepath?>news-events/articles/photos/ditc-thmb-default.jpg" width="90" alt="<?=intl_clean($news[$i]['title'],1,0)?>" class="" />
	<?php } ?>

	<?php
	# setting up title link - if at least one of the content fields is NOT blank (text_1, custom content, related docs, flickr gallery, etc.) 
	if($news[$i]['text_1'] != '' || $news[$i]['custom_content'] != 0 || $news[$i]['flickr_id'] != '' || $news[$i]['related_links'] != '' || $news[$i]['related_docs'] != 0) {
		# set the title to have a link, and "MORE" to be true
		$title_link = "<a href=\"".homepath."news-events/articles/article.php?id=".$news[$i]['id']."&amp;year=".date('Y', strtotime($news[$i]['start_date']))."\">".intl_clean($news[$i]['title'],0,1)."</a>";
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
	if($more_link > 0) { echo '<br /><a href="'.homepath.'news-events/articles/article.php?id='.$news[$i]['id'].'&amp;year='.date('Y', strtotime($news[$i]['start_date'])).'"><strong><em>MORE</em>&nbsp;&rsaquo;&rsaquo;</strong></a>'; }
	echo '</p>';
	?>
	
	</div>
	<?php } ?>
	
	<h5 class="italic align-right" style="clear: left; padding: 15px 0;"><a href="<?=homepath?>news-events/">MORE NEWS &rsaquo;&rsaquo;</a></h5>
	
	</div>
	
	<div class="body-section-title" id="milestones"><h3>Milestones</h3></div>
	
	<div class="pad15 clearfix" style="padding-bottom: 30px;">
	
	<?php
	for ($i=0; $i<count($randomMilestones); $i++) {
	echo "<div class=\"news-summary clearfix\"";
		if($i == 0) { echo " style=\"padding-top:0\""; }
		echo ">\n";
	?>
	
	<?php if($milestones[$randomMilestones[$i]]['thumb_photo'] != '') { ?>
	<img src="<?=homepath?>news-events/articles/photos/<?=$milestones[$randomMilestones[$i]]['thumb_photo']?>" width="90" alt="<?=intl_clean($milestones[$randomMilestones[$i]]['title'],1,0)?>" class="" />
	<?php } else { ?>
	<img src="<?=homepath?>news-events/articles/photos/ditc-thmb-default.jpg" width="90" alt="<?=intl_clean($milestones[$randomMilestones[$i]]['title'],1,0)?>" class="" />
	<?php } ?>

	<?php
	# setting up title link - if at least one of the content fields is NOT blank (text_1, custom content, related docs, flickr gallery, etc.) 
	if($milestones[$randomMilestones[$i]]['text_1'] != '' || $milestones[$randomMilestones[$i]]['custom_content'] != 0 || $milestones[$randomMilestones[$i]]['flickr_id'] != '' || $milestones[$randomMilestones[$i]]['related_links'] != '' || $milestones[$randomMilestones[$i]]['related_docs'] != 0) {
		# set the title to have a link, and "MORE" to be true
		$title_link = "<a href=\"".homepath."news-events/articles/article.php?id=".$milestones[$randomMilestones[$i]]['id']."&amp;year=".date('Y', strtotime($milestones[$randomMilestones[$i]]['start_date']))."\">".intl_clean($milestones[$randomMilestones[$i]]['title'],0,1)."</a>";
		$more_link = 1;
		# else just display the title w/o a link
	} else {
		$title_link = intl_clean($milestones[$randomMilestones[$i]]['title'],0,1); $more_link = 0;
	} ?>
	
	<h6><?=$title_link?></h6>
	<?php
	if($milestones[$randomMilestones[$i]]['subtitle'] != '') { echo '<p><span class="bold">'.intl_clean($milestones[$randomMilestones[$i]]['subtitle'],0,1).'</span></p>'; }
	if(substr($milestones[$randomMilestones[$i]]['summary_text'],0,2) != '<p' && $milestones[$randomMilestones[$i]]['summary_text'] != '') {
		$milestones[$randomMilestones[$i]]['summary_text'] = '<p>'.$milestones[$randomMilestones[$i]]['summary_text'].'</p>';
	}
	echo '<p>';
	echo '<span class="bold">'.intl_clean($milestones[$randomMilestones[$i]]['location'],0,1).'</span>';
	echo ' ('.date_result($milestones[$randomMilestones[$i]]['start_date'],$milestones[$randomMilestones[$i]]['end_date']).')<br />';
	if($milestones[$randomMilestones[$i]]['summary_text'] != '') { echo '<br />'.substr(intl_clean(substr($milestones[$randomMilestones[$i]]['summary_text'],0,(strlen($milestones[$randomMilestones[$i]]['summary_text'])-4)),0,1),3); }
	if($more_link > 0) { echo '<br /><a href="'.homepath.'news-events/articles/article.php?id='.$milestones[$randomMilestones[$i]]['id'].'&amp;year='.date('Y', strtotime($milestones[$randomMilestones[$i]]['start_date'])).'"><strong><em>MORE</em>&nbsp;&rsaquo;&rsaquo;</strong></a>'; }
	echo '</p>';
	?>
	
	</div>
	<?php } ?>
	<!--<pre>
	<?=print_r($randomMilestones);?>
	</pre>-->
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php require(homepath."includes/modules/right-sidebar.php") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php require(homepath."includes/modules/footer.php") ?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1544491-1";
urchinTracker();
</script>
</body>
</html>