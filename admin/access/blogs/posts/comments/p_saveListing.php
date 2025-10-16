<?php

# update session values w/ post values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

if($_SESSION['form']['comment'] == '') {
    
    $_SESSION['alert']['fields'] = ',comment';
    $_SESSION['alert']['message'] = 'You must provide a reply.';
    $_SESSION['alert']['type'] = 'red';
    if($_SESSION['form']['submit'] == 'Save Edits') { 
    	$processType = 'Save Edits';
    	$processText = 'Current Text';
    }
    include('p_createListing.php');
    //exit;
    
} else {

# =====================================================================================
# Entering a reply
# =====================================================================================

if($_SESSION['form']['submit'] == 'Save') {

	$query = sprintf("INSERT INTO blogs_posts_comments (blog_id,post_id,comment_type,name,email,comment,comment_date,reply_date,org_id,user_id) VALUES('%d','%d','%d','%s','%s','%s','%s','%s','%d','%d')", 
	mysql_real_escape_string($_SESSION['form']['blog_id']),
	mysql_real_escape_string($_SESSION['form']['post_id']),
	mysql_real_escape_string(2),
	mysql_real_escape_string($_SESSION['form']['name']),
	mysql_real_escape_string($_SESSION['form']['email']),
	mysql_real_escape_string($_SESSION['form']['comment']),
	mysql_real_escape_string($_SESSION['form']['comment_date']),
	mysql_real_escape_string(date('Y-m-d H:i:s')),
	mysql_real_escape_string($_SESSION['form']['org_id']),
	mysql_real_escape_string($_SESSION['form']['user_id']));
	$do = db_insert(DITCDB,$query);
		
	if($do < 0) { 
		$_SESSION['alert']['type'] = 'red';
		$_SESSION['alert']['message'] = 'There was a problem creating the reply. Please try again.';
		include('p_createListing.php');
		//exit;
	} else {
		$_SESSION['alert']['message'] = 'Reply successfully created!';
	}

} else {
	
	$query = sprintf("UPDATE blogs_posts_comments SET comment = '%s' WHERE id = '%d'", 
	mysql_real_escape_string($_SESSION['form']['comment']),
	mysql_real_escape_string($_REQUEST['cID']));
	$do = db_update(DITCDB,$query);
		
	if($do < 0) { 
		$_SESSION['alert']['type'] = 'red';
		$_SESSION['alert']['message'] = 'There was a saving your edits. Please try again.';
		$processType = 'Save Edits';
		include('p_createListing.php');
		//exit;
	} else {
		$_SESSION['alert']['message'] = 'Edits successfully saved!';
	}

}

unset($_SESSION['form']);
$_SESSION['alert']['type'] = 'green';
header('Location:index.php?pID='.$_REQUEST['pID']);

}
?>