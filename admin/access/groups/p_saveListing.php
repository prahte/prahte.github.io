<?php


# =====================================================================================
# Header Content
# =====================================================================================

 # update session values w/ post values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

# set errors to zero
$errors=0;

# set default error message
$_SESSION['alert']['message'] .= 'An Error has occured - see the hightlighted fields below.<br />';
$_SESSION['alert']['type'] = 'red';

# ===================================================================================
# General info check
# ===================================================================================
# check for invalid/empty results
if($_SESSION['form']['name'] == '') { $errors++; $_SESSION['alert']['fields'] .= ",1"; $_SESSION['alert']['message'] .= '<em>You must provide a name.</em><br />'; }

# ===================================================================================
# Logo upload
# ===================================================================================
if($_FILES['logoNew']['name'] != '') {
	
	$_SESSION['form']['logo'] = $_FILES['logoNew']['name'];
	
	# create array from file name to determine proper extension
	$logoTypeArray = explode(".", $_SESSION['form']['logo']);
	$xtension = ( (count($logoTypeArray))-1 );
	
	# check to make sure it's not over 150000 bytes (150k)
	if($_FILES['logoNew']['size'] <= 150000) {
	
	# check for non-empty farm name first
	if($_SESSION['form']['name'] != '') {
	
		# make sure it's a jpg or gif
		if( ($logoTypeArray[$xtension] != 'jpg' && $logoTypeArray[$xtension] != 'JPG') && ($logoTypeArray[$xtension] != 'gif' && $logoTypeArray[$xtension] != 'GIF') ) {
			# if not, set up error message/fields
			$errors++; $_SESSION['alert']['message'] .= '- Logo must be a ".jpg" or "gif" file type<br />'; $_SESSION['alert']['fields'] .= ",7"; $_SESSION['form']['logo'] = $_SESSION['form']['logoOld']; }
		else {
		# else, the file checks out as a jpg or gif, rename it, and move it to the proper location
		$logoName = 'logo-'.substr(preg_replace('/(\s|\.)/', '', $_SESSION['form']['name']), 0, 4).'-'.date('ymdHis').'.'.$logoTypeArray[$xtension];
		# check to make sure file uploaded ok and set the session value for the name of the file to be the file that was just uploaded
		if (move_uploaded_file($_FILES['logoNew']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/admin/access/assets/logos/".$logoName)) {
			$_SESSION['form']['logo'] = $logoName; }
		else {
			$_SESSION['error']['fields'].=',7';
			$_SESSION['alert']['message'] .= "- There was an error uploading the logo<br />.";
			$_SESSION['form']['logo'] = $_SESSION['form']['logoOld'];
			$errors++; }
		}
	
	} else { $errors++; $_SESSION['alert']['message'] .= '<em>(You will need to re-upload the logo)</em><br />'; $_SESSION['alert']['fields'] .= ",7"; $_SESSION['form']['logo'] = $_SESSION['form']['logoOld']; }
	
	} else { $errors++; $_SESSION['alert']['message'] .= '<em>The logo file is larger than 150k. Please resize the logo.</em><br />'; $_SESSION['alert']['fields'] .= ",7"; $_SESSION['form']['logo'] = $_SESSION['form']['logoOld']; }
	
} else { $_SESSION['form']['logo'] = $_SESSION['form']['logoOld']; }

if(isset($_SESSION['form']['logoDelete']) && $_FILES['logoNew']['name'] == '') { $_SESSION['form']['logo'] = ''; @unlink($_SERVER['DOCUMENT_ROOT']."/admin/access/assets/logos/".$_SESSION['form']['logoOld']); }

#echo '<pre>';
#print_r($_SESSION);
#echo '</pre>';
#exit;

# if errors, return to the form
if($errors > 0) {
	
	$content = "c_createEditListing.php";

} else {

# if id is set in query string, update the listing
if( isset($_REQUEST['gID']) ) {

$query = "UPDATE groups 
	SET
	name = '".addslashes($_SESSION['form']['name'])."',
	description = '".addslashes($_SESSION['form']['description'])."',
	logo = '".$_SESSION['form']['logo']."',
	address1 = '".addslashes($_SESSION['form']['address1'])."',
	address2 = '".addslashes($_SESSION['form']['address2'])."',
	city = '".addslashes($_SESSION['form']['city'])."',
	state = '".addslashes($_SESSION['form']['state'])."',
	country = '".addslashes($_SESSION['form']['country'])."',
	zip = '".addslashes($_SESSION['form']['zip'])."'
	WHERE id = ".$_REQUEST['gID'];
$do = db_update(DITCDB, $query);

# if failed to update listing
if($do < 0) { $_SESSION['alert']['message'] = 'There was a problem updating the affiliation. Please try again.'; $_SESSION['alert']['type'] = 'red'; require("p_createListing.php"); } else {

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Affiliation successfully updated!';
$_SESSION['alert']['type'] = 'green';
header('Location:index.php?gID='.$_REQUEST['gID']);

}

} else {

$query = sprintf("INSERT INTO groups (name,address1,address2,city,state,zip,country,description,logo,created_by) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%d')", 
mysql_real_escape_string($_SESSION['form']['name']),
mysql_real_escape_string($_SESSION['form']['address1']),
mysql_real_escape_string($_SESSION['form']['address2']),
mysql_real_escape_string($_SESSION['form']['city']),
mysql_real_escape_string($_SESSION['form']['state']),
mysql_real_escape_string($_SESSION['form']['zip']),
mysql_real_escape_string($_SESSION['form']['country']),
mysql_real_escape_string($_SESSION['form']['description']),
mysql_real_escape_string($_SESSION['form']['logo']),
mysql_real_escape_string($_SESSION['admin']['user_id']));
$do = db_insert(DITCDB,$query);

# get id for group just entered
#$linkID = "SELECT id FROM groups WHERE name = '".$_SESSION['form']['name']."' AND 

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Affiliation successfully created!';
$_SESSION['alert']['type'] = 'green';
header('Location:index.php?gID='.$do);

}

}

?>