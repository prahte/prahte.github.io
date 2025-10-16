<p>Fill in the appropriate information below and click on the "Save" button at the bottom. Required fields are denoted with an asterisks (*).</p>

<!--<pre>
<?=print_r($_SESSION['form'])?>
</pre>-->
<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">

<!-- GENERAL INFO -->

<h4 class="kerned uppercase trebuchet blue-text">General Info</h4>
<fieldset>
<div class="pad5 t-border">
<p  class="clearfix <?=$class[1]?>"><label for="name" class="bold">Name*:</label><input name="name" id="name" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['name'],1,0)?>" /></p> 
<p  class="clearfix"><label for="description" class="bold">Description:</label><textarea id="description" name="description" rows="10"><?=stripslashes($_SESSION['form']['description'])?></textarea></p> 
<p  class="clearfix"><label for="address1" class="bold">Address:</label><input name="address1" id="address1" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['address1'],1,0)?>" /></p> 
<p  class="clearfix"><label for="address2" class="bold">&nbsp;</label><input name="address2" id="address2" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['address2'],1,0)?>" /></p> 
<p  class="clearfix"><label for="city" class="bold">City:</label><input name="city" id="city" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['city'])?>" /></p> 
<p  class="clearfix"><label for="state" class="bold">State/Province:</label><input name="state" id="state" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['state'])?>" /></p> 
<p  class="clearfix"><label for="zip" class="bold">Zip/Postal Code:</label><input name="zip" id="zip" class="textfield" type="text" value="<?=$_SESSION['form']['zip']?>" /></p> 
<p  class="clearfix"><label for="country" class="bold">Country:</label><input name="country" id="country" class="textfield" type="text" value="<?=$_SESSION['form']['country']?>" /></p> 
</div>
</fieldset>

<!-- LOGO -->

<h4 class="kerned uppercase trebuchet blue-text">Logo</h4>
<p class="italic">Logo file must be in JPEG (.jpg) OR GIF (.gif) format, and less than 150k.</p>
<fieldset>
<div class="pad5 t-border">
<?php if($_SESSION['form']['logo'] != '') { ?>
<p class="align-center">
<img src="<?=homepath?>admin/access/assets/logos/<?=$_SESSION['form']['logo']?>" width="50" class="pad2 t-border" />
</p>
<p class="clearfix <?=$class[7]?>">
<label for="logoNew" class="bold">Replace Logo:</label><input name="logoNew" id="logoNew" class="textfield" type="file" />
</p>
<p class="clearfix">
<label for="logoDelete" class="bold italic">OR&hellip;</label>
<input name="logoDelete" id="logoDelete" class="checkfield" type="checkbox" /> <strong>REMOVE</strong> this Logo.
<input type="hidden" name="logoOld" value="<?=$_SESSION['form']['logo']?>" />
</p> 
<?php } else { ?>
<p  class="clearfix <?=$class[7]?>"><label for="logoNew" class="bold">Upload a Logo:</label><input name="logoNew" id="logoNew" class="textfield" type="file" /></p> 
<?php } ?>
</div>
</fieldset>

<fieldset class="p-border gray-bkgd-fade align-center">
<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
</fieldset>
</form>

</div><!-- END #content -->

<div id="admin-sidebar">



</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>