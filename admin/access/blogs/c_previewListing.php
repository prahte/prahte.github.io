<p>Below is a preview of the summary, and full article. To save it as is, click the <strong>"Save"</strong> button. To make changes, click the <strong>"Go Back"</strong> button.</p>

<hr />

<div class="news-summary clearfix">

	<?php if($_SESSION['form']['thumb_photo'] != '') { ?>
	<img src="<?=homepath?>news-events/articles/photos/<?=$_SESSION['form']['thumb_photo']?>" width="90" alt="<?=$_SESSION['form']['title']?>" class="" />
	<?php } else { ?>
	<img src="<?=homepath?>news-events/articles/photos/ditc-thmb-default.jpg" width="90" height="90" alt="<?=$_SESSION['form']['title']?>" class="" />
	<?php } ?>

<?php
# setting up title link - if at least one of the content fields is NOT blank (text_1, custom content, related docs, flickr gallery, etc.) 
if($_SESSION['form']['text_1'] != '' || $_SESSION['form']['custom'] != '' || $_SESSION['form']['flickr_id'] != '' || $_SESSION['form']['related_links'] != '' || $_SESSION['form']['docs'] != '') {
	# set the title to have a link, and "MORE" to be true
	$title_link = "<a href=\"articles/article.php?id=".$_SESSION['form']['id']."\">".intl_clean($_SESSION['form']['title'],0,1)."</a>";
	$more_link = 1;
	# else just display the title w/o a link
} else {
 	$title_link = intl_clean($_SESSION['form']['title'],0,1); $more_link = 0;
} ?>

	<h6><?=$title_link?></h6>
	<?php
	if($_SESSION['form']['subtitle'] != '') { echo '<p><span class="bold">'.intl_clean($_SESSION['form']['subtitle'],0,1).'</span></p>'; }
	if(substr($_SESSION['form']['summary_text'],0,2) != '<p' && $_SESSION['form']['summary_text'] != '') {
		$_SESSION['form']['summary_text'] = '<p>'.$_SESSION['form']['summary_text'].'</p>';
	}
	echo '<p>';
	echo '<span class="bold">'.intl_clean($_SESSION['form']['location'],0,1).'</span>';
	echo ' ('.date_result($_SESSION['form']['start_date'],$_SESSION['form']['end_date']).')';
	if($_SESSION['form']['summary_text'] != '') { echo '<br />'.substr(intl_clean(substr($_SESSION['form']['summary_text'],0,(strlen($_SESSION['form']['summary_text'])-4)),0,1),3); }
	if($more_link > 0) { echo '<br /><a href="articles/article.php?id='.$_SESSION['form']['id'].'"><strong><em>MORE</em>&nbsp;&rsaquo;&rsaquo;</strong></a>'; }
	echo '</p>';
	?>

</div>

<hr class="clear-float"/>

