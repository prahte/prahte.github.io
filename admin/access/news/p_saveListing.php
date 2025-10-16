<?php
# set dates to proper format
$_SESSION['form']['start_date'] = date('Y-m-d', strtotime($_SESSION['form']['start_date']));
if( $_SESSION['form']['end_date'] != '' ) {
	$_SESSION['form']['end_date'] = date('Y-m-d', strtotime($_SESSION['form']['end_date']));
} else {
	$_SESSION['form']['end_date'] = '';
}

#echo '<pre>';
#print_r($_SESSION);
#echo '</pre>';
#exit;

if( isset($_REQUEST['nID']) ) {
# =====================================================================================
# Updating an existing news item
# =====================================================================================
	# set up variables for custom content, and related docs
	if( $_SESSION['form']['custom'] != '' ) { $customContent = 1; } else { $customContent = 0; }
	if( $_SESSION['form']['docs'] != '' ) { $relatedDocs = 1; } else { $relatedDocs = 0; }
	
	$query = "UPDATE ditc_news SET 
				title = '".addslashes($_SESSION['form']['title'])."',
				subtitle = '".addslashes($_SESSION['form']['subtitle'])."',
				thumb_photo = '".$_SESSION['form']['thumb_photo']."',
				summary_text = '".addslashes($_SESSION['form']['summary_text'])."',
				text_1 = '".addslashes($_SESSION['form']['text_1'])."',
				photo_1 = '".$_SESSION['form']['photo_1']."',
				caption_1 = '".addslashes($_SESSION['form']['caption_1'])."',
				text_2 = '".addslashes($_SESSION['form']['text_2'])."',
				photo_2 = '".$_SESSION['form']['photo_2']."',
				caption_2 = '".addslashes($_SESSION['form']['caption_2'])."',
				related_links = '".addslashes($_SESSION['form']['related_links'])."',
				location = '".addslashes($_SESSION['form']['location'])."',
				start_date = '".$_SESSION['form']['start_date']."',
				end_date = '".$_SESSION['form']['end_date']."',
				related_docs = '".$relatedDocs."',
				custom_content = '".$customContent."',
				milestone = '".$_SESSION['form']['milestone']."',
				flickr_id = '".$_SESSION['form']['flickr_id']."' 
				WHERE id = ".$_REQUEST['nID'];
	$do = db_update(DITCDB,$query);
	
	if($do < 0) { 
		$_SESSION['alert']['type'] = 'red';
		$_SESSION['alert']['message'] = 'There was a problem updating the news item. Please try again.';
		$content = 'c_previewListing';
		exit;
	}
	
	# delete any existing custom content
	$customDeleteQuery = "DELETE FROM ditc_news_custom WHERE news_id = ".$_REQUEST['nID'];
	$customDelete = db_update(DITCDB,$customDeleteQuery);
	
	# if custom content exists, enter it
	if( $customContent == 1 ) {	
		# insert new custom content
		$customQuery = sprintf("INSERT INTO ditc_news_custom (news_id,content) VALUES('%d','%s')", 
		mysql_real_escape_string($_REQUEST['nID']),
		mysql_real_escape_string($_SESSION['form']['custom']));
		$customDo = db_insert(DITCDB,$customQuery);
	}
	
	# delete any existing custom content
	$docsDeleteQuery = "DELETE FROM ditc_news_docs WHERE news_id = ".$_REQUEST['nID'];
	$docsDelete = db_update(DITCDB,$docsDeleteQuery);
		
	if( $relatedDocs == 1 ) {
		# insert new custom content
		for($i=0; $i<count($_SESSION['form']['docs']); $i++) {
			$docsQuery = sprintf("INSERT INTO ditc_news_docs (doc_title,doc_type,doc_file,news_id) VALUES('%s','%s','%s','%d')", 
			mysql_real_escape_string($_SESSION['form']['docs'][$i]['doc_title']),
			mysql_real_escape_string($_SESSION['form']['docs'][$i]['doc_type']),
			mysql_real_escape_string($_SESSION['form']['docs'][$i]['doc_file']),
			mysql_real_escape_string($_REQUEST['nID']));
			$docsDo = db_insert(DITCDB,$docsQuery);
		}
	}
	
	# delete any existing news categories
	$categoriesDeleteQuery = "DELETE FROM ditc_news_catassoc WHERE news_id = ".$_REQUEST['nID'];
	$categoriesDelete = db_update(DITCDB,$categoriesDeleteQuery);
	
	# if category selections exist, insert new entries
	if( isset($_SESSION['form']['categories']) ) {
		for($i=0; $i<count($_SESSION['form']['categories']); $i++) {
			$categoriesQuery = sprintf("INSERT INTO ditc_news_catassoc (cat_id,news_id) VALUES('%d','%d')", 
			mysql_real_escape_string($_SESSION['form']['categories'][$i]),
			mysql_real_escape_string($_REQUEST['nID']));
			$categoriesDo = db_insert(DITCDB,$categoriesQuery);
		}
	}

} else {
# =====================================================================================
# Entering a new news item
# =====================================================================================
	# set up variables for custom content, and related docs
	if( $_SESSION['form']['custom'] != '' ) { $customContent = 1; } else { $customContent = 0; }
	if( $_SESSION['form']['docs'] != '' ) { $relatedDocs = 1; } else { $relatedDocs = 0; }
	
	$query = sprintf("INSERT INTO ditc_news (title,subtitle,thumb_photo,summary_text,text_1,photo_1,caption_1,text_2,photo_2,caption_2,related_links,location,start_date,end_date,related_docs,custom_content,milestone,flickr_id,status) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%d')", 
	mysql_real_escape_string($_SESSION['form']['title']),
	mysql_real_escape_string($_SESSION['form']['subtitle']),
	mysql_real_escape_string($_SESSION['form']['thumb_photo']),
	mysql_real_escape_string($_SESSION['form']['summary_text']),
	mysql_real_escape_string($_SESSION['form']['text_1']),
	mysql_real_escape_string($_SESSION['form']['photo_1']),
	mysql_real_escape_string($_SESSION['form']['caption_1']),
	mysql_real_escape_string($_SESSION['form']['text_2']),
	mysql_real_escape_string($_SESSION['form']['photo_2']),
	mysql_real_escape_string($_SESSION['form']['caption_2']),
	mysql_real_escape_string($_SESSION['form']['related_links']),
	mysql_real_escape_string($_SESSION['form']['location']),
	mysql_real_escape_string($_SESSION['form']['start_date']),
	mysql_real_escape_string($_SESSION['form']['end_date']),
	mysql_real_escape_string($relatedDocs),
	mysql_real_escape_string($customContent),
	mysql_real_escape_string($_SESSION['form']['milestone']),
	mysql_real_escape_string($_SESSION['form']['flickr_id']),
	mysql_real_escape_string(1));
	$do = db_insert(DITCDB,$query);
	
	if($do < 0) { 
		$_SESSION['alert']['type'] = 'red';
		$_SESSION['alert']['message'] = 'There was a problem creating the news item. Please try again.';
		$content = 'c_previewListing';
		exit;
	}
	
	# if custom content exists, enter it
	if( $customContent == 1 ) {
		$customQuery = sprintf("INSERT INTO ditc_news_custom (news_id,content) VALUES('%d','%s')", 
		mysql_real_escape_string($do),
		mysql_real_escape_string($_SESSION['form']['custom']));
		$customDo = db_insert(DITCDB,$customQuery);
	}
	
	if( $relatedDocs == 1 ) {
		for($i=0; $i<count($_SESSION['form']['docs']); $i++) {
			$docsQuery = sprintf("INSERT INTO ditc_news_docs (doc_title,doc_type,doc_file,news_id) VALUES('%s','%s','%s','%d')", 
			mysql_real_escape_string($_SESSION['form']['docs'][$i]['doc_title']),
			mysql_real_escape_string($_SESSION['form']['docs'][$i]['doc_type']),
			mysql_real_escape_string($_SESSION['form']['docs'][$i]['doc_file']),
			mysql_real_escape_string($do));
			$docsDo = db_insert(DITCDB,$docsQuery);
		}
	}
	
	if( isset($_SESSION['form']['categories']) ) {
		# insert new entries
		for($i=0; $i<count($_SESSION['form']['categories']); $i++) {
			$categoriesQuery = sprintf("INSERT INTO ditc_news_catassoc (cat_id,news_id) VALUES('%d','%d')", 
			mysql_real_escape_string($_SESSION['form']['categories'][$i]),
			mysql_real_escape_string($_REQUEST['nID']));
			$categoriesDo = db_insert($do);
		}
	}
	
}

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['type'] = 'green';
if( isset($_REQUEST['nID']) ) {
	$_SESSION['alert']['message'] = 'News item successfully updated!';
	$queryString = '?year='.$_REQUEST['year'];
} else {
	$_SESSION['alert']['message'] = 'News item successfully created!';
}
header('Location:index.php'.$queryString);
?>