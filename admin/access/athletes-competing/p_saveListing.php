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
if($_SESSION['form']['comp_title'] == '') { $errors++; $_SESSION['alert']['fields'] .= ",comp_title"; $_SESSION['alert']['message'] .= '<em>You must provide a Competition title.</em><br />'; }
if($_SESSION['form']['comp_location'] == '') { $errors++; $_SESSION['alert']['fields'] .= ",comp_location"; $_SESSION['alert']['message'] .= '<em>You must provide a Competition location.</em><br />'; }

/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';
exit;*/

# if errors, return to the form
if($errors > 0) {
	
	$content = "c_createEditListing.php";

} else {

$date = date('Y-m-d H:i:s',strtotime($_SESSION['form']['compMonth'].'/'.$_SESSION['form']['compDay'].'/'.$_SESSION['form']['compYear'].' 01:00:00'));

# if id is set in query string, update the listing
if( isset($_REQUEST['cID']) ) {

$query = "UPDATE athletes_competing 
	SET
	comp_title = '".addslashes($_SESSION['form']['comp_title'])."',
	comp_location = '".addslashes($_SESSION['form']['comp_location'])."',
	comp_date = '".$date."'
	WHERE id = ".$_REQUEST['cID'];
$do = db_update(DITCDB, $query);

# if failed to update listing
if($do < 0) { $_SESSION['alert']['message'] = 'There was a problem updating the competition. Please try again.'; $_SESSION['alert']['type'] = 'red'; require("p_createListing.php"); } else {

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Competition successfully updated!';
$_SESSION['alert']['type'] = 'green';
header('Location:index.php?cID='.$_REQUEST['cID']);

}

} else {

$query = sprintf("INSERT INTO athletes_competing (comp_title,comp_location,comp_date) VALUES('%s','%s','%s')", 
mysql_real_escape_string($_SESSION['form']['comp_title']),
mysql_real_escape_string($_SESSION['form']['comp_location']),
mysql_real_escape_string($date));
$do = db_insert(DITCDB,$query);

# get id for group just entered
#$linkID = "SELECT id FROM groups WHERE name = '".$_SESSION['form']['name']."' AND 

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Competition successfully created!';
$_SESSION['alert']['type'] = 'green';
header('Location:index.php?cID='.$do);

}

}

?>