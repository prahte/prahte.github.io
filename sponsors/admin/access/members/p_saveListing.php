<?php

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
if($_SESSION['form']['email'] == '') { $errors++; $_SESSION['alert']['fields'] .= ",4"; $_SESSION['alert']['message'] .= '<em>You must provide an e-mail address.</em><br />'; }

# check if email formatted properly
if ($_SESSION['form']['email'] != '') {	
if (!(eregi("^" . "[a-z0-9]+([_\\.-][a-z0-9]+)*" . "@" . "([a-z0-9]+([\.-][a-z0-9]+)*)+" . "\\.[a-z]{2,}", $_SESSION['form']['email']))) {
	$errors++;
	$_SESSION['alert']['fields'] .= ",4";
	$_SESSION['alert']['message'] .= '<em>The e-mail address you provided does not appear valid. Please check it.</em><br />'; }
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

$query = "UPDATE users 
	SET
	fname = '".$_SESSION['form']['fname']."',
	mname = '".$_SESSION['form']['mname']."',
	lname = '".$_SESSION['form']['lname']."',
	title = '".$_SESSION['form']['title']."',
	photo = '".$_SESSION['form']['photo']."',
	address1 = '".$_SESSION['form']['address1']."',
	address2 = '".$_SESSION['form']['address2']."',
	city = '".$_SESSION['form']['city']."',
	state = '".$_SESSION['form']['state']."',
	country = '".$_SESSION['form']['country']."',
	zip = '".$_SESSION['form']['zip']."',
	phone1 = '".$_SESSION['form']['phone1']."',
	phone2 = '".$_SESSION['form']['phone2']."',
	email = '".$_SESSION['form']['email']."'
	WHERE id = ".$_REQUEST['uID'];
$do = db_update(DITCDB, $query);

# if failed to update listing
if($do < 0) { $_SESSION['alert']['message'] = 'There was a problem updating the affiliation. Please try again.'; $_SESSION['alert']['type'] = 'red'; require("p_createListing.php"); } else {

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Member profile successfully updated!';
$_SESSION['alert']['type'] = 'green';
header('Location:../index.php');

}

}
?>