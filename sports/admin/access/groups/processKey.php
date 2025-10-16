<?php

# if no group ID set, and not an admin, boot 'em out
if(!isset($_REQUEST['gID']) && $_SESSION['admin']['access_level'] < 2) { header("Location:../index.php"); }

require("p_currentListings.php");
	
?>