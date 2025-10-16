<?php

# if no group ID set, and not an admin, boot 'em out
if(!isset($_REQUEST['gID']) && $_SESSION['admin']['access_level'] < 3) { header("Location:../index.php"); }

require("p_currentListings.php");
	
?>