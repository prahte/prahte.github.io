<p>Fill in the appropriate information below and click on the <strong>Save</strong> button. Required fields are denoted with an asterisks (*).</p>

<!--<pre>
<?=print_r($_SESSION['form'])?>
</pre>-->

<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">

<hr />

<!--<h5 class="uppercase blue-text">Title Information</h5>-->
<fieldset>
<p class="clearfix <?=$class[blog_title]?>"><label for="blog_title" class="bold">Blog Title*:</label> <input name="blog_title" id="blog_title" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['blog_title'],1,0)?>" /></p> 
<!--<p class="clearfix <?=$class[blog_short_title]?>">
	<label for="blog_short_title" class="bold">Blog Short Title*:</label> <input name="blog_short_title" id="blog_short_title" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['blog_short_title'],1,0)?>" />
	<br /><span class="clear-float italic">The Blog Short Title is the name of the directory where the blog will reside. It cannot contain any spaces or special characters.</span>
</p>-->
<p class="clearfix <?=$class[blog_desc]?>"><label for="blog_desc" class="bold">Blog Description:</label> <textarea name="blog_desc" id="blog_desc" class="" rows="10" ><?=intl_clean($_SESSION['form']['blog_desc'],0,0)?></textarea></p>
</fieldset>

<fieldset class="p-border gray-bkgd-fade align-center">
<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
</fieldset>

</form>

</div><!-- END #content -->

<div id="admin-sidebar">

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>