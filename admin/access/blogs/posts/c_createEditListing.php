<h4 class="blue-text"><?=intl_clean($blog[0]['blog_title'],0,1)?></h4>

<p>Fill in the appropriate information below and click on the <strong>Preview</strong> button. Required fields are denoted with an asterisks (*).</p>

<!--<pre>
</pre>-->

<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">

<hr />

<!--<h5 class="uppercase blue-text">Title Information</h5>-->
<fieldset>
<p class="clearfix <?=$class[post_title]?>"><label for="post_title" class="bold uppercase">Blog Entry Title*:</label> <input name="post_title" id="post_title" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['post_title'],1,0)?>" /></p> 
<p class="clearfix <?=$class[user_id]?>"><label for="user_id" class="bold uppercase">Entry Author*:</label>
    <select name="user_id" id="user_id">
        <option value="">- Select a Name -</option>
        <?php for($i=0; $i<count($users); $i++) {
            echo '<option value="'.$users[$i]['id'].'" ';
            if($_SESSION['form']['user_id'] == $users[$i]['id']) { echo 'selected="selected" '; }
            echo '>'.intl_clean($users[$i]['fname'],0,0).' '.intl_clean($users[$i]['lname'],0,0).'</option>';
        }
        ?>
    </select>
</p>
<p class="clearfix formDirections"><label>&nbsp;</label><em>Format as MM/DD/YYYY</em></p>
<p class="clearfix <?=$class[post_day]?>"><label for="post_day" class="bold uppercase">Entry Date*:</label> <input name="post_day" id="post_day" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['post_day'],1,0)?>" /></p>
<p class="clearfix formDirections"><label>&nbsp;</label><em>Format as HH:MM AM/PM</em></p>
<p class="clearfix <?=$class[post_time]?>"><label for="post_time" class="bold uppercase">Entry Time*:</label> <input name="post_time" id="post_time" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['post_time'],1,0)?>" /></p> 
</fieldset>

<hr />

<fieldset>
<p class="clearfix <?=$class[post_content]?>"><label for="post_content" class="tinyMCE bold uppercase">Blog Entry Text*:</label> <textarea name="post_content" id="post_content" class="tinyMCE" rows="20"><?=stripslashes($_SESSION['form']['post_content'])?></textarea></p>
</fieldset>
<hr />

<fieldset>
<h6 class="<?=$class['assets']?>">Photographs</h6>
<p class="<?=$class['assets']?>">Add up to 10 photographs for this blog entry. <em>Files must be in JPEG (.jpg) format, and less than 1MB</em>.</p>

<?php
for($i=0; $i<10; $i++) {
	if($i == 0) { echo "<hr />\n"; }
	if($_SESSION['form']['assetsArray'][$i]['thumbnail'] != '') { 
		echo '<p class="align-center"><img src="/news-events/articles/photos/'.$_SESSION['form']['assetsArray'][$i]['thumbnail'].'" width="50" class="p-border" alt="" /></p>';
		echo '<p class="clearfix ';
		echo $class['photo'.$i].'">';
		echo '<label for="asset_'.$i.'_new" class="bold uppercase">Replace photo:</label>';
		echo '<input name="asset_'.$i.'_new" id="asset_'.$i.'_new" class="textfield" type="file" />';
		echo "</p>\n";
		echo "<p class=\"clearfix bold uppercase\">\n";
		echo '<label>&nbsp;</label><em>Or&hellip;</em> <input name="asset_'.$i.'_delete" id="asset_'.$i.'_delete" type="checkbox" class="checkfield" /> Remove this photo';
		echo "</p>\n";
		echo '<input name="asset_'.$i.'_file_old" id="asset_'.$i.'_file_old" type="hidden" value="'.$_SESSION['form']['assetsArray'][$i]['file'].'" />';
		echo '<input name="asset_'.$i.'_thumb_old" id="asset_'.$i.'_thumb_old" type="hidden" value="'.$_SESSION['form']['assetsArray'][$i]['thumbnail'].'" />';
	} else {
		echo '<p class="clearfix ';
		echo $class['photo'.$i].'">';
		echo '<label for="asset_'.$i.'_new" class="bold uppercase">Upload a photo:</label>';
		echo '<input name="asset_'.$i.'_new" id="asset_'.$i.'_new" class="textfield" type="file" />';
		echo "</p>\n"; 
	}
	echo '<p class="clearfix">';
	echo '<label for="asset_'.$i.'_caption" class="bold uppercase">Photo '.($i + 1).' Caption:</label>';
	echo '<textarea name="asset_'.$i.'_caption" id="asset_'.$i.'_caption" class="" rows="3">'.intl_clean($_SESSION['form']['assetsArray'][$i]['caption'],0,0).'</textarea>';
	echo "</p>\n";
	echo "<hr />\n";
} ?>
</fieldset>

<fieldset class="p-border gray-bkgd-fade align-center">
<input name="blogTitle" id="blogTitle" type="hidden" value="<?=intl_clean($blog[0]['blog_title'],0,1)?>">
<input name="submit" type="submit" value="Preview" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
</fieldset>

</form>

</div><!-- END #content -->

<div id="admin-sidebar">

<? if( $_SESSION['admin']['access_level'] > StandardAccess ) { ?>
<h5 class="left-arrow"><a href="index.php?bID=<?=$_REQUEST['bID']?>">Back to List of Entries</a></h5>
<?php } ?>

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>