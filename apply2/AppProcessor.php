<?php

session_start();

	function db_select($db, $query) {
		mysql_pconnect('64.27.65.75', 'ditcadmin', 'd1tcd4t4') or die(mysql_error());
		mysql_select_db($db) or die(mysql_error());
		$result = mysql_query($query);
		if ($result) {
			for ($i=0;$i<mysql_num_rows($result);$i++) {
			$rows[$i] = mysql_fetch_assoc($result); }
			mysql_free_result($result);
		} else { $rows = ''; }
		return($rows);
	}
	
	# update query and return number of rows affected (for updating and deleting records)
	function db_update($db, $query) {
		mysql_pconnect('64.27.65.75', 'ditcadmin', 'd1tcd4t4') or die(mysql_error());
		mysql_select_db($db) or die(mysql_error());
		mysql_query($query);
		return(mysql_affected_rows());
	}
	
	// insert query and return last index
	function db_insert($db, $query) {
		mysql_pconnect('64.27.65.75', 'ditcadmin', 'd1tcd4t4') or die(mysql_error());
		mysql_select_db($db)or die(mysql_error());
		mysql_query($query);
	}
	
	define('DITCDB', 'ditc');
	
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

$error = 0;

If ($_SESSION['form']['fname'] == '') { $error++; $_SESSION['error']['fields'] .= ",1"; } 
If ($_SESSION['form']['lname'] == '') { $error++; $_SESSION['error']['fields'] .= ",2"; }
If ($_SESSION['form']['address1'] == '') { $error++; $_SESSION['error']['fields'] .= ",3"; }
If ($_SESSION['form']['city'] == '') { $error++; $_SESSION['error']['fields'] .= ",4"; }
If ($_SESSION['form']['state'] == '') { $error++; $_SESSION['error']['fields'] .= ",5"; }
If ($_SESSION['form']['zip'] == '') { $error++; $_SESSION['error']['fields'] .= ",5"; }
If ($_SESSION['form']['country'] == '') { $error++; $_SESSION['error']['fields'] .= ",6"; }
If ($_SESSION['form']['phone'] == '') { $error++; $_SESSION['error']['fields'] .= ",7"; }
If ($_SESSION['form']['email'] == '') { $error++; $_SESSION['error']['fields'] .= ",8"; }
If ($_SESSION['form']['school'] == '') { $error++; $_SESSION['error']['fields'] .= ",9"; }
If ($_SESSION['form']['ditc_ref'] == '') { $error++; $_SESSION['error']['fields'] .= ",10"; }

// check if email formatted properly
if ($_SESSION['form']['email'] != '') {	
if (!(eregi("^" . "[a-z0-9]+([_\\.-][a-z0-9]+)*" . "@" . "([a-z0-9]+([\.-][a-z0-9]+)*)+" . "\\.[a-z]{2,}", $_SESSION['form']['email']))) {
	$error++;
	$_SESSION['error']['fields'] .= ",7";
	$_SESSION['error']['message'] .= '<p class="red-text">&bull; The e-mail address you provided does not appear valid. Please check it.</p>'; }
}

