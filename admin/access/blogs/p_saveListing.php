<?php
# update session values w/ post values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';
exit;*/

/* set errors variable to zero */
$errors = 0;

# ===================================================================================
# Error checking
# ===================================================================================
if($_SESSION['form']['blog_title'] == '') { $_SESSION['alert']['fields'] .= ",blog_title"; ++$errors; }
//if($_SESSION['form']['blog_short_title'] == '') { $_SESSION['alert']['fields'] .= ",blog_short_title"; $_SESSION['alert']['message'] .= '<em>You must provide a short title for the blog.</em><br />'; ++$errors; }

if($errors > 0) {
	
		$_SESSION['alert']['type'] = 'red';
		$_SESSION['alert']['message'] = 'You have left some required fields blank. See the highlighted fields below.<br />';
		include('p_createListing.php');
	
} else {

	if( isset($_REQUEST['bID']) ) {
	# =====================================================================================
	# Updating an existing blog
	# =====================================================================================
		$query = sprintf("UPDATE blogs SET blog_title = '%s', blog_short_title = '%s', blog_desc = '%s' WHERE id = '%d'",
				 mysql_real_escape_string($_SESSION['form']['blog_title']),
				 mysql_real_escape_string($_SESSION['form']['blog_short_title']),
				 mysql_real_escape_string($_SESSION['form']['blog_desc']),
				 mysql_real_escape_string($_REQUEST['bID']));
		$do = db_update(DITCDB,$query);
		
		if($do < 0) { 
			$_SESSION['alert']['type'] = 'red';
			$_SESSION['alert']['message'] = 'There was a problem updating the blog settings. Please try again.';
			$content = 'c_createEditListing';
			exit;
		}
	
	} else {
	# =====================================================================================
	# Entering a new blog
	# =====================================================================================
		$query = sprintf("INSERT INTO blogs (blog_title,blog_short_title,blog_desc) VALUES('%s','%s','%s')", 
		mysql_real_escape_string($_SESSION['form']['blog_title']),
		mysql_real_escape_string($_SESSION['form']['blog_short_title']),
		mysql_real_escape_string($_SESSION['form']['blog_desc']));
		$do = db_insert(DITCDB,$query);
		
		if($do < 0) { 
			$_SESSION['alert']['type'] = 'red';
			$_SESSION['alert']['message'] = 'There was a problem creating the blog. Please try again.';
			$content = 'c_createEditListing';
			exit;
		}
	}
	
	unset($_SESSION['form']); unset($_SESSION['alert']);
	$_SESSION['alert']['type'] = 'green';
	if( isset($_REQUEST['bID']) ) {
		$_SESSION['alert']['message'] = 'Blog settings successfully updated!';
	} else {
		$_SESSION['alert']['message'] = 'Blog successfully created!';
	}
	header('Location:index.php');

}
?>