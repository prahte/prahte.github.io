<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

if( isset($_REQUEST['gID']) ) {

# delete doc affiliation listing only for intended group
$deleteAffilQuery = "DELETE FROM group_docs_affil WHERE group_id = ".$_REQUEST['gID']." AND doc_id = ".$_REQUEST['dID'];
$deleteAffilDo = db_update(DITCDB, $deleteAffilQuery);

# if failed to delete listing
if($deleteAffilDo < 0) {
	$_SESSION['alert']['message'] = 'There was a problem deleting the document. Please try again.'; $_SESSION['alert']['type'] = 'red';
	header("Location:../groups/index.php?gID=".$_REQUEST['gID']);
} else {

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Document successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:../groups/index.php?gID=".$_REQUEST['gID']);

}

} else {

# delete doc affiliation listing
$deleteAffilQuery = "DELETE FROM group_docs_affil WHERE doc_id = ".$_REQUEST['dID'];
$deleteAffilDo = db_update(DITCDB, $deleteAffilQuery);

# get file name
$fileQuery = "SELECT file FROM group_docs WHERE id = ".$_REQUEST['dID'];
$file = db_select(DITCDB, $fileQuery);

# delete file
@unlink($_SERVER['DOCUMENT_ROOT']."/admin/access/assets/files/".$file[0]['file']);

# delete doc listing
$deleteQuery = "DELETE FROM group_docs WHERE id = ".$_REQUEST['dID'];
$deleteDo = db_update(DITCDB, $deleteQuery);

# if failed to delete listing
if($deleteAffilDo < 0 || $deleteDo < 0) {
	$_SESSION['alert']['message'] = 'There was a problem deleting the document. Please try again.'; $_SESSION['alert']['type'] = 'red';
	header("Location:index.php");
} else {

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Document successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php");

}

}
?>