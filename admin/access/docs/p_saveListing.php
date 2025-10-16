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
if($_SESSION['form']['doc_title'] == '') { $errors++; $_SESSION['alert']['fields'] .= ",1"; $_SESSION['alert']['message'] .= '<em>You must provide a title for the document.</em><br />'; }

# ===================================================================================
# File upload
# ===================================================================================
if($_FILES['fileNew']['name'] != '') {
	
	$_SESSION['form']['file'] = $_FILES['fileNew']['name'];
	
	# create array from file name to determine proper extension
	$fileTypeArray = explode(".", $_SESSION['form']['file']);
	$xtension = ( (count($fileTypeArray))-1 );
	
	# check to make sure it's not over 2000000 bytes (2 MB)
	if($_FILES['fileNew']['size'] <= 2000000) {
	
	# check for non-empty farm name first
	if($_SESSION['form']['doc_title'] != '') {
	
		# make sure it's a doc, xls, pdf, jpg, or gif
		if( (strtolower($fileTypeArray[$xtension]) != 'doc') &&
			(strtolower($fileTypeArray[$xtension]) != 'xls') &&
			(strtolower($fileTypeArray[$xtension]) != 'pdf') &&
			(strtolower($fileTypeArray[$xtension]) != 'jpg') &&
			(strtolower($fileTypeArray[$xtension]) != 'gif') ) {
			# if not, set up error message/fields
			$errors++; $_SESSION['alert']['message'] .= '- file is not one of the approved types<br />'; $_SESSION['alert']['fields'] .= ",2"; $_SESSION['form']['file'] = $_SESSION['form']['fileOld']; }
		else {
		# else, the file checks out as an approved type, rename it, and move it to the proper location
		$fileName = 'file-'.substr(preg_replace('/(\s|\.)/', '', $_SESSION['form']['doc_title']), 0, 4).'-'.date('ymdHis').'.'.$fileTypeArray[$xtension];
		# check to make sure file uploaded ok and set the session value for the name of the file to be the file that was just uploaded
		if (move_uploaded_file($_FILES['fileNew']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/admin/access/assets/files/".$fileName)) {
			$_SESSION['form']['file'] = $fileName;
			$_SESSION['form']['type'] = strtolower($fileTypeArray[$xtension]); }
		else {
			$_SESSION['error']['fields'].=',2';
			$_SESSION['alert']['message'] .= "- There was an error uploading the file<br />.";
			$_SESSION['form']['file'] = $_SESSION['form']['fileOld'];
			$errors++; }
		}
	
	} else { $errors++; $_SESSION['alert']['message'] .= '<em>(You will need to re-upload the file)</em><br />'; $_SESSION['alert']['fields'] .= ",2"; $_SESSION['form']['file'] = $_SESSION['form']['fileOld']; }
	
	} else { $errors++; $_SESSION['alert']['message'] .= '<em>The file file is larger than 2 MB. Please resize the file.</em><br />'; $_SESSION['alert']['fields'] .= ",2"; $_SESSION['form']['file'] = $_SESSION['form']['fileOld']; }
	
} else { $_SESSION['form']['file'] = $_SESSION['form']['fileOld']; $_SESSION['form']['type'] = $_SESSION['form']['typeOld']; }

#echo '<pre>';
#print_r($_SESSION);
#echo '</pre>';
#exit;

# if errors, return to the form
if($errors > 0) {
	
	$content = "c_createEditListing.php";

} else {

# if id is set in query string, update the listing
if( isset($_REQUEST['dID']) ) {

$query = "UPDATE group_docs 
	SET
	doc_title = '".addslashes($_SESSION['form']['doc_title'])."',
	file = '".$_SESSION['form']['file']."',
	type = '".$_SESSION['form']['type']."',
	user_id = '".$_SESSION['admin']['user_id']."',
	status = 2,
	date = '".date('Y-m-d H:i:s')."'
	WHERE id = ".$_REQUEST['dID'];
$do = db_update(DITCDB, $query);

##### if sys admin, delete all previous group affiliations
if($_SESSION['admin']['access_level'] == 2) {
$delete = "DELETE FROM group_docs_affil WHERE doc_id = ".$_REQUEST['dID'];
$doDelete = db_update(DITCDB, $delete);
 
##### insert new affiliations
$groupQuery = "SELECT * FROM groups ORDER BY name ASC";
$group = db_select(DITCDB, $groupQuery);
for($i=0; $i<count($group); $i++) {
	if( isset($_SESSION['form']['affil_'.$group[$i]['id']]) ) {
	$affilQuery = sprintf("INSERT INTO group_docs_affil (doc_id,group_id) VALUES('%d','%d')",
	mysql_real_escape_string($_REQUEST['dID']),
	mysql_real_escape_string($group[$i]['id']));
	$affilDO = db_insert(DITCDB,$affilQuery);
	}
}
} ##### END if sys admin, update doc affils

# if failed to update listing
if($do < 0) { $_SESSION['alert']['message'] = 'There was a problem updating the document. Please try again.'; $_SESSION['alert']['type'] = 'red'; require("p_createListing.php"); } else {

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Document successfully updated!';
$_SESSION['alert']['type'] = 'green';
if( isset($_REQUEST['gID']) ) { $queryString = '?gID='.$_REQUEST['gID']; }
header('Location:../docs/index.php'.$queryString);

}

} else {

$query = sprintf("INSERT INTO group_docs (doc_title,file,type,user_id,status,date) VALUES('%s','%s','%s','%d','%s','%s')", 
mysql_real_escape_string($_SESSION['form']['doc_title']),
mysql_real_escape_string($_SESSION['form']['file']),
mysql_real_escape_string($_SESSION['form']['type']),
mysql_real_escape_string($_SESSION['admin']['user_id']),
mysql_real_escape_string(1),
mysql_real_escape_string(date('Y-m-d H:i:s')));
$do = db_insert(DITCDB,$query);

##### insert new affiliations
$groupQuery = "SELECT * FROM groups ORDER BY name ASC";
$group = db_select(DITCDB, $groupQuery);
for($i=0; $i<count($group); $i++) {
	if( isset($_SESSION['form']['affil_'.$group[$i]['id']]) ) {
	$affilQuery = sprintf("INSERT INTO group_docs_affil (doc_id,group_id) VALUES('%d','%d')",
	mysql_real_escape_string($do),
	mysql_real_escape_string($group[$i]['id']));
	$affilDO = db_insert(DITCDB,$affilQuery);
	}
}

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Document successfully uploaded!';
$_SESSION['alert']['type'] = 'green';
if( isset($_REQUEST['gID']) ) { $queryString = '?gID='.$_REQUEST['gID']; }
header('Location:../groups/index.php'.$queryString);

}

}

?>