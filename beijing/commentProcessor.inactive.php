<?php

# update session values w/ post values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

if($_SESSION['form']['name'] == '') { $_SESSION['alert']['fields'] .= ',name'; $_SESSION['alert']['message'] .= 'You must provide a name.<br />'; }
if( $_SESSION['form']['email'] == '' OR !eregi("^" . "[a-z0-9]+([_\\.-][a-z0-9]+)*" . "@" . "([a-z0-9]+([\.-][a-z0-9]+)*)+" . "\\.[a-z]{2,}", $_SESSION['form']['email']) ) {
	$_SESSION['alert']['fields'] .= ',email';
	$_SESSION['alert']['message'] .= 'Your email address does not appear to be valid.<br />'; 
}
if(strpos($_SESSION['form']['email'],',') !== FALSE ) {
	$_SESSION['alert']['fields'] .= ',email';
	$_SESSION['alert']['message'] .= 'You are only allowed to enter one e-mail address.<br />';
}
if($_SESSION['form']['comment'] == '') { $_SESSION['alert']['fields'] .= ',comment'; $_SESSION['alert']['message'] .= 'Please provide your comment.'; }

/* captcha field */
if($_SESSION['form']['field1'] != '') { $_SESSION['alert']['fields'] .= ',field1'; }

if( isset($_SESSION['alert']['fields']) ) {
	$_SESSION['alert']['type'] = 'red';
	header('Location:'.$_SERVER['PHP_SELF'].'?pID='.$_REQUEST['pID'].'#commentForm');
	exit;

} else {
	
	require('/vservers/ditcus/ditcdbConnect.php');
	
	$uniqueID = md5(date('hms'));
	
	$query = sprintf("INSERT INTO blogs_posts_comments (blog_id,post_id,comment_type,name,email,comment,comment_date,ip_address,unique_id,status) VALUES('%d','%d','%d','%s','%s','%s','%s','%s','%s','%d')",
			  mysql_real_escape_string($_REQUEST['bID']),
			  mysql_real_escape_string($_REQUEST['pID']),
			  mysql_real_escape_string(1),
			  mysql_real_escape_string(strip_tags($_SESSION['form']['name'])),
			  mysql_real_escape_string(strip_tags($_SESSION['form']['email'])),
			  mysql_real_escape_string(strip_tags($_SESSION['form']['comment'])),
			  mysql_real_escape_string(date('Y-m-d H:i:s')),
			  mysql_real_escape_string($_SERVER['REMOTE_ADDR']),
			  mysql_real_escape_string($uniqueID),
			  mysql_real_escape_string('0'));
	$do = mysql_query($query);
    
    if(mysql_affected_rows() == 0) { 
        $_SESSION['alert']['type'] = 'red';
        $_SESSION['alert']['message'] = 'There was a problem entering your comment. Please try again.';
        header('Location:'.$_SERVER['PHP_SELF'].'?pID='.$_REQUEST['pID'].'#commentForm');
        exit;
    } else {
        //$updateID = mysql_real_escape_string($_REQUEST['pID']);
    	//$updateQuery = "UPDATE blogs_posts SET comment_flag = 1 WHERE id =".$updateID;
    	//$updateDo = db_update(DITCDB,$updateQuery);
    	
    	$to = "mdgutekunst@ditc.us";
    	//$to = "eric@erichuffman.com";
    	$subject = "Beijing Blog Comment Submission";
    	$headers = "From: ATLANTA DITC <info@ditc.us>\n";
		$headers .= "Reply-To: ATLANTA DITC <info@ditc.us>\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-Type: text/plain; ";
		$headers .= "charset=ISO-8859-1\n";
		$headers .= "Content-Transfer-Encoding: 7bit";
    	$message = "A comment has been posted to the ATLANTA DITC Beijing Blog:\n\n";
    	$message .= "From: ".strip_tags($_SESSION['form']['name'])."\n";
    	$message .= "E-mail: ".strip_tags($_SESSION['form']['email'])."\n";
    	$message .= "Comment: ".strip_tags($_SESSION['form']['comment'])."\n\n";
    	$message .= "To APPROVE this comment visit this URL: http://www.ditc.us/beijing/processor.php?uID=".$uniqueID."&process=1\n\n";
    	$message .= "To REMOVE this comment visit this URL: http://www.ditc.us/beijing/processor.php?uID=".$uniqueID."&process=0\n\n";
    	$message .= "This comment was submitted on ".date('l, F j, Y')." at ".date('g:i:s T').".";
    	
    	mail($to,$subject,$message,$headers);
    	
    	unset($_SESSION['form']);
    	$_SESSION['alert']['type'] = 'green'; $_SESSION['alert']['message'] = 'Thank you for your comment! To prevent spam, all comments are reviewed before they are published to our blog. Please check back later to see your comment.'; 
    	header('Location:'.$_SERVER['PHP_SELF'].'?pID='.$_REQUEST['pID'].'#commentForm');
    	exit;
    }
    
}

?>