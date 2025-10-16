<?php


# =====================================================================================
# Header Content
# =====================================================================================

 # update session values w/ post values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

#echo '<pre>';
#print_r($_SESSION);
#echo '</pre>';
#exit;


# set errors to zero
$errors=0;

# set default error message
$_SESSION['alert']['message'] .= 'An Error has occured - see the hightlighted fields below.<br />';
$_SESSION['alert']['type'] = 'red';

# ===================================================================================
# General info check
# ===================================================================================
# check for invalid/empty results
if($_SESSION['form']['fname'] == '') { $errors++; $_SESSION['alert']['fields'] .= ",1"; $_SESSION['alert']['message'] .= '<em>You must provide a first name.</em><br />'; }
if($_SESSION['form']['lname'] == '') { $errors++; $_SESSION['alert']['fields'] .= ",2"; $_SESSION['alert']['message'] .= '<em>You must provide a last name.</em><br />'; }
if($_SESSION['form']['access'] > NoAccess) {
	if($_SESSION['form']['username'] == '') { $errors++; $_SESSION['alert']['fields'] .= ",5"; $_SESSION['alert']['message'] .= '<em>You must provide a username.</em><br />'; }
	if($_SESSION['form']['pw'] == '' AND !isset($_REQUEST['uID'])) { $errors++; $_SESSION['alert']['fields'] .= ",6"; $_SESSION['alert']['message'] .= '<em>You must provide a password.</em><br />'; }
}

# check that username does not already exist
if( $_SESSION['form']['access'] > NoAccess) {
	if( isset($_REQUEST['uID']) ) {
		$usernameQuery = "SELECT username FROM users WHERE id = ".$_REQUEST['uID'];
		$username = db_select(DITCDB, $usernameQuery);
		if($username[0]['username'] != $_SESSION['form']['username'] ) {
			$usernameQuery = "SELECT username FROM users WHERE username = '".$_SESSION['form']['username']."'";
			$username = db_select(DITCDB, $usernameQuery);
			if($username) {
				$errors++; $_SESSION['alert']['fields'] .= ",5"; $_SESSION['alert']['message'] .= '<em>That username is already taken. Please enter a different one.</em><br />';
			}
		}
	} else {
		$usernameQuery = "SELECT username FROM users WHERE username = '".$_SESSION['form']['username']."'";
		$username = db_select(DITCDB, $usernameQuery);
		if($username) {
			$errors++; $_SESSION['alert']['fields'] .= ",5"; $_SESSION['alert']['message'] .= '<em>That username is already taken. Please enter a different one.</em><br />';
		}
	}
}

# check that email does not already exist
if( $_SESSION['form']['access'] > NoAccess) {
	if( isset($_REQUEST['uID']) ) {
		$emailQuery = "SELECT email FROM users WHERE id = ".$_REQUEST['uID'];
		$email = db_select(DITCDB, $emailQuery);
		if($email[0]['email'] != $_SESSION['form']['email'] ) {
			$emailQuery = "SELECT email FROM users WHERE email = '".$_SESSION['form']['email']."'";
			$email = db_select(DITCDB, $emailQuery);
			if($email) {
				$errors++; $_SESSION['alert']['fields'] .= ",8"; $_SESSION['alert']['message'] .= '<em>That email is already associated with another account. Please use a different email address.</em><br />';
			}
		}
	} else {
		$emailQuery = "SELECT email FROM users WHERE email = '".$_SESSION['form']['email']."'";
		$email = db_select(DITCDB, $emailQuery);
		if($email) {
			$errors++; $_SESSION['alert']['fields'] .= ",8"; $_SESSION['alert']['message'] .= '<em>That email is already associated with another account. Please use a different email address.</em><br />';
		}
	}
}


# check for affiliations if not an admin
if($_SESSION['form']['access'] < AdminAccess) {
	$groupQuery = "SELECT * FROM groups ORDER BY name ASC";
	$group = db_select(DITCDB, $groupQuery);
	$affilCount = 0;
	for($i=0; $i<count($group); $i++) {
		if($_SESSION['form']['affil_'.$group[$i]['id']] != '') { $affilCount++; }
	}
	if($affilCount == 0) { $errors++; $_SESSION['alert']['fields'] .= ",4,7"; $_SESSION['alert']['message'] .= '<em>If the member is not granted Administrator access, you must select at least one Affiliation for which they are associated.</em><br />'; }
}


