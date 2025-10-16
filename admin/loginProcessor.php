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
if($_SESSION['form']['username'] == '') {
  $_SESSION['alert']['fields'] .= ',1';
  $error++;
  $_SESSION['alert']['message'] .= 'Please enter a username.<br />';
}

if($_SESSION['form']['password'] == '') {
  $_SESSION['alert']['fields'] .= ',2';
  $error++; $_SESSION['alert']['message'] .= 'Please enter a password.<br />';
}

# if errors, return to form...
if($error > 0) {
  header("Location:index.php");
# else, check password
} else {

  $pwQuery = "SELECT * FROM users WHERE pw = '" . md5($_SESSION['form']['password']) . "' AND username = '".$_SESSION['form']['username']."'";
  //$pwQuery = "SELECT * FROM users WHERE pw = '" . $_SESSION['form']['password'] . "' AND username = '".$_SESSION['form']['username']."'";
  $pw = db_select(DITCDB, $pwQuery);

  if(!empty($pw) && $pw[0]['access'] < 1) {
    $_SESSION['alert']['message'] .= 'Your account is no longer active. Please contact us for more information.<br />';
    header("Location:index.php");
    exit;
  }
  if(!empty($pw) && $pw[0]['access'] < 2) {
    $_SESSION['alert']['message'] .= 'Your do not have access to this section.<br />';
    header("Location:index.php");
    exit;
  }
  if($pw[0]['pw_reset_key'] != '') {
    $_SESSION['alert']['message'] .= 'This account is in the process of being reset. If you did not receive an email with instructions for completing the account reset, <a href="pwrecover.php">please submit your email address again</a> (or check your spam filters).<br />';
    header("Location:index.php");
    exit;
  }

  if(!$pw) {
    $_SESSION['alert']['fields'] .= ',1,2';
    $_SESSION['alert']['message'] .= 'Username or password is incorrect.<br />';
    header("Location:index.php");
    exit;
  } else {
    $_SESSION['admin']['user_id'] = $pw[0]['id'];
    $_SESSION['admin']['access_level'] = $pw[0]['access'];
    header("Location:access/index.php");
    exit;
  }

}
?>