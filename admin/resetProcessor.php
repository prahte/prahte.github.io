<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games ::</title><?php

include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

session_start();

if(isset($_REQUEST['key']) AND $_REQUEST['key'] != '') {
  
  $userQuery = "SELECT * FROM users WHERE pw_reset_key = '".$_REQUEST['key']."'";
  $user = db_select(DITCDB, $userQuery);
  
  if(empty($user)) {
    
    $_SESSION['alert']['message'] = 'There was a problem continuing with the password reset process. Please resubmit your e-mail address and try again.';
    header("Location:pwrecover.php");
    exit;
  
  } elseif(date('Y-m-d H:i:s') > date('Y-m-d H:i:s',strtotime($user[0]['pw_reset_timestamp'] . ' + 1 hour'))) {
  
    $_SESSION['alert']['message'] = 'The password reset time limit for this account has expired. Please resubmit your e-mail address and try again.';
    header("Location:pwrecover.php");
    exit;
    
  } else {
    
    $query = sprintf("UPDATE users SET pw_reset_key = '%s',pw_reset_timestamp = '%s' WHERE id = '%d'",mysql_real_escape_string(''),mysql_real_escape_string(''),mysql_real_escape_string($user[0]['id']));
    $do = db_update(DITCDB, $query);
    
    $_SESSION['admin']['user_id'] = $user[0]['id'];
    $_SESSION['admin']['access_level'] = $user[0]['access'];
    $_SESSION['alert']['message'] = 'You have successfully logged in. Please edit your account and reset your password.';
    header("Location:access/index.php");
    exit;
    
  }

} else {

  $_SESSION['alert']['message'] = 'There was a problem continuing with the password reset process. Please resubmit your e-mail address and try again.';
  header("Location:pwrecover.php");
  exit;
  
}


?>