If($error > 0) { $_SESSION['error']['message'] .= '<p class="red-text italic">Please correct the highlighted field(s) below.</p>'; header("Location:index.php"); }
else { 

$insertdate = date('Y-m-d H:i:s');

$query = sprintf("INSERT INTO application (fname,lname,address1,address2,city,state,zip,phone,email,school,ditc_ref,cd_rom,date_applied,ip) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d','%s','%s')", 
mysql_real_escape_string($_SESSION['form']['fname']),
mysql_real_escape_string($_SESSION['form']['lname']),
mysql_real_escape_string($_SESSION['form']['address1']),
mysql_real_escape_string($_SESSION['form']['address2']),
mysql_real_escape_string($_SESSION['form']['city']),
mysql_real_escape_string($_SESSION['form']['state']),
mysql_real_escape_string($_SESSION['form']['zip']),
mysql_real_escape_string($_SESSION['form']['phone']),
mysql_real_escape_string($_SESSION['form']['email']),
mysql_real_escape_string($_SESSION['form']['school']),
mysql_real_escape_string($_SESSION['form']['ditc_ref']),
mysql_real_escape_string($_SESSION['form']['cd_rom']),
mysql_real_escape_string($insertdate),
mysql_real_escape_string($_SERVER['REMOTE_ADDR'] ));
$do = db_insert(DITCDB,$query);

$applicant_query = "SELECT id FROM application WHERE fname = '".$_SESSION['form']['fname']."' AND lname = '".$_SESSION['form']['lname']."' AND date_applied = '".$insertdate."'";
$applicant_id = db_select(DITCDB,$applicant_query);

$mailto = "eric@erichuffman.com";
$subject = "DITC Application Request";
$message = "<p><strong>You have received an application request from the DITC Web site.</strong></p>";
$message .= "<p>Below is the information that was submitted.</p>";
$message .= "<p><strong>NAME:</strong> ".$_SESSION['form']['fname']." ".$_SESSION['form']['lname']."</p>";
$message .= "<p><strong>ADDRESS:</strong><br />".$_SESSION['form']['address1']."<br />";
if($_SESSION['form']['address2'] != '') { $message .= "".$_SESSION['form']['address2']."<br />"; }
$message .= "".$_SESSION['form']['city']." ".$_SESSION['form']['state']." ".$_SESSION['form']['zip']."</p>";
$message .= "<p><strong>PHONE:</strong> ".$_SESSION['form']['phone']."</p>";
$message .= "<p><strong>E-MAIL:</strong> ".$_SESSION['form']['email']."</p>";
$message .= "<p><strong>CURRENT SCHOOL:</strong> ".$_SESSION['form']['school']."</p>";
$message .= "<p><strong>How they heard about the DITC:</strong> ".$_SESSION['form']['ditc_ref']."</p>";
if($_SESSION['form']['cd_rom'] == 1) { $message .= "<p><strong>THEY PREFER TO RECEIVE THE APPLICATION VIA CD-ROM</strong></p>"; }
$message .= "<hr>";
$message .= "<p>Click on the appropriate application link below to give them access to the DITC application.</p>";
$message .= "<p><a href=\"http://ditc.us/apply2/app-access/index.php?aID=".$applicant_id[0]['id']."&appID=1\">Application Option 1 - Region Name</a></p>";
$message .= "<p><a href=\"http://ditc.us/apply2/app-access/index.php?aID=".$applicant_id[0]['id']."&appID=2\">Application Option 2 - Region Name</a></p>";
$message .= "<p><a href=\"http://ditc.us/apply2/app-access/index.php?aID=".$applicant_id[0]['id']."&appID=3\">Application Option 3 - Region Name</a></p>";
$message .= "<p><a href=\"http://ditc.us/apply2/app-access/index.php?aID=".$applicant_id[0]['id']."&appID=4\">Application Option 4 - Region Name</a></p>";
$message .= "<p><a href=\"http://ditc.us/apply2/app-access/index.php?aID=".$applicant_id[0]['id']."&appID=5\">Application Option 5 - Region Name</a></p>";
$message .= "<p><a href=\"http://ditc.us/apply2/app-access/index.php?aID=".$applicant_id[0]['id']."&appID=6\">Application Option 6 - Region Name</a></p>";
$message .= "<p><a href=\"http://ditc.us/apply2/app-access/index.php?aID=".$applicant_id[0]['id']."&appID=7\">Application Option 7 - Region Name</a></p>";
$message .= "<hr>";
$headers = "From: ".$_SESSION['form']['fname']." ".$_SESSION['form']['lname']." <".$_SESSION['form']['email'].">\n";
$headers .= "Reply-To: ".$_SESSION['form']['fname']." ".$_SESSION['form']['lname']." <".$_SESSION['form']['email'].">\n";
$headers .= "Return-Path: <".$_SESSION['form']['email'].">\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: text/html; ";
$headers .= "charset=ISO-8859-1\n";
$headers .= "Content-Transfer-Encoding: 7bit\n\n";

mail($mailto,$subject,$message,$headers);

unset($_SESSION['form']);
unset($_SESSION['error']);
$_SESSION['form']['processStatus'] = 1; $_SESSION['form']['appID'] = $applicant_id[0]['id']; header("Location:index.php");

}
?>