# ===================================================================================
# Photo upload
# ===================================================================================
if($_FILES['photoNew']['name'] != '') {
	
	$_SESSION['form']['photo'] = $_FILES['photoNew']['name'];
	
	# create array from file name to determine proper extension
	$photoTypeArray = explode(".", $_SESSION['form']['photo']);
	$xtension = ( (count($photoTypeArray))-1 );
	
	# check to make sure it's not over 150000 bytes (150k)
	if($_FILES['photoNew']['size'] <= 150000) {
	
	# check for non-empty farm name first
	if($_SESSION['form']['lname'] != '') {
	
		# make sure it's a jpg or gif
		if( ($photoTypeArray[$xtension] != 'jpg' && $photoTypeArray[$xtension] != 'JPG') && ($photoTypeArray[$xtension] != 'gif' && $photoTypeArray[$xtension] != 'GIF') ) {
			# if not, set up error message/fields
			$errors++; $_SESSION['alert']['message'] .= '- photo must be a ".jpg" or "gif" file type<br />'; $_SESSION['alert']['fields'] .= ",3"; $_SESSION['form']['photo'] = $_SESSION['form']['photoOld']; }
		else {
		# else, the file checks out as a jpg or gif, rename it, and move it to the proper location
		$photoName = 'photo-'.substr(preg_replace('/(\s|\.)/', '', $_SESSION['form']['lname']), 0, 4).'-'.date('ymdHis').'.'.$photoTypeArray[$xtension];
		# check to make sure file uploaded ok and set the session value for the name of the file to be the file that was just uploaded
		if (move_uploaded_file($_FILES['photoNew']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/admin/access/assets/photos/".$photoName)) {
			$_SESSION['form']['photo'] = $photoName; }
		else {
			$_SESSION['error']['fields'].=',3';
			$_SESSION['alert']['message'] .= "- There was an error uploading the photo<br />.";
			$_SESSION['form']['photo'] = $_SESSION['form']['photoOld'];
			$errors++; }
		}
	
	} else { $errors++; $_SESSION['alert']['message'] .= '<em>(You will need to re-upload the photo)</em><br />'; $_SESSION['alert']['fields'] .= ",3"; $_SESSION['form']['photo'] = $_SESSION['form']['photoOld']; }
	
	} else { $errors++; $_SESSION['alert']['message'] .= '<em>The photo file is larger than 150k. Please resize the photo.</em><br />'; $_SESSION['alert']['fields'] .= ",3"; $_SESSION['form']['photo'] = $_SESSION['form']['photoOld']; }
	
} else { $_SESSION['form']['photo'] = $_SESSION['form']['photoOld']; }

if(isset($_SESSION['form']['photoDelete']) && $_FILES['photoNew']['name'] == '') { $_SESSION['form']['photo'] = ''; @unlink($_SERVER['DOCUMENT_ROOT']."/admin/access/assets/photos/".$_SESSION['form']['photoOld']); }

#echo '<pre>';
#print_r($_SESSION);
#echo '</pre>';
#exit;

# if errors, return to the form
if($errors > 0) {
	
	$content = "c_createEditListing.php";

} else {

# if id is set in query string, update the listing
if( isset($_REQUEST['uID']) ) {

$query = "UPDATE users 
	SET
	fname = '".addslashes($_SESSION['form']['fname'])."',
	mname = '".addslashes($_SESSION['form']['mname'])."',
	lname = '".addslashes($_SESSION['form']['lname'])."',
	title = '".addslashes($_SESSION['form']['title'])."',
	photo = '".$_SESSION['form']['photo']."',
	address1 = '".addslashes($_SESSION['form']['address1'])."',
	address2 = '".addslashes($_SESSION['form']['address2'])."',
	city = '".addslashes($_SESSION['form']['city'])."',
	state = '".addslashes($_SESSION['form']['state'])."',
	country = '".addslashes($_SESSION['form']['country'])."',
	zip = '".addslashes($_SESSION['form']['zip'])."',
	phone1 = '".addslashes($_SESSION['form']['phone1'])."',
	phone2 = '".addslashes($_SESSION['form']['phone2'])."',
	email = '".$_SESSION['form']['email']."',
	access = '".$_SESSION['form']['access']."',
	username = '".$_SESSION['form']['username']."'";
  if($_SESSION['form']['pw'] != '') {
    $query .=	",pw = '".md5($_SESSION['form']['pw'])."'";
  }
  $query .=	" WHERE id = ".$_REQUEST['uID'];
$do = db_update(DITCDB, $query);

##### delete all previous group affiliations
$delete = "DELETE FROM group_affil WHERE user_id = ".$_REQUEST['uID'];
$doDelete = db_update(DITCDB, $delete);
 
##### insert new affiliations
$groupQuery = "SELECT * FROM groups ORDER BY name ASC";
$group = db_select(DITCDB, $groupQuery);
for($i=0; $i<count($group); $i++) {
	if($_SESSION['form']['affil_'.$group[$i]['id']] != '') {
	$affilQuery = sprintf("INSERT INTO group_affil (user_id,group_id,group_access) VALUES('%d','%d','%d')",
	mysql_real_escape_string($_REQUEST['uID']),
	mysql_real_escape_string($group[$i]['id']),
	mysql_real_escape_string($_SESSION['form']['affil_'.$group[$i]['id']]));
	$affilDO = db_insert(DITCDB,$affilQuery);
	}
}


# if failed to update listing
if($do < 0) { $_SESSION['alert']['message'] = 'There was a problem updating the affiliation. Please try again.'; $_SESSION['alert']['type'] = 'red'; require("p_createListing.php"); } else {

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Member profile successfully updated!';
$_SESSION['alert']['type'] = 'green';
header('Location:index.php?uID='.$_REQUEST['uID']);
exit;

}

} else {

$query = sprintf("INSERT INTO users (fname,mname,lname,title,photo,address1,address2,city,state,country,zip,phone1,phone2,email,access,username,pw,created_by,date) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%s','%d','%s')", 
mysql_real_escape_string($_SESSION['form']['fname']),
mysql_real_escape_string($_SESSION['form']['mname']),
mysql_real_escape_string($_SESSION['form']['lname']),
mysql_real_escape_string($_SESSION['form']['title']),
mysql_real_escape_string($_SESSION['form']['photo']),
mysql_real_escape_string($_SESSION['form']['address1']),
mysql_real_escape_string($_SESSION['form']['address2']),
mysql_real_escape_string($_SESSION['form']['city']),
mysql_real_escape_string($_SESSION['form']['state']),
mysql_real_escape_string($_SESSION['form']['country']),
mysql_real_escape_string($_SESSION['form']['zip']),
mysql_real_escape_string($_SESSION['form']['phone1']),
mysql_real_escape_string($_SESSION['form']['phone2']),
mysql_real_escape_string($_SESSION['form']['email']),
mysql_real_escape_string($_SESSION['form']['access']),
mysql_real_escape_string($_SESSION['form']['username']),
mysql_real_escape_string(md5($_SESSION['form']['pw'])),
mysql_real_escape_string($_SESSION['admin']['user_id']),
mysql_real_escape_string(date('Y-m-d H:i:s')));
$do = db_insert(DITCDB,$query);

##### insert new affiliations
$groupQuery = "SELECT * FROM groups ORDER BY name ASC";
$group = db_select(DITCDB, $groupQuery);
for($i=0; $i<count($group); $i++) {
	if($_SESSION['form']['affil_'.$group[$i]['id']] != '') {
	$affilQuery = sprintf("INSERT INTO group_affil (user_id,group_id,group_access) VALUES('%d','%d','%d')",
	mysql_real_escape_string($do),
	mysql_real_escape_string($group[$i]['id']),
	mysql_real_escape_string($_SESSION['form']['affil_'.$group[$i]['id']]));
	$affilDO = db_insert(DITCDB,$affilQuery);
	}
}

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Member profile successfully created!';
$_SESSION['alert']['type'] = 'green';
header('Location:index.php?uID='.$do);
exit;

}

}

?>