<?php if($more_link > 0) { ?>

<h4 class="blue-text"><?=intl_clean($_SESSION['form']['title'],0,1)?></h4>

<?php if($_SESSION['form']['subtitle'] != '') { echo '<h5 class="blue-text">'.intl_clean($_SESSION['form']['subtitle'],0,1).'</h5>'; } ?>

<?php if($_SESSION['form']['photo_1'] != '') { ?>
<dl class="inline-imagecnt-right">
	<dt>
	<?php
	list($w, $h) = getimagesize(homepath."news-events/articles/photos/".$_SESSION['form']['photo_1']);
	if ($w != 175) { $width = 175; $height = round(($h * 175) / $w); } else { $width = $w; $height = $h; }
	?>
	<a href="<?=homepath?>news-events/articles/photos/<?=$_SESSION['form']['photo_1']?>" rel="lightbox"  title="<?=strip_tags(intl_clean($_SESSION['form']['caption_1'],1,0));?>">
	<img src="<?=homepath?>news-events/articles/photos/<?=$_SESSION['form']['photo_1']?>" width="<?=$width?>" height="<?=$height?>" class="p-border" alt="<?=strip_tags(intl_clean($_SESSION['form']['caption_1'],1,0));?>" />
	</a>
	</dt>
	<dd>
	<?php
	if(substr($_SESSION['form']['caption_1'],0,2) != '<p') {
		$_SESSION['form']['caption_1'] = '<p>'.$_SESSION['form']['caption_1'].'</p>';
	}
	echo intl_clean($_SESSION['form']['caption_1'],0,1);
	?>
	</dd>
</dl>
<?php } ?>
 
<p class="italic"><span class="bold"><?=intl_clean($_SESSION['form']['location'],0,1);?></span> (<?=date_result($_SESSION['form']['start_date'],$_SESSION['form']['end_date']);?>)</p>

<?php
if($_SESSION['form']['text_1'] != '') { 
	if(substr($_SESSION['form']['text_1'],0,2) != '<p' && substr($_SESSION['form']['text_1'],0,2) != '<h') {
		$_SESSION['form']['text_1'] = '<p>'.$_SESSION['form']['text_1'].'</p>';
	}
	echo intl_clean($_SESSION['form']['text_1'],0,1);
}
?>

<?php if($_SESSION['form']['text_2'] != '' || $_SESSION['form']['photo_2'] != '') { ?>

<?php if($_SESSION['form']['photo_2'] != '') { ?>
<dl class="inline-imagecnt-left">
	<dt>
	<?php
	list($w, $h) = getimagesize(homepath."news-events/articles/photos/".$_SESSION['form']['photo_2']);
	if ($w != 175) { $width = 175; $height = round(($h * 175) / $w); } else { $width = $w; $height = $h; }
	?>
	<a href="<?=homepath?>news-events/articles/photos/<?=$_SESSION['form']['photo_2']?>" rel="lightbox"  title="<?=strip_tags(intl_clean($_SESSION['form']['caption_2'],1,0));?>">
	<img src="<?=homepath?>news-events/articles/photos/<?=$_SESSION['form']['photo_2']?>" width="<?=$width?>" height="<?=$height?>" class="p-border" alt="<?=strip_tags(intl_clean($_SESSION['form']['caption_2'],1,0));?>" />
	</a>
	</dt>
	<dd>
	<?php
	if(substr($_SESSION['form']['caption_2'],0,2) != '<p') {
		$_SESSION['form']['caption_2'] = '<p>'.$_SESSION['form']['caption_2'].'</p>';
	}
	echo intl_clean($_SESSION['form']['caption_2'],0,1);
	?></dd>
</dl>
<?php } # END if photo 2 exists ?>
 
<?php
if($_SESSION['form']['text_2'] != '') {
	if(substr($_SESSION['form']['text_2'],0,2) != '<p' && substr($_SESSION['form']['text_2'],0,2) != '<h') {
		$_SESSION['form']['text_2'] = '<p>'.$_SESSION['form']['text_2'].'</p>';
	}
		echo intl_clean($_SESSION['form']['text_2'],0,1);
}
?>

<?php } # END if text 2/Photo2 exists ?>

<?php if($_SESSION['form']['custom'] != '') { echo intl_clean($_SESSION['form']['custom'],0,0); } ?>

<?php if($_SESSION['form']['docs'] != '') { ?>
	<h4 class="green-text clear-float uppercase">Related Documents</h4>
	<ul>
		<?php
		for($i=0; $i<count($_SESSION['form']['docs']); $i++) {
			echo '<li><p class="'.$_SESSION['form']['docs'][$i]['doc_type'].'"><a href="'.homepath.'news-events/articles/documents/'.$_SESSION['form']['docs'][$i]['doc_file'].'">'.intl_clean($_SESSION['form']['docs'][$i]['doc_title'],0,0).'</a></p></li>';
		}
		?>
	</ul>
<?php } ?>

<?php if($_SESSION['form']['related_links'] != '') { ?>
<h4 class="green-text clear-float uppercase">Related Links</h4>
<?php
if(substr($_SESSION['form']['related_links'],0,2) != '<p' && substr($_SESSION['form']['related_links'],0,2) != '<h') {
	$_SESSION['form']['related_links'] = '<p>'.$_SESSION['form']['related_links'].'</p>';
}
echo intl_clean($_SESSION['form']['related_links'],0,1);
} # END if related links exists ?>

<?php if($_SESSION['form']['flickr_id'] != '') { ?>
<h4 class="green-text clear-float uppercase">Additional Photographs</h4>

<p>Click on a thumbnail below to view a larger version in our <a href="http://www.flickr.com/photos/ditc"><strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong></a> photo gallery.</p>

<div id="flickr_badge_wrapper">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=10&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user_set&amp;user=12628849%40N00&amp;set=<?=$_SESSION['form']['flickr_id']?>&amp;context=in%2Fset-<?=$_SESSION['form']['flickr_id']?>%2F"></script>
</div>
<?php } # END if flickr gallery exists ?>

<hr class="clear-float" />

<?php
if( isset($_SESSION['form']['categories']) ) {
	echo '<h5 class="clear-float">Additional News Locations: ';
	for($i=0; $i<count($_SESSION['form']['categories']); $i++) {
		$categoryNameQuery = "SELECT cat_name FROM ditc_news_cats WHERE id = ".$_SESSION['form']['categories'][$i];
		$categoryName = db_select(DITCDB, $categoryNameQuery);
		echo intl_clean($categoryName[0]['cat_name'],0,0);
		if( $i < ( count($_SESSION['form']['categories'])-1 ) ) { echo ', '; }
	}
	echo "</h5>";
}
?>

<?php } # END if more_link > 0 ?>

<!--<pre>
<?=print_r($_SESSION);?>
</pre>-->

<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">
<fieldset class="p-border gray-bkgd-fade align-center clear-float">
<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Go Back" class="button" /> 
</fieldset>
</form>
	
</div><!-- END #content -->

<div id="admin-sidebar">



</div>