<p>Fill in the appropriate information below and click on the "Save" button at the bottom. Required fields are denoted with an asterisks (*).</p>

<!--<pre>
<?=print_r($_SESSION['form'])?>
</pre>-->
<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">

<!-- GENERAL INFO -->

<h4 class="kerned uppercase trebuchet blue-text">General Info</h4>
<fieldset>
<div class="pad5 t-border">
<p  class="clearfix <?=$class[1]?>"><label for="fname" class="bold">First Name*:</label><input name="fname" id="fname" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['fname'],1,0)?>" /></p> 
<p  class="clearfix"><label for="mname" class="bold">Middle Name/Initial:</label><input name="mname" id="mname" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['mname'],1,0)?>" /></p> 
<p  class="clearfix <?=$class[2]?>"><label for="lname" class="bold">Last Name*:</label><input name="lname" id="lname" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['lname'],1,0)?>" /></p> 
<p  class="clearfix"><label for="title" class="bold">Title(s):</label><textarea id="title" name="title" rows="3"><?=stripslashes($_SESSION['form']['title'])?></textarea></p> 
<p  class="clearfix"><label for="address1" class="bold">Address:</label><input name="address1" id="address1" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['address1'],1,0)?>" /></p> 
<p  class="clearfix"><label for="address2" class="bold">&nbsp;</label><input name="address2" id="address2" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['address2'],1,0)?>" /></p> 
<p  class="clearfix"><label for="city" class="bold">City:</label><input name="city" id="city" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['city'])?>" /></p> 
<p  class="clearfix"><label for="state" class="bold">State/Province:</label><input name="state" id="state" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['state'])?>" /></p> 
<p  class="clearfix"><label for="zip" class="bold">Zip/Postal Code:</label><input name="zip" id="zip" class="textfield" type="text" value="<?=$_SESSION['form']['zip']?>" /></p> 
<p  class="clearfix"><label for="country" class="bold">Country:</label><input name="country" id="country" class="textfield" type="text" value="<?=$_SESSION['form']['country']?>" /></p> 
<p  class="clearfix"><label for="phone1" class="bold">Office Phone:</label><input name="phone1" id="phone1" class="textfield" type="text" value="<?=$_SESSION['form']['phone1']?>" /></p> 
<p  class="clearfix"><label for="phone2" class="bold">Cell Phone:</label><input name="phone2" id="phone2" class="textfield" type="text" value="<?=$_SESSION['form']['phone2']?>" /></p>
<p  class="clearfix <?=$class[8]?>"><label for="email" class="bold">E-mail:</label><input name="email" id="email" class="textfield" type="text" value="<?=$_SESSION['form']['email']?>" /></p>
</div>
</fieldset>

<!-- PHOTO -->

<h4 class="kerned uppercase trebuchet blue-text">Photo</h4>
<p class="italic">Photo file must be in JPEG (.jpg) OR GIF (.gif) format, and less than 150k.</p>
<fieldset>
<div class="pad5 t-border">
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
<p  class="clearfix <?=$class[3]?>"><label for="photoNew" class="bold">Upload a photo:</label><input name="photoNew" id="photoNew" class="textfield" type="file" /></p> 
<?php } ?>
</div>
</fieldset>

