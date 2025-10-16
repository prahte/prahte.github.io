<p>Fill in the appropriate information below and click on the "Preview" button to preview the news item. Required fields are denoted with an asterisks (*).</p>

<!--<pre>
<?=print_r($_SESSION['form'])?>
</pre>-->
<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">


<hr />

<h5 class="uppercase blue-text">Title Information</h5>
<fieldset>
<p class="clearfix <?=$class[title]?>"><label for="title" class="bold">Main Title*:</label> <input name="title" id="title" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['title'],1,0)?>" /></p> 
<p class="clearfix"><label for="title" class="bold">Sub-title:</label> <input name="subtitle" id="subtitle" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['subtitle'],1,0)?>" /></p>
<p class="clearfix <?=$class[location]?>"><label for="location" class="bold">Location*:</label> <input name="location" id="location" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['location'],1,0)?>" /></p>
<p class="clearfix bold"><label for="start_date">&nbsp;</label> <em>All dates must be formatted as "mm/dd/yyyy".</em></p>
<p class="clearfix <?=$class[start_date]?>"><label for="start_date" class="bold">Start Date*:</label> <input name="start_date" id="start_date" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['start_date'],1,0)?>" /></p>
<p class="clearfix <?=$class[end_date]?>"><label for="end_date" class="bold">End Date:</label> <input name="end_date" id="end_date" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['end_date'],1,0)?>" /></p>
<p class="clearfix"><label for="milestone" class="bold">Include as a DITC Milestone?:</label>
	<input name="milestone" id="milestoneYes" class="checkfield" type="radio" value="1" <? if($_SESSION['form']['milestone'] == 1) echo 'checked'; ?>> <strong>Yes</strong>
	<input name="milestone" id="milestoneYes" class="checkfield" type="radio" value="0" <? if($_SESSION['form']['milestone'] == 0) echo 'checked'; ?>> <strong>No</strong>
</p>
</fieldset>

<hr />

<!-- THUMBNAIL PHOTO/INTRO SUMMARY -->
<h5 class="uppercase blue-text">Summary Intro Text &amp; Thumbnail Photo</h5>
<fieldset>
	<p class="clearfix <?=$class[summary_text]?>">
		<label for="summary_text" class="tinyMCE bold uppercase">Summary Intro Text:</label>
		<textarea name="summary_text" id="summary_text" class="tinyMCE" rows="10" ><?=intl_clean($_SESSION['form']['summary_text'],0,0)?></textarea>
	</p>
	<p>Thumbnail photo must be in JPEG (.jpg), OR GIF (.gif) format, and less than 150k.<br />
	<strong>Note:</strong> If no thumbnail photo is uploaded, the default DITC logo thumbnail will be displayed.</p>
	<?php if($_SESSION['form']['thumb_photo'] != '') { ?>
	<img src="/news-events/articles/photos/<?=$_SESSION['form']['thumb_photo']?>" width="90" class="p-border float-left" alt="" />
	<p class="<?=$class[thumb_photo]?>">
		<label for="thumb_photoNew" class="tinyMCE bold uppercase">Replace photo:</label>
		<input name="thumb_photoNew" id="thumb_photoNew" class="textfield" type="file" />
	</p>
	<p class="bold uppercase">
		<em>Or&hellip;</em> <input name="thumb_photoDelete" id="thumb_photoDelete" type="checkbox" class="checkfield" /> Remove this photo.
	</p>
	<input name="thumb_photoOld" id="thumb_photoOld" type="hidden" value="<?=$_SESSION['form']['thumb_photo']?>" />
	<?php } else { ?>
	<p  class="<?=$class[thumb_photo]?>">
		<label for="thumb_photoNew" class="tinyMCE bold uppercase">Upload a photo:</label> 
		<input name="thumb_photoNew" id="thumb_photoNew" class="textfield" type="file" />
	</p> 
	<?php } ?>
</fieldset>

<hr class="clear-float" />

