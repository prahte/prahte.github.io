<p>Enter your reply to the comment below and click the <strong>Save</strong> button.</p>

<h5>Comment: <span class="italic">"<?=intl_clean($comment[0]['comment'],0,1)?>"</span></h5>

<!--<pre>
<?=print_r($_SESSION['form'])?>
</pre>-->
<hr />

<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">

<fieldset>
<p class="clearfix <?=$class[comment]?>"><label for="post_content" class="bold uppercase"><?=$processText?>*:</label> <textarea name="comment" id="comment" class="" rows="10"><?=stripslashes($_SESSION['form']['comment'])?></textarea></p>
<input name="blog_id" id="blog_id" type="hidden" value="<?=$post[0]['blog_id']?>" />
<input name="post_id" id="post_id" type="hidden" value="<?=$post[0]['id']?>" />
<input name="comment_date" id="comment_date" type="hidden" value="<?=$comment[0]['comment_date']?>" />
<input name="org_id" id="org_id" type="hidden" value="<?=$comment[0]['id']?>" />
<input name="name" id="name" type="hidden" value="<?=$user[0]['fname']?> <?=$user[0]['lname']?>" />
<input name="email" id="email" type="hidden" value="<?=$user[0]['email']?>" />
<input name="user_id" id="user_id" type="hidden" value="<?=$user[0]['id']?>" />
</fieldset>

<fieldset class="p-border gray-bkgd-fade align-center">
<?php if($processType) { ?>
<input name="submit" type="submit" value="Save Edits" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
<?php } else { ?>
<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
<?php } ?>
</fieldset>

</form>

</div><!-- END #content -->

<div id="admin-sidebar">

</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>