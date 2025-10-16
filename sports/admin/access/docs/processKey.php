<?php

##### if no $_POST, and user is not an admin, boot 'em out
#if( (!$_POST) && $_SESSION['admin']['access_level'] < 2) { header("Location:../index.php"); }

if($_POST) { 

	# ======================================================================
	# Canceling
	# ======================================================================
	if($_POST['submit'] == "Cancel") {
		unset($_SESSION['form']); unset($_SESSION['alert']);
		if( isset($_REQUEST['gID']) ) $queryString = '?gID='.$_REQUEST['gID'];
		header("Location:/sports/admin/access/groups/index.php".$queryString); }
	
	# ======================================================================
	# Editing a listing (only applies to admins)
	# ======================================================================
	if($_POST['submit'] == "Edit") { require("p_editListing.php"); }
	
	# ======================================================================
	# Inactivating a listing (only applies to admins)
	# ======================================================================
	#if($_POST['submit'] == "Deactivate") { require("p_deactivateListing.php"); }
	
	# ======================================================================
	# Activating a listing (only applies to admins)
	# ======================================================================
	#if($_POST['submit'] == "Activate") { require("p_activateListing.php"); }
	
	# ======================================================================
	# Deleting a listing (only applies to admins)
	# ======================================================================
	if($_POST['submit'] == "Delete") { require("p_deleteListing.php"); }
	
	/*# ======================================================================
	# Previewing a listing
	# ======================================================================
	if($_POST['submit'] == "Preview") { require("p_previewListing.php"); }
	
	# ======================================================================
	# Returning to edit a listing (or create a new listing -- if admin)
	# ======================================================================
	if($_POST['submit'] == "Go Back") { require("p_createListing.php"); }*/
	
	# ======================================================================
	# Saving a listing
	# ======================================================================
	if($_POST['submit'] == "Save") { require("p_saveListing.php"); }
	
} else {
##### else not posting, so get create/edit module if appropriate variables are set (n=1, and gID if not a sys admin),
##### or if sys admin, get current listings module
if(isset($_REQUEST['n']) && $_REQUEST['n'] == 1) {
	if($_SESSION['admin']['access_level'] < 2) {
		if( !isset($_REQUEST['gID']) ) { header("Location:../index.php"); } else { require("p_createListing.php"); }
	} else {
		require("p_createListing.php");
	}
} else {
	if($_SESSION['admin']['access_level'] < 2) { header("Location:../index.php"); } else { require("p_currentListings.php"); }
}
}
?>