<!-- TEXT AREA/PHOTO 1-->
<h5 class="uppercase blue-text">Leading Text &amp; Photo 1</h5>
<fieldset>
	<p  class="clearfix">
		<label for="text_1" class="tinyMCE bold uppercase">Leading Text:</label>
		<textarea name="text_1" id="text_1" class="tinyMCE" rows="20" ><?=intl_clean($_SESSION['form']['text_1'],0,0)?></textarea>
	</p>
	<p>Photo 1 must be in <strong>JPEG (.jpg)</strong>, or <strong>GIF (.gif) format</strong>, and less than <strong>150k</strong>.</p>
	<?php if($_SESSION['form']['photo_1'] != '') { ?>
	<img src="/news-events/articles/photos/<?=$_SESSION['form']['photo_1']?>" width="90" class="p-border float-left" alt="" />
	<p class="<?=$class[photo_1]?>">
		<label for="photo_1New" class="tinyMCE bold uppercase">Replace photo:</label>
		<input name="photo_1New" id="photo_1New" class="textfield" type="file" />
	</p>
	<p class="clearfix bold uppercase">
		<em>Or&hellip;</em> <input name="photo_1Delete" id="photo_1Delete" type="checkbox" class="checkfield" /> Remove this photo.
	</p>
	<input name="photo_1Old" id="photo_1Old" type="hidden" value="<?=$_SESSION['form']['photo_1']?>" />
	<?php } else { ?>
	<p  class="clearfix <?=$class[photo_1]?>">
		<label for="photo_1New" class="tinyMCE bold uppercase">Upload a photo:</label>
		<input name="photo_1New" id="photo_1New" class="textfield" type="file" />
	</p> 
	<?php } ?>
	<p  class="clearfix">
		<label for="caption_1" class="tinyMCE bold uppercase">Photo 1 Caption:</label>
		<textarea name="caption_1" id="caption_1" class="tinyMCE" rows="5"><?=intl_clean($_SESSION['form']['caption_1'],0,0)?></textarea>
	</p>
</fieldset>

<hr />

<!-- TEXT AREA/PHOTO 2-->
<h5 class="uppercase blue-text">Secondary Text &amp; Photo 2</h5>
<fieldset>
	<p  class="clearfix">
		<label for="text_2" class="tinyMCE bold uppercase">Secondary Text:</label>
		<textarea name="text_2" id="text_2" class="tinyMCE" rows="20" ><?=intl_clean($_SESSION['form']['text_2'],0,0)?></textarea>
	</p>
	<p>Photo 2 must be in <strong>JPEG (.jpg)</strong>, or <strong>GIF (.gif) format</strong>, and less than <strong>150k</strong>.</p>
	<?php if($_SESSION['form']['photo_2'] != '') { ?>
	<img src="/news-events/articles/photos/<?=$_SESSION['form']['photo_2']?>" width="90" class="p-border float-left" alt="" />
	<p class="<?=$class[photo_2]?>">
		<label for="photo_2New" class="tinyMCE bold uppercase">Replace photo:</label>
		<input name="photo_2New" id="photo_2New" class="textfield" type="file" />
	</p>
	<p class="clearfix bold uppercase">
		<em>Or&hellip;</em> <input name="photo_2Delete" id="photo_2Delete" type="checkbox" class="checkfield" /> Remove this photo.
	</p>
	<input name="photo_2Old" id="photo_2Old" type="hidden" value="<?=$_SESSION['form']['photo_2']?>" />
	<?php } else { ?>
	<p  class="clearfix <?=$class[photo_2]?>">
		<label for="photo_2New" class="tinyMCE bold uppercase">Upload a photo:</label>
		<input name="photo_2New" id="photo_2New" class="textfield" type="file" />
	</p> 
	<?php } ?>
	<p  class="clearfix">
		<label for="caption_2" class="tinyMCE bold uppercase">Photo 2 Caption:</label>
		<textarea name="caption_2" id="caption_2" class="tinyMCE" rows="5"><?=intl_clean($_SESSION['form']['caption_2'],0,0)?></textarea>
	</p>
</fieldset>

<hr class="clear-float" />

