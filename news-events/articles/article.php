<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

if( $_REQUEST['id'] == '' || !isset($_REQUEST['id']) ) { header("Location:../news-events/"); }

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

<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games ::</title>
 
<?php include(homepath."/inc/head.inc") ?>
<style type="text/css">
	/* Flickr specific styles */
	#flickr_badge_wrapper { padding: 0; float: left; margin: 0 0 10px 0; }
	.flickr_badge_image { margin: 0 12px 12px 0; float: left; padding: 5px; border: 1px solid #666; background-color: #fff; }
	.flickr_badge_image img { border: 1px solid #000; }
	#flickr_badge_source { text-align:left; margin:0 10px 0 10px; }
	#flickr_badge_icon {float:left; margin-right:5px;}
	#flickr_badge_source { padding:0 !important; font: 51px Arial, Helvetica, Sans serif !important; color:#666666 !important; }
</style>
<link rel="stylesheet" href="/css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.lightbox.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".lightbox").lightbox();
});
</script>
</head>

<body>

<div id="main-container">

<?php require(homepath."/inc/masthead.inc") ?>

<?php require(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php require(homepath."/inc/left-nav.php") ?>

<div id="content">
	<div class="body-header">
		<img src="/images/headerIMG-news-events.jpg?v=2" width="500" height="153" border="0" alt="News &amp; Events" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title">
	<h3>
	<?php
	echo '<a href="/news-events/index.php';
	if( isset($_REQUEST['year']) ) {  echo'?year='.$_REQUEST['year']; }
	echo '">News Archive</a>';
	?>
	</h3>
	</div>
	
	<div class="pad15"><!-- START main body content -->
	
	<h4 class="blue-text"><?=intl_clean($news[0]['title'],0,1)?></h4>

	<?php if($news[0]['subtitle'] != '') { echo '<h5 class="blue-text">'.intl_clean($news[0]['subtitle'],0,1).'</h5>'; } ?>
	
	<?php if($news[0]['photo_1'] != '') { ?>
	<dl class="inline-imagecnt-right">
		<dt>
		<?php
		list($w, $h) = getimagesize(homepath."/news-events/articles/photos/".$news[0]['photo_1']);
		if ($w != 175) { $width = 175; $height = round(($h * 175) / $w); } else { $width = $w; $height = $h; }
		?>
		<a href="/news-events/articles/photos/<?=$news[0]['photo_1']?>" class="lightbox"  title="<?=strip_tags(intl_clean($news[0]['caption_1'],1,0));?>">
		<img src="/news-events/articles/photos/<?=$news[0]['photo_1']?>" width="<?=$width?>" height="<?=$height?>" class="p-border" alt="<?=strip_tags(intl_clean($news[0]['caption_1'],1,0));?>" />
		</a>
		</dt>
		<dd>
		<?php
		if(substr($news[0]['caption_1'],0,2) != '<p') {
			$news[0]['caption_1'] = '<p>'.$news[0]['caption_1'].'</p>';
		}
		echo intl_clean($news[0]['caption_1'],0,1);
		?>
		</dd>
	</dl>
	<?php } ?>
	 
	<p class="italic"><span class="bold"><?=intl_clean($news[0]['location'],0,1);?></span> (<?=date_result($news[0]['start_date'],$news[0]['end_date']);?>)</p>
	
	<?php
	if($news[0]['text_1'] != '') { 
		if(substr($news[0]['text_1'],0,2) != '<p' && substr($news[0]['text_1'],0,2) != '<h') {
			$news[0]['text_1'] = '<p>'.$news[0]['text_1'].'</p>';
		}
		echo intl_clean($news[0]['text_1'],0,1);
	}
	?>
		
	<?php if($news[0]['text_2'] != '' || $news[0]['photo_2'] != '') { ?>
	
	<?php if($news[0]['photo_2'] != '') { ?>
	<dl class="inline-imagecnt-left">
		<dt>
		<?php
		list($w, $h) = getimagesize(homepath."/news-events/articles/photos/".$news[0]['photo_2']);
		if ($w != 175) { $width = 175; $height = round(($h * 175) / $w); } else { $width = $w; $height = $h; }
		?>
		<a href="/news-events/articles/photos/<?=$news[0]['photo_2']?>" class="lightbox"  title="<?=strip_tags(intl_clean($news[0]['caption_2'],1,0));?>">
		<img src="/news-events/articles/photos/<?=$news[0]['photo_2']?>" width="<?=$width?>" height="<?=$height?>" class="p-border" alt="<?=strip_tags(intl_clean($news[0]['caption_2'],1,0));?>" />
		</a>
		</dt>
		<dd>
		<?php
		if(substr($news[0]['caption_2'],0,2) != '<p') {
			$news[0]['caption_2'] = '<p>'.$news[0]['caption_2'].'</p>';
		}
		echo intl_clean($news[0]['caption_2'],0,1);
		?></dd>
	</dl>
	<?php } # END if photo 2 exists ?>
	 
	<?php
	if($news[0]['text_2'] != '') {
		if(substr($news[0]['text_2'],0,2) != '<p' && substr($news[0]['text_2'],0,2) != '<h') {
			$news[0]['text_2'] = '<p>'.$news[0]['text_2'].'</p>';
		}
			echo intl_clean($news[0]['text_2'],0,1);
	}
	?>
	
	<?php } # END if text 2/Photo2 exists ?>
	
	<?php if($news[0]['custom_content'] != 0) { echo intl_clean($custom[0]['content'],0,0); } ?>
	
	<?php if($news[0]['custom_include'] != '') { include('scripts/'.$news[0]['custom_include']); } ?>
	
	<?php if($news[0]['related_docs'] != 0) { ?>
		<h4 class="green-text clear-float uppercase">Related Documents</h4>
		<ul>
			<?php
			for($i=0; $i<count($docs); $i++) {
				echo '<li><p class="'.$docs[$i]['doc_type'].'"><a href="/news-events/articles/documents/'.$docs[$i]['doc_file'].'">'.intl_clean($docs[$i]['doc_title'],0,0).'</a></p></li>';
			}
			?>
		</ul>
	<?php } ?>
	
	<?php if($news[0]['related_links'] != '') { ?>
	<h4 class="green-text clear-float uppercase">Related Links</h4>
	<?php
	if(substr($news[0]['related_links'],0,2) != '<p' && substr($news[0]['related_links'],0,2) != '<h') {
		$news[0]['related_links'] = '<p>'.$news[0]['related_links'].'</p>';
	}
	echo intl_clean($news[0]['related_links'],0,1);
	} # END if related links exists ?>
	
	<?php if($news[0]['flickr_id'] != '') { ?>
	<h4 class="green-text clear-float uppercase">Additional Photographs</h4>
	
	<p>Click on a thumbnail below to view a larger version in our <a href="http://www.flickr.com/photos/ditc"><strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong></a> photo gallery.</p>
	
	<div id="flickr_badge_wrapper">
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=10&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user_set&amp;user=12628849%40N00&amp;set=<?=$news[0]['flickr_id']?>&amp;context=in%2Fset-<?=$news[0]['flickr_id']?>%2F"></script>
	</div>
	<?php } # END if flickr gallery exists ?>
	
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php require(homepath."/inc/right-sidebar.inc") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php require(homepath."/inc/footer.inc") ?>
<?php require(homepath."/inc/ga.inc") ?>
</body>
</html>