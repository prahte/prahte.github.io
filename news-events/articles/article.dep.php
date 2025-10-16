<?php
require_once("../../includes/global/constants.php");
require_once(homepath."includes/global/functions.php");

if($_REQUEST['id'] == '') { header("Location:../news-events/"); }

# get all info for the news item requested
$news_query = "SELECT * FROM ditc_news WHERE id = ".$_REQUEST['id'];
$news = db_select(DITCDB, $news_query);

# get related docs info if it exists
if($news[0]['related_docs'] > 0) {
$docs_query = "SELECT * FROM ditc_news_docs WHERE news_id = ".$_REQUEST['id'];
$docs = db_select(DITCDB, $docs_query); }

# get custom content if it exists
if($news[0]['custom_content'] > 0) {
$custom_query = "SELECT * FROM ditc_news_custom WHERE news_id = ".$_REQUEST['id'];
$custom = db_select(DITCDB, $custom_query); }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Dekalb International Training Center - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - News &amp; Events - <?=strip_tags(intl_clean($news[0]['title'],0,1));?></title>
 
<?php require(constant('homepath')."includes/modules/head.php") ?>
<style type="text/css">
	/* Flickr specific styles */
	#flickr_badge_wrapper { padding: 0; float: left; margin: 0 0 10px 0; }
	.flickr_badge_image { margin: 0 12px 12px 0; float: left; padding: 5px; border: 1px solid #666; background-color: #fff; }
	.flickr_badge_image img { border: 1px solid #000; }
	#flickr_badge_source { text-align:left; margin:0 10px 0 10px; }
	#flickr_badge_icon {float:left; margin-right:5px;}
	#flickr_badge_source { padding:0 !important; font: 51px Arial, Helvetica, Sans serif !important; color:#666666 !important; }
</style>

</head>

<body>

<div id="main-container">

<?php require(homepath."includes/modules/masthead.php") ?>

<?php require(homepath."includes/modules/top-nav.php") ?>

<div id="body-container">

<?php require(homepath."includes/modules/left-nav.php") ?>

<div id="content">
	<div class="body-header">
		<img src="<?=homepath?>images/headerIMG-news-events.jpg" width="500" height="153" border="0" alt="News &amp; Events" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title"><h3><a href="<?=homepath?>news-events/index.php">NEWS &amp; EVENTS</a> | 
	<?php if(date('Y', strtotime($news[0]['start_date'])) < date('Y')) { ?>
	<a href="<?=homepath?>news-events/archive.php?year=<?=date('Y', strtotime($news[0]['start_date']))?>">NEWS &amp; EVENTS ARCHIVE</a></h3>
	<?php ; } else { ?>
	<a href="<?=homepath?>news-events/archive.php">NEWS &amp; EVENTS ARCHIVE</a></h3>
	<?php ; } ?>
	</div>
	
	<div class="pad15"><!-- START main body content -->
	
	<h4 class="blue-text"><?=intl_clean($news[0]['title'],0,1)?></h4>
	
	<?php if($news[0]['subtitle'] != '') { ?><h5 class="blue-text"><?=intl_clean($news[0]['subtitle'],0,1)?></h5><?php ; } ?>
	
	<?php if($news[0]['photo_1'] != '') { ?>
	<dl class="inline-imagecnt-right">
	<dt>
	<?php
	list($w, $h) = getimagesize(homepath."news-events/articles/photos/".$news[0]['photo_1']);
	if ($w != 175) { $width = 175; $height = round(($h * 175) / $w); } else { $width = $w; $height = $h; }
	?>
	<a href="<?=homepath?>news-events/articles/photos/<?=$news[0]['photo_1']?>" rel="lightbox"  title="<?=strip_tags(intl_clean($news[0]['caption_1'],1,0));?>">
	<img src="<?=homepath?>news-events/articles/photos/<?=$news[0]['photo_1']?>" width="<?=$width?>" height="<?=$height?>" class="p-border" alt="<?=strip_tags(intl_clean($news[0]['caption_1'],1,0));?>" />
	</a>
	</dt>
	<dd><?=intl_clean($news[0]['caption_1'],0,1)?></dd>
	</dl>
	 <?php ; } ?>
	 
	<p><span class="bold"><?=intl_clean($news[0]['location'],0,1);?></span> 
		<?php if($news[0]['end_date'] != '') { ?>
			<?php
			if(date('m y', strtotime($news[0]['start_date'])) == date('m y', strtotime($news[0]['end_date']))) {
			$displaydate = date('F j', strtotime($news[0]['start_date']))."-".date('j, Y', strtotime($news[0]['end_date'])); }
			else { $displaydate = date('F j, Y', strtotime($news[0]['start_date']))." - ".date('F j, Y', strtotime($news[0]['end_date'])); } }
		else { $displaydate = date('F j, Y', strtotime($news[0]['start_date'])); }
		?>
		(<?=$displaydate?>) <?php if($news[0]['text_1'] != '') { ?>&mdash; <?=intl_clean($news[0]['text_1'],0,1)?><?php ; } ?>
	</p>
	
	<?php if($news[0]['custom_content'] > 0) { ?>
	<?=intl_clean($custom[0]['content'],0,0);?>
	<?php ; } ?>
	
	<?php if($news[0]['text_2'] != '' || $news[0]['photo_2'] != '') { ?>
	<?php if($news[0]['photo_2'] != '') { ?>
	<dl class="inline-imagecnt-left">
	<dt>
	<?php
	list($w, $h) = getimagesize(homepath."news-events/articles/photos/".$news[0]['photo_2']);
	if ($w != 175) { $width = 175; $height = round(($h * 175) / $w); } else { $width = $w; $height = $h; }
	?>
	<a href="<?=homepath?>news-events/articles/photos/<?=$news[0]['photo_2']?>" rel="lightbox"  title="<?=strip_tags(intl_clean($news[0]['caption_2'],1,0));?>">
	<img src="<?=homepath?>news-events/articles/photos/<?=$news[0]['photo_2']?>" width="<?=$width?>" height="<?=$height?>" class="p-border" alt="<?=strip_tags(intl_clean($news[0]['caption_2'],1,0));?>" />
	</a>
	</dt>
	<dd><?=intl_clean($news[0]['caption_2'],0,1)?></dd>
	</dl>
	 <?php ; } # END if photo 2 exists ?>
	 
	 <?php if($news[0]['text_2'] != '') { ?>
	<p><?=intl_clean($news[0]['text_2'],0,1)?></p>
	<?php } # END if text 2 exists?>
	
	<?php ; } # END if text 2/Photo2 exists ?>
	
	<?php if($news[0]['related_docs'] > 0) { ?>
		<h4 class="green-text clear-float">RELATED DOCUMENTS</h4>
		<ul>
		<?php for ($i=0; $i<count($docs); $i++) { 
		$filesize = round((filesize("documents/".$docs[$i]['doc_file'])) / 1000);
		?>
		<li><p class="pdf"><a href="documents/<?=$docs[$i]['doc_file']?>"><?=$docs[$i]['doc_title']?></a> (<?=$filesize?>k PDF)</p></li>
		<?php ; } ?>
		</ul>
	<?php ; } # END if related links exists ?>
	
	<?php if($news[0]['related_links'] != '') { ?>
	<h4 class="green-text clear-float">RELATED LINKS</h4>
	<p><?=intl_clean($news[0]['related_links'],0,1)?></p>
	<?php ; } # END if related links exists ?>
	
	<?php if($news[0]['flickr_id'] != '') { ?>
	<h4 class="green-text clear-float">ADDITIONAL PHOTOGRAPHS</h4>
	
	<p>Click on a thumbnail below to view a larger version in our <a href="http://www.flickr.com/photos/ditc"><strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong></a> photo gallery.</p>
	
	<div id="flickr_badge_wrapper">
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=10&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user_set&amp;user=12628849%40N00&amp;set=<?=$news[0]['flickr_id']?>&amp;context=in%2Fset-<?=$news[0]['flickr_id']?>%2F"></script>
	</div>
	<?php ; } # END if flickr gallery exists ?>
	
	<?php # Custom Hack for 2007 Prep Classic news id (45). Pulls in the gallery table build script for displaying photos from /news-events/articles/photos/DekalbClassic07Photos
	if($_REQUEST['id'] == 45) { include("scripts/classic07photos.php"); }
	?>
	
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