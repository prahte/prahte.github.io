<title>ATLANTA 1996 :: The Living Legacy of the Atlanta 1996 Centennial Olympic Games ::</title><?php
#echo '<pre>';
#print_r($_POST);
#echo '</pre>';
#exit;
session_start();

include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');

# Convert POST values to SESSION values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

# Set error variable to 0
$error = 0;

# Check for empty email field
if($_SESSION['form']['email'] == '') {
  
  $_SESSION['alert']['fields'] .= ',1';
  $error++; $_SESSION['alert']['message'] .= 'Please enter an e-mail address.<br />';

} else {

  $userQuery = "SELECT * FROM users WHERE email = '".$_SESSION['form']['email']."'";
  $user = db_select(DITCDB, $userQuery);
  if( empty($user) ) {
    $error++;
    $_SESSION['alert']['message'] .= 'Sorry, the e-mail address you provided was not found. Password reminders can only be sent to active accounts.<br />';
  }
  if( !empty($user) && $user[0]['access'] == 0) {
    $error++; $_SESSION['alert']['message'] .= 'Sorry, your account is no longer active. Password reminders can only be sent to active email accounts.<br />';
  }

}

# if errors, return to form...
if($error > 0) { header("Location:pwrecover.php"); }

# else send send email

else {
  
  $resetKey = md5($user[0]['email'] . $user[0]['id'] . date('His'));
  $resetTimestamp = date('Y-m-d H:i:s');
  
  $query = sprintf("UPDATE users SET pw_reset_key = '%s',pw_reset_timestamp = '%s' WHERE id = '%d'",mysql_real_escape_string($resetKey),mysql_real_escape_string($resetTimestamp),mysql_real_escape_string($user[0]['id']));
  $do = db_update(DITCDB, $query);
  
  $subject = "Password Reset for DITC Web site access";
  $to = $_SESSION['form']['email'];
  $headers = "From: DITC <no-reply@ditc.us>\n";
  $headers .= "Reply-To: DITC <no-reply@ditc.us>\n";
  $headers .= "MIME-Version: 1.0\n";
  $headers .= "Content-Type: text/plain; ";
  $headers .= "charset=ISO-8859-1\n";
  $headers .= "Content-Transfer-Encoding: 7bit";
  $message .= "You are receiving this e-mail because on ".date('l F n, Y')." at ".date('g:i a').", a request was made on the DITC Web site for a password reset.\n\n";
  $message .= "You have one hour from this time to complete the reset process by clicking on the following link (or copy and paste it into your browser):\n\n";
  $message .= "http://www.ditc.us/admin/resetProcessor.php?key=" . $resetKey . ".\n";
  mail($to,$subject,$message,$headers);
  
  $_SESSION['alert']['message'] = 'Password reset instructions have been emailed to the address you provided.';
  header("Location:pwrecover.php");
  exit;
  
}
?>