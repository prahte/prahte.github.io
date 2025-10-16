<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

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
 
<?php include(homepath."/inc/head.inc") ?>
<script type="text/javascript" src="/js/homeScripts.js"></script>
</head>

<body>

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content">
	<div class="body-header" id="home-title">
		<div class="body-header-left">
			<div style="padding: 10px 5px 10px 15px;">
			<h2>Welcome</h2>
			<p>You have reached the <strong>ATLANTA DITC</strong><strong> </strong>official web site. Here we hope to inspire true passion in those striving to continue the legacy of the <strong>Atlanta 1996 Centennial Olympic Games</strong>.</p>
			<p>			   Since 2002, 1855  athletes from 35 nations have competed and trained with the ATLANTA DITC. <br />
			  <br />
			  The ATLANTA DITC is a Member of the <strong>World Union of Olympic  Cities (WUOC)</strong> and represents the City of Atlanta at the WUOC.</p>
			</div>
		</div>
		<div class="body-header-right">
		<ul id="slideshow-home">
			<?php echo generateSlides('home'); ?>
		</ul>
		</div>
	</div>
	
	<div id="olympicCities">
		<dl>
			<dt id="futureCitiesTitle">Future Olympic Host Cities:</dt>
			<dd id="futureCitiesBody">
				<ul id="futureCitiesList" class="clearfix">
					<!--<li id="Vancouver2010"><a href="http://www.vancouver2010.com">Vancouver 2010</a></li>-->
					<li id="London2012"><a href="http://www.london2012.com/">London 2012</a></li>
					<li id="Sochi2014"><a href="http://sochi2014.com/">Sochi 2014</a></li>
					<li id="RioDeJaneiro2016"><a href="http://www.rio2016.org.br/pt/Default.aspx">Rio De Janeiro 2016</a></li>
				    <li><a href="http://www.pyeongchang2018.org/language/eng/index.asp?hb_Manager_PK=VDENAA01&s=">PyeongChang 2018</a></li>
				</ul>
			</dd>
			<dt id="candidateCitiesTitle">Candidate Cities:</dt>
			<dd id="candidateCitiesBody">
				<ul id="candidateCitiesList">
				  <li><a href="http://www.annecy2018.com/fr/">Annecy, France</a> <span class="winterIcon">2018</span></li>
          <li><a href="http://www.munich2018.org/">Munich, Germany</a> <span class="winterIcon">2018</span></li>
          <li><a href="http://www.pyeongchang2018.org/">PyeongChang, South Korea</a> <span class="winterIcon">2018</span></li>
			</dd>
		</dl>
	</div> 
	
	<div class="body-section-title" id="home">
	  <h3 class="clearfix"><span class="block float-left">Current News Newsletters</span><span class="block float-right"><a href="/news-events/newsletters/"></a></span></h3>
	</div>
	
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
	<img src="/news-events/articles/photos/<?=$news[$i]['thumb_photo']?>" width="90" alt="<?=intl_clean($news[$i]['title'],1,0)?>" class="" />
	<?php } else { ?>
	<img src="/news-events/articles/photos/ditc-thmb-default.jpg" width="90" alt="<?=intl_clean($news[$i]['title'],1,0)?>" class="" />
	<?php } ?>

	<?php
	# setting up title link - if at least one of the content fields is NOT blank (text_1, custom content, related docs, flickr gallery, etc.) 
	if($news[$i]['text_1'] != '' || $news[$i]['custom_content'] != 0 || $news[$i]['flickr_id'] != '' || $news[$i]['related_links'] != '' || $news[$i]['related_docs'] != 0) {
		# set the title to have a link, and "MORE" to be true
		$title_link = "<a href=\"/news-events/articles/article.php?id=".$news[$i]['id']."&amp;year=".date('Y', strtotime($news[$i]['start_date']))."\">".intl_clean($news[$i]['title'],0,1)."</a>";
		$more_link = 1;
		# else just display the title w/o a link
	} else {
		$title_link = intl_clean($news[$i]['title'],0,1); $more_link = 0;
	} ?>
	
	<h6><?=$title_link?></h6>
	<?php
	if($news[$i]['subtitle'] != '') { echo '<p class="bold">'.intl_clean($news[$i]['subtitle'],0,1).'</p>'; }
	/*if( $news[$i]['summary_text'] != '' ) {
		$summaryArray = explode(' ',strip_tags(intl_clean($news[$i]['summary_text'],0,1)));
		if( count($summaryArray) < 40 OR $more_link == 0 ) { $limit = count($summaryArray); } else { $limit = 40; }
		echo '<p>';
		for($s=0;$s<$limit;++$s) {
			echo $summaryArray[$s];
			if( $s != ($limit -1) ) { echo ' '; }
		}
		if( $more_link == 1 ) {
			if( $limit == 40 ) { echo '&hellip'; }
			echo '<br /><em><strong><a href="'.homepath.'news-events/articles/article.php?id='.$news[$i]['id'].'&amp;year='.date('Y', strtotime($news[$i]['start_date'])).'">More&nbsp;&rsaquo;&rsaquo;</a></strong></em>';
		}
		echo '</p>';
	}*/
	if(substr($news[$i]['summary_text'],0,2) != '<p' && $news[$i]['summary_text'] != '') {
		$news[$i]['summary_text'] = '<p>'.$news[$i]['summary_text'].'</p>';
	}
	echo '<p>';
	echo '<span class="bold">'.intl_clean($news[$i]['location'],0,1).'</span>';
	echo ' ('.date_result($news[$i]['start_date'],$news[$i]['end_date']).')';
	if($news[$i]['summary_text'] != '') { echo '<br />'.substr(intl_clean(substr($news[$i]['summary_text'],0,(strlen($news[$i]['summary_text'])-4)),0,1),3); }
	if($more_link > 0) { echo '<br /><a href="/news-events/articles/article.php?id='.$news[$i]['id'].'&amp;year='.date('Y', strtotime($news[$i]['start_date'])).'"><strong><em>MORE</em>&nbsp;&rsaquo;&rsaquo;</strong></a>'; }
	echo '</p>';
	?>
	
	</div>
	<?php } ?>
	
	<h5 class="italic align-right" style="clear: left; padding: 15px 0;"><a href="/news-events/">MORE NEWS &rsaquo;&rsaquo;</a></h5>
	
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
	<img src="/news-events/articles/photos/<?=$milestones[$randomMilestones[$i]]['thumb_photo']?>" width="90" alt="<?=intl_clean($milestones[$randomMilestones[$i]]['title'],1,0)?>" class="" />
	<?php } else { ?>
	<img src="/news-events/articles/photos/ditc-thmb-default.jpg" width="90" alt="<?=intl_clean($milestones[$randomMilestones[$i]]['title'],1,0)?>" class="" />
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
	/*if( $milestones[$randomMilestones[$i]]['summary_text'] != '' ) {
		$summaryArray = explode(' ',strip_tags(intl_clean($milestones[$randomMilestones[$i]]['summary_text'],0,1)));
		if( count($summaryArray) < 40 OR $more_link == 0 ) { $limit = count($summaryArray); } else { $limit = 40; }
		echo '<p>';
		for($s=0;$s<$limit;++$s) {
			echo $summaryArray[$s];
			if( $s != ($limit -1) ) { echo ' '; }
		}
		if( $more_link == 1 ) {
			if( $limit = 40 ) { echo '&hellip'; }
			echo '<br /><em><strong><a href="'.homepath.'news-events/articles/article.php?id='.$milestones[$randomMilestones[$i]]['id'].'&amp;year='.date('Y', strtotime($milestones[$randomMilestones[$i]]['start_date'])).'">More&nbsp;&rsaquo;&rsaquo;</a></strong></em>';
		}
		echo '</p>';
	}*/
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
	</div>
	<!-- END main body content -->
	
	
</div><!-- END content -->
<?php include(homepath."/inc/right-sidebar.inc") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php include(homepath."/inc/footer.inc") ?>
<?php include(homepath."/inc/ga.inc") ?>
</body>
</html>