<!-- RELATED DOCS -->
<h5 class="uppercase blue-text <?=$class[8]?>">Related Documents</h5>
<p>Related documents must be in <strong>.pdf</strong> or <strong>.doc</strong> format.</p>
<fieldset>
	<?php if( isset($_SESSION['form']['docs']) ) { 
	echo "<ul class=\"divided-list\">\n";
	for($i=0; $i<count($_SESSION['form']['docs']); $i++) { ?>
		<li>
			<p class="clearfix"><label class="bold">Document <?=(($i)+1)?>:</label><a href="/news-events/articles/documents/<?=$_SESSION['form']['docs'][$i]['doc_file']?>" class="<?=$_SESSION['form']['docs'][$i]['doc_type']?>"><?=$_SESSION['form']['docs'][$i]['doc_file']?></a></p>
			<p class="clearfix <?=$class['doc_title_'.$i]?>"><label for="doc_title_<?=$i?>" class="bold">Title:</label><input name="doc_title_<?=$i?>" id="doc_title_<?=$i?>" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['docs'][$i]['doc_title'],1,0)?>" /></p>
			<p class="clearfix <?=$class['doc_file_'.$i.'_New']?>"><label for="doc_file_<?=$i?>_New" class="bold">New File:</label><input name="doc_file_<?=$i?>_New" id="doc_file_<?=$i?>_New" class="textfield" type="file" /></p>
			<p class="clearfix bold"><label><em>OR&hellip;</em></label><input name="doc_file_<?=$i?>_Delete" id="doc_file_<?=$i?>_Delete" type="checkbox" class="checkfield" /> Delete this document.</p>
			<input name="doc_file_<?=$i?>_Old" id="doc_file_<?=$i?>_Old" type="hidden" value="<?=$_SESSION['form']['docs'][$i]['doc_file']?>" />
			<input name="doc_type_<?=$i?>_Old" id="doc_type_<?=$i?>_Old" type="hidden" value="<?=$_SESSION['form']['docs'][$i]['doc_type']?>" />
		</li>
	<?php } ?>
		<li>
			<p class="clearfix bold italic"><label>&nbsp;</label>Add another document:</p>
			<p class="clearfix <?=$class['doc_title_'.$i]?>"><label for="doc_title_<?=$i?>" class="bold">Document Title:</label><input name="doc_title_<?=$i?>" id="doc_title_<?=$i?>" class="textfield" type="text" /></p>
			<p class="clearfix <?=$class['doc_file_'.$i.'_New']?>"><label for="doc_file_<?=$i?>_New" class="bold">Document File:</label><input name="doc_file_<?=$i?>_New" id="doc_file_<?=$i?>_New" class="textfield" type="file" /></p>
		</li>
	</ul>
	<input name="doc_count" id="doc_count" type="hidden" value="<?=((count($_SESSION['form']['docs']))+1)?>" />
	<?php } else { 
	echo "<ul class=\"divided-list\">\n";
	for($i=0; $i<3; $i++) { ?>
		<li>
		<p class="clearfix <?=$class['doc_title_'.$i]?>"><label for="doc_title_<?=$i?>" class="bold">Document <?=(($i)+1)?> Title:</label><input name="doc_title_<?=$i?>" id="doc_title_<?=$i?>" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['doc_title_'.$i],1,0)?>" /></p>
		<p class="clearfix <?=$class['doc_file_'.$i.'_New']?>"><label for="doc_file_<?=$i?>_New" class="bold">Document <?=(($i)+1)?> File:</label><input name="doc_file_<?=$i?>_New" id="doc_file_<?=$i?>_New" class="textfield" type="file" /></p>
		</li>
	<?php } ?>
	</ul>
	<input name="doc_count" id="doc_count" type="hidden" value="3" />
	<?php } ?>
</fieldset>

<hr />

<!-- RELATED DOCS -->
<h5 class="uppercase blue-text">Related Links</h5>
<fieldset>
	<p  class="clearfix">
		<label for="related_links" class="tinyMCE bold uppercase">Related Links:</label>
		<textarea name="related_links" id="related_links" class="tinyMCE" rows="10" ><?=intl_clean($_SESSION['form']['related_links'],0,0)?></textarea>
	</p>
</fieldset>

<hr />

<!-- NEWS CATEGORIES -->
<?php
# get all categories
$categoriesQuery = "SELECT * FROM ditc_news_cats ORDER BY cat_name ASC";
$categories = db_select(DITCDB, $categoriesQuery);
?>
<h5 class="uppercase blue-text">News Locations</h5>
<p class="italic">All news entered will be displayed on the DITC home page and news archive. Select a location below if you would like this news item to also appear in that location.</p>
<fieldset>
	<ul class="clearfix">
	<?php
	for($i=0; $i<count($categories); $i++) {
		echo '<li class="float-left pad5"><p class="bold"><input type="checkbox" name="categories[]" class="checkfield" value="'.$categories[$i]['id'].'"';
		if( in_array($categories[$i]['id'], $_SESSION['form']['categories']) ) { echo ' checked="checked"'; }
		echo ' /> '.intl_clean($categories[$i]['cat_name'],0,0)."</p></li>\n";
	}
	?>
	</ul>
</fieldset>

<hr />

<!-- ADVANCED CONTENT -->
<h5 class="uppercase blue-text">Advanced Options</h5>
<fieldset>
	<p  class="clearfix">
		<label for="flickr_id" class="tinyMCE bold"><strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong> Photo Gallery Number:</label>
		<input name="flickr_id" id="flickr_id" class="textfield" type="text" value="<?=$_SESSION['form']['flickr_id']?>" />
	</p>
	<p  class="clearfix">
		<label for="custom" class="tinyMCE bold">Custom Code:</label>
		<textarea name="custom" id="custom" class="tinyMCE customCode" rows="20" ><?=stripslashes($_SESSION['form']['custom'])?></textarea>
	</p>
</fieldset>

<fieldset class="p-border gray-bkgd-fade align-center">
<input name="submit" type="submit" value="Preview" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
</fieldset>
</form>

</div><!-- END #content -->

<div id="admin-sidebar">



</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>