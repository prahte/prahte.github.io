<?php
# deleting stuff
#echo '<pre>';
#print_r($_SESSION['form']);
#echo '</pre>';

# get info on related docs, custom content
$extrasQuery = "SELECT thumb_photo, photo_1, photo_2, related_docs, custom_content FROM ditc_news WHERE id = ".$_REQUEST['nID'];
$extras = db_select(DITCDB, $extrasQuery);

if($extras[0]['related_docs'] == 1) {
	$relatedDocsQuery = "SELECT * FROM ditc_news_docs WHERE news_id = ".$_REQUEST['nID'];
	$relatedDocs = db_select(DITCDB, $relatedDocsQuery);
	
	for($i=0; $i<count($relatedDocs); $i++) {
		# delete db row
		$docDeleteQuery = "DELETE FROM ditc_news_docs WHERE id = ".$relatedDocs[$i]['id'];
		$docDelete = db_update(DITCDB, $docDeleteQuery);
		
		# delete file
		@unlink($_SERVER['DOCUMENT_ROOT']."/news-events/articles/documents/".$relatedDocs[$i]['doc_file']);
	}
}

# custom content row
if($extras[0]['custom_content'] == 1) {
	$customDeleteQuery = "DELETE FROM ditc_news_custom WHERE news_id = ".$_REQUEST['nID'];
	$customDelete = db_update(DITCDB, $customDeleteQuery);
}

# delete thumbnail photo
if($extras[0]['thumb_photo'] != '') {	
	@unlink($_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$extras[0]['thumb_photo']);
}

# delete photo 1
if($extras[0]['photo_1'] != '') {	
	@unlink($_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$extras[0]['photo_1']);
}

# delete photo 2
if($extras[0]['photo_2'] != '') {	
	@unlink($_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$extras[0]['photo_2']);
}

# delete new entry
$deleteQuery = "DELETE FROM ditc_news WHERE id = ".$_REQUEST['nID'];
$delete = db_update(DITCDB, $deleteQuery);

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['message'] = 'Document successfully deleted!';
$_SESSION['alert']['type'] = 'green';
header("Location:index.php?".$_SERVER['QUERY_STRING']);
?>