<?php if($_SESSION['admin']['access_level'] == AdminAccess) : ?>

  <!-- ACCESS LEVEL -->

  <h4 class="kerned uppercase trebuchet blue-text">Access Level*</h4>
  <p class=""><strong>Standard Access</strong> will allow the user to view only the information/documents associated with the affiliations in which they are a
  member. <strong>Administrative Access</strong> will allow the user full access to all Affiliations, as well as allow them to create, delete, edit all Affiliations and
  Member Accounts.</p>
  <fieldset>
  <div class="pad5 t-border">
  <p  class="clearfix <?=$class[4]?>"><label for="email" class="bold">Access Level:</label>
  <select name="access" id="access">
    <option value="<?=NoAccess?>">No Access</option>
    <option value="<?=StandardAccess?>" <?php if($_SESSION['form']['access'] == 2) echo 'selected'; ?>>Standard Access</option>
    <option value="<?=AdminAccess?>" <?php if($_SESSION['form']['access'] == 3) echo 'selected'; ?>>Administrative Access</option>
  </select>
  </p>
  <p  class="clearfix <?=$class[5]?>"><label for="username" class="bold">Username*:</label><input name="username" id="username" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['username'],1,0)?>" /></p>
  <p  class="clearfix <?=$class[6]?>"><label for="pw" class="bold">Password:</label><input name="pw" id="pw" class="textfield" type="password" value="<?=intl_clean($_SESSION['form']['pw'],1,0)?>" /></p>
  </div>
  </fieldset>

  <!-- AFFILIATIONS -->
  
  <h4 class="kerned uppercase trebuchet blue-text">Affiliations*</h4>
  <p class="">Select the Affiliations with which this member will be associated (not necessary if member is granted administrative access above).<br />
  1. <strong>Basic</strong> association level will allow the member to view only the information/documents pertaining to the Affiliation.<br />
  2. <strong>Standard</strong> association level will allow the member to view the information/documents pertaining to the Affiliation, plus the profiles of others associated with the Affiliation.<br />
  3. <strong>Full</strong> association level will allow the member to view the information/documents pertaining to the Affiliation, the profiles of others associated with the Affiliation, plus add/update/delete documents associated with the Affiliation.<br />
  </p>
  <fieldset>
  <ul class="">
  <?php
  $affilQuery = "SELECT * FROM groups ORDER BY name ASC";
  $affil = db_select(DITCDB, $affilQuery);
  for($i=0; $i<count($affil); $i++) {
  ?>
  <li class="pad5 t-border">
  <h5><?=intl_clean($affil[$i]['name'],1,0)?></h5>
  <p  class="clearfix <?=$class[7]?>"><label for="email" class="bold">Association Level:</label>
  <select name="affil_<?=$affil[$i]['id']?>" id="affil_<?=$affil[$i]['id']?>">
    <option value="">None</option>
    <option value="1" <?php if($_SESSION['form']['affil_'.$affil[$i]['id']] == 1) echo 'selected'; ?>>Basic</option>
    <option value="2" <?php if($_SESSION['form']['affil_'.$affil[$i]['id']] == 2) echo 'selected'; ?>>Standard</option>
    <option value="3" <?php if($_SESSION['form']['affil_'.$affil[$i]['id']] == 3) echo 'selected'; ?>>Full</option>
  </select>
  </p>
  </li>
  <?php } ?>
  </ul>
  </fieldset>

<?php else : ?>

  <fieldset>
    <div class="pad5 t-border">
      <h4 class="kerned uppercase trebuchet blue-text">Username and Password</h4>
      <p class=""><strong>To change your username or password, enter a new one below.</strong></p>
      <p  class="clearfix <?=$class[5]?>"><label for="username" class="bold">Username*:</label><input name="username" id="username" class="textfield" type="text" value="<?=intl_clean($_SESSION['form']['username'],1,0)?>" /></p>
      <p  class="clearfix <?=$class[6]?>"><label for="pw" class="bold">Password*:</label><input name="pw" id="pw" class="textfield" type="password" value="<?=intl_clean($_SESSION['form']['pw'],1,0)?>" /></p>
      <input name="access" type="hidden" value="2" />
      <?php
      $affilQuery = "SELECT * FROM groups ORDER BY name ASC";
      $affil = db_select(DITCDB, $affilQuery);
      for($i=0; $i<count($affil); $i++) {
        if($_SESSION['form']['affil_'.$affil[$i]['id']] > 0) {
          echo '<input name="affil_' . $affil[$i]['id'] . '" type="hidden" value="';
          if($_SESSION['form']['affil_'.$affil[$i]['id']] == 1) { echo '1'; }
          if($_SESSION['form']['affil_'.$affil[$i]['id']] == 2) { echo '2'; }
          if($_SESSION['form']['affil_'.$affil[$i]['id']] == 3) { echo '3'; }
          echo '" />';
        }
      }
      ?>
    </div>
  </fieldset>
  
<?php endif; ?>  

<fieldset class="p-border gray-bkgd-fade align-center">
<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" /> 
</fieldset>
</form>

</div><!-- END #content -->

<div id="admin-sidebar">



</div>

<?php unset($_SESSION['form']); unset($_SESSION['alert']); ?>