<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# get assests for this post
$assetsQuery = "SELECT id FROM blogs_assets WHERE post_id = ".$_REQUEST['pID'];
$assets = db_select(DITCDB, $assetsQuery);

if(!empty($assets)) {
	for($i=0; $i<count($assets); $i++) {
		# delete db row
		$assetDeleteQuery = "DELETE FROM blogs_assets WHERE id = ".$assets[$i]['id'];
		$assetDelete = db_update(DITCDB, $assetDeleteQuery);
		
		# delete file
		@unlink($_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$assets[$i]['file']);
	}
}

# delete new entry
$deleteQuery = "DELETE FROM blogs_posts WHERE id = ".$_REQUEST['pID'];
$delete = db_update(DITCDB, $deleteQuery);

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Blog entry successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php?".$_SERVER['QUERY_STRING']);
?>