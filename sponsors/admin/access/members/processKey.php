<?php

##### if uID is NOT set, and user is not an admin, boot 'em out
# if(!isset($_REQUEST['uID']) && $_SESSION['admin']['access_level'] < 2) { header("Location:../index.php"); }

if($_POST) { 	
	
	# ======================================================================
	# Canceling
	# ======================================================================
	if($_POST['submit'] == "Cancel") {
		unset($_SESSION['form']); unset($_SESSION['alert']);
		if( isset($_REQUEST['uID']) ) $queryString = '?uID='.$_REQUEST['uID'];
		header("Location:index.php".$queryString); }
	
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
	#if($_POST['submit'] == "Delete") { require("p_deleteListing.php"); }
	
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
# else not posting, so send 'em back to admin home
if( !isset($_REQUEST['uID']) ) { header("Location:../index.php"); } else { require("p_currentListings.php"); }
} 
	
?>