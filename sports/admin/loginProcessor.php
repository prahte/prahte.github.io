<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games ::</title><?php
#echo '<pre>';
#print_r($_POST);
#echo '</pre>';
#exit;

include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

# Convert POST values to SESSION values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

# Set error variable to 0
$error = 0;


# Check for empty or incorrect values
if($_SESSION['form']['username'] == '') { $_SESSION['alert']['fields'] .= ',1'; $error++; $_SESSION['alert']['message'] .= 'Please enter a username.<br />'; }
if($_SESSION['form']['password'] == '') { $_SESSION['alert']['fields'] .= ',2'; $error++; $_SESSION['alert']['message'] .= 'Please enter a password.<br />'; }

# if errors, return to form...
if($error > 0) { header("Location:index.php"); }
# else, check password
else {

$pwQuery = "SELECT * FROM users WHERE pw = '".$_SESSION['form']['password']."' AND username = '".$_SESSION['form']['username']."'";
$pw = db_select(DITCDB, $pwQuery);

if(!empty($pw) && $pw[0]['access'] < 1) { $_SESSION['alert']['message'] .= 'Your account is no longer active. Please contact us for more information.<br />'; header("Location:index.php"); exit; }

if(!$pw) { $_SESSION['alert']['fields'] .= ',1,2'; $_SESSION['alert']['message'] .= 'Username or password is incorrect.<br />'; header("Location:index.php"); }
else {

$_SESSION['admin']['user_id'] = $pw[0]['id'];
$_SESSION['admin']['access_level'] = $pw[0]['access'];

#echo '<pre>';
#print_r($_SESSION['admin']);
#echo '</pre>';
header("Location:access/index.php");
}

}
?>