<p>Fill in the appropriate information below and click on the "Save" button at the bottom. Required fields are denoted with an asterisks (*).</p>

<!--<pre>
<?=print_r($_SESSION['form'])?>
</pre>-->
<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">


<h4 class="kerned uppercase trebuchet blue-text">Document Infomation</h4>
<fieldset>
<div class="pad5 t-border">
<!-- DOC NAME -->
<p  class="clearfix <?=$class[1]?>"><label for="doc_title" class="bold">Document Title*:</label><input name="doc_title" id="doc_title" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['doc_title'],1,0)?>" /></p> 
<?php if($_SESSION['form']['file'] != '') { ?>
<p  class="clearfix <?=$class[1]?>"><label for="filelink" class="bold">Current File:</label> <span class="bold <?=$_SESSION['form']['type']?>" id="filelink"><a href="/admin/access/assets/files/<?=$_SESSION['form']['file']?>"/><?=intl_clean($_SESSION['form']['doc_title'],1,0)?></a></span></p> 
<?php } ?>
<!-- FILE -->
<p>File must be in Microsoft Word (.doc), Microsoft Excel (.xls), Adobe PDF (.pdf), JPEG (.jpg), OR GIF (.gif) format, and less than 2 MB.</p>
<?php if($_SESSION['form']['file'] != '') { ?>
<p class="clearfix ">
<label for="fileNew" class="bold">Replace file:</label><input name="fileNew" id="fileNew" class="textfield" type="file" />
<input name="fileOld" id="fileOld" type="hidden" value="<?=$_SESSION['form']['file']?>" />
<input name="typeOld" id="typeOld" type="hidden" value="<?=$_SESSION['form']['type']?>" />
</p>
<?php } else { ?>
<p  class="clearfix <?=$class[2]?>"><label for="fileNew" class="bold">Upload a file:</label><input name="fileNew" id="fileNew" class="textfield" type="file" /></p> 
<?php } ?>
</div>
</fieldset>

<!-- AFFILIATIONS -->
<?php if($_SESSION['admin']['access_level'] > 1) { ?>
<h4 class="kerned uppercase trebuchet blue-text">Affiliations*</h4>
<p class="">Select the Affiliations with which this document will be associated.</p>
<fieldset>
<ul class="clearfix">
<?php
$affilQuery = "SELECT * FROM groups ORDER BY name ASC";
$affil = db_select(DITCDB, $affilQuery);
for($i=0; $i<count($affil); $i++) {
?>
<li class="pad2 float-left">
<p class="bold <?=$class[3]?>">
<input type="checkbox" name="affil_<?=$affil[$i]['id']?>" id="affil_<?=$affil[$i]['id']?>" value="<?=$affil[$i]['id']?>" class="checkfield" <?php if(isset($_SESSION['form']['affil_'.$affil[$i]['id']])) echo 'checked'; ?> />
<?=intl_clean($affil[$i]['name'],1,0)?>
</p>
</li>
<?php } ?>
</ul>
</fieldset>
<?php } else { ?>
<input type="hidden" name="affil_<?=$_REQUEST['gID']?>" id="affil_<?=$_REQUEST['gID']?>" value="<?=$_REQUEST['gID']?>" />
<?php } ?>

<fieldset class="p-border gray-bkgd-fade align-center">
<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
</fieldset>
</form>

</div><!-- END #content -->

<div id="admin-sidebar">



</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>