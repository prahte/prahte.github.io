<p>Fill in the appropriate information below and click on the "Save" button at the bottom. Required fields are denoted with an asterisks (*).</p>

<!--<pre>
<?=print_r($_SESSION['form'])?>
</pre>-->
<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">

<!-- GENERAL INFO -->

<h4 class="kerned uppercase trebuchet blue-text">General Info</h4>
<fieldset>
<hr />
<p class="clearfix <?=$class[1]?>"><label for="fname" class="bold">First Name*:</label><input name="fname" id="fname" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['fname'],1,0)?>" /></p> 
<p class="clearfix"><label for="mname" class="bold">Middle Name/Initial:</label><input name="mname" id="mname" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['mname'],1,0)?>" /></p> 
<p class="clearfix <?=$class[2]?>"><label for="lname" class="bold">Last Name*:</label><input name="lname" id="lname" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['lname'],1,0)?>" /></p> 
<p class="clearfix"><label for="title" class="bold">Title(s):</label><textarea id="title" name="title" rows="3"><?=stripslashes($_SESSION['form']['title'])?></textarea></p> 
<p class="clearfix"><label for="address1" class="bold">Address:</label><input name="address1" id="address1" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['address1'],1,0)?>" /></p> 
<p class="clearfix"><label for="address2" class="bold">&nbsp;</label><input name="address2" id="address2" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['address2'],1,0)?>" /></p> 
<p class="clearfix"><label for="city" class="bold">City:</label><input name="city" id="city" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['city'])?>" /></p> 
<p class="clearfix"><label for="state" class="bold">State/Province:</label><input name="state" id="state" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['state'])?>" /></p> 
<p class="clearfix"><label for="zip" class="bold">Zip/Postal Code:</label><input name="zip" id="zip" class="textfield" type="text" value="<?=$_SESSION['form']['zip']?>" /></p> 
<p class="clearfix"><label for="country" class="bold">Country:</label><input name="country" id="country" class="textfield" type="text" value="<?=$_SESSION['form']['country']?>" /></p> 
<p class="clearfix"><label for="phone1" class="bold">Office Phone:</label><input name="phone1" id="phone1" class="textfield" type="text" value="<?=$_SESSION['form']['phone1']?>" /></p> 
<p class="clearfix"><label for="phone2" class="bold">Cell Phone:</label><input name="phone2" id="phone2" class="textfield" type="text" value="<?=$_SESSION['form']['phone2']?>" /></p>
<p class="clearfix <?=$class[4]?>"><label for="email" class="bold">E-mail*:</label><input name="email" id="email" class="textfield" type="text" value="<?=$_SESSION['form']['email']?>" /></p>
<hr />
</fieldset>

<!-- PHOTO -->

<h4 class="kerned uppercase trebuchet blue-text">Photo</h4>
<p class="italic">Photo file must be in JPEG (.jpg) OR GIF (.gif) format, and less than 150k.</p>
<fieldset>
<?php if($_SESSION['form']['photo'] != '') { ?>
<p class="align-center">
<img src="/admin/access/assets/photos/<?=$_SESSION['form']['photo']?>" width="50" class="pad2 gray-border" />
</p>
<p class="clearfix <?=$class[3]?>">
<label for="photoNew" class="bold">Replace Photo:</label><input name="photoNew" id="photoNew" class="textfield" type="file" />
</p>
<p class="clearfix">
<label for="photoDelete" class="bold italic">OR&hellip;</label>
<input name="photoDelete" id="photoDelete" class="checkfield" type="checkbox" /> <strong>REMOVE</strong> this photo.
<input type="hidden" name="photoOld" value="<?=$_SESSION['form']['photo']?>" />
</p> 
<?php } else { ?>
<p class="clearfix <?=$class[3]?>"><label for="photoNew" class="bold">Upload a photo:</label><input name="photoNew" id="photoNew" class="textfield" type="file" /></p> 
<?php } ?>
<hr />
</fieldset>

<fieldset class="p-border gray-bkgd-fade align-center">
<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
</fieldset>
</form>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>