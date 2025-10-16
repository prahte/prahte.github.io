<?php

if($_POST) { 

	# ======================================================================
	# Canceling
	# ======================================================================
	if($_POST['submit'] == "Cancel") {
		unset($_SESSION['form']); unset($_SESSION['alert']);
		header("Location:index.php");
	}
	
	# ======================================================================
	# Configure
	# ======================================================================
	if($_POST['submit'] == "Configure Settings") { require("p_editListing.php"); }
	
	# ======================================================================
	# Inactivate a blog
	# ======================================================================
	if($_POST['submit'] == "Deactivate") { require("p_deactivateListing.php"); }
	
	# ======================================================================
	# Activate a blog
	# ======================================================================
	if($_POST['submit'] == "Activate") { require("p_activateListing.php"); }
	
	# ======================================================================
	# Delete a blog
	# ======================================================================
	if($_POST['submit'] == "Delete") { require("p_deleteListing.php"); }
	
	# ======================================================================
	# Saving settings
	# ======================================================================
	if($_POST['submit'] == "Save") { require("p_saveListing.php"); }
	
} else {

	if(isset($_REQUEST['n']) && $_REQUEST['n'] == 1) { require("p_createListing.php"); } else { require("p_currentListings.php"); }

}
?>