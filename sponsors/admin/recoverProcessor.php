<title>ATLANTA 1996 :: The Living Legacy Institution of the Atlanta 1996 Centennial Olympic Games ::</title><?php
#echo '<pre>';
#print_r($_POST);
#echo '</pre>';
#exit;
session_start();

require_once("../../includes/global/constants.php");
require_once(homepath."includes/global/functions.php");

# Convert POST values to SESSION values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

# Set error variable to 0
$error = 0;

# Check for empty email field
if($_SESSION['form']['email'] == '') { $_SESSION['alert']['fields'] .= ',1'; $error++; $_SESSION['alert']['message'] .= 'Please enter an e-mail address.<br />'; }

else {

$userQuery = "SELECT * FROM users WHERE email = '".$_SESSION['form']['email']."'";
$user = db_select(DITCDB, $userQuery);

if( empty($user) ) { $error++; $_SESSION['alert']['message'] .= 'Sorry, the e-mail address you provided was not found. Password reminders can only be sent to active accounts.<br />'; }

if( !empty($user) && $user[0]['access'] == 0) { $error++; $_SESSION['alert']['message'] .= 'Sorry, your account is no longer active. Password reminders can only be sent to active email accounts.<br />'; }

}

# if errors, return to form...
if($error > 0) { header("Location:pwrecover.php"); }

# else send send email

else {

$subject = "Password Reminder for DITC Web site access";
$to = $_SESSION['form']['email'];
$headers = "From: DITC <no-reply@ditc.us>\n";
$headers .= "Reply-To: DITC <no-reply@ditc.us>\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/plain; ";
$headers .= "charset=ISO-8859-1\n";
$headers .= "Content-Transfer-Encoding: 7bit";
$message .= "You are receiving this e-mail because on ".date('l F n, Y')." at ".date('g:i a').", a request was made on the DITC Web site for a password reminder.\n\n";
$message .= "The following is the log-in information associated with this e-mail address:\n\n";
$message .= "Username: ".$user[0]['username']."\n";
$message .= "Password: ".$user[0]['pw']."\n\n";
$message .= "Please make a note of it.\n";
mail($to,$subject,$message,$headers);

$_SESSION['alert']['message'] = 'Your password reminder has been emailed to the address you provided.';
 header("Location:pwrecover.php");

}
?>