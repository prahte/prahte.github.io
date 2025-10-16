<?php
#echo '<pre>';
#print_r($_POST);
#print_r($_FILES);
#echo '</pre>';
#exit;

# =====================================================================================
# Header Content
# =====================================================================================

# update session values w/ post values
while (list($k,$v) = each($_POST)) { $_SESSION['form'][$k] = $v; }

# set errors to zero
$errors = 0;

# set default error message
$_SESSION['alert']['message'] .= "There is some missing or incomplete information - see the hightlighted fields below.<br />";
$_SESSION['alert']['type'] = 'red';

# ===================================================================================
# Thumbnail upload
# ===================================================================================
if($_FILES['thumb_photoNew']['name'] != '') {
	
	$_SESSION['form']['thumb_photo'] = $_FILES['thumb_photoNew']['name'];
	
	# create array from file name to determine proper extension
	$thumbPhotoTypeArray = explode(".", $_SESSION['form']['thumb_photo']);
	$xtension = ( (count($thumbPhotoTypeArray))-1 );
	
	# check to make sure it's not over 150000 bytes (150k)
	if($_FILES['thumb_photoNew']['size'] <= 150000) {
	
		# make sure it's a jpg or gif
		if( strtolower($thumbPhotoTypeArray[$xtension]) != 'jpg' && strtolower($thumbPhotoTypeArray[$xtension]) != 'gif' ) {
			# if not, set up error message/fields
			$_SESSION['alert']['message'] .= '- Thumbnail photo must be a ".jpg" or "gif" file type.<br />';
			$_SESSION['alert']['fields'] .= ",thumb_photo";
			$_SESSION['form']['thumb_photo'] = $_SESSION['form']['thumb_photoOld'];
			$errors++;
		} else {
			# else, the file checks out as a jpg or gif, rename it, and move it to the proper location
			$thumbPhotoName = 'tmbPhoto-'.date('YmdHis').".".$thumbPhotoTypeArray[$xtension];
			# check to make sure file uploaded ok and set the session value for the name of the file to be the file that was just uploaded
			if (move_uploaded_file($_FILES['thumb_photoNew']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$thumbPhotoName)) {
				$_SESSION['form']['thumb_photo'] = $thumbPhotoName;
			} else {
				$_SESSION['error']['fields'].= ',thumb_photo';
				$_SESSION['alert']['message'] .= "- There was an error uploading the thumbnail photo.<br />";
				$_SESSION['form']['thumb_photo'] = $_SESSION['form']['thumb_photoOld'];
				$errors++;
			}
		}
		
	} else {
		$_SESSION['alert']['message'] .= '<em>The thumbnail photo is larger than 150k. Please resize the thumbnail photo.</em><br />';
		$_SESSION['alert']['fields'] .= ",thumb_photo";
		$_SESSION['form']['thumb_photo'] = $_SESSION['form']['thumb_photoOld'];
		$errors++; 
	}
	
} else { $_SESSION['form']['thumb_photo'] = $_SESSION['form']['thumb_photoOld']; }

if(isset($_SESSION['form']['thumb_photoDelete']) && $_FILES['thumb_photo']['name'] == '') { $_SESSION['form']['thumb_photo'] = ''; }

# ===================================================================================
# Photo 1 upload
# ===================================================================================
if($_FILES['photo_1New']['name'] != '') {
	
	$_SESSION['form']['photo_1'] = $_FILES['photo_1New']['name'];
	
	# create array from file name to determine proper extension
	$photo1TypeArray = explode(".", $_SESSION['form']['photo_1']);
	$xtension = ( (count($photo1TypeArray))-1 );
	
	# check to make sure it's not over 150000 bytes (150k)
	if($_FILES['photo_1New']['size'] <= 150000) {
	
		# make sure it's a jpg or gif
		if( strtolower($photo1TypeArray[$xtension] != 'jpg') && strtolower($photo1TypeArray[$xtension] != 'gif') ) {
			# if not, set up error message/fields
			$_SESSION['alert']['message'] .= '- Photo 1 must be a ".jpg" or "gif" file type.<br />';
			$_SESSION['alert']['fields'] .= ",photo_1";
			$_SESSION['form']['photo_1'] = $_SESSION['form']['photo_1Old'];
			$errors++;
		} else {
			# else, the file checks out as a jpg or gif, rename it, and move it to the proper location
			$Photo1Name = 'newsPhoto1-'.date('YmdHis').".".$photo1TypeArray[$xtension];
			# check to make sure file uploaded ok and set the session value for the name of the file to be the file that was just uploaded
			if (move_uploaded_file($_FILES['photo_1New']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$Photo1Name)) {
				$_SESSION['form']['photo_1'] = $Photo1Name; }
			else {
				$_SESSION['error']['fields'].=',photo_1';
				$_SESSION['alert']['message'] .= "- There was an error uploading photo 1.<br />";
				$_SESSION['form']['photo_1'] = $_SESSION['form']['photo_1Old'];
				$errors++;
			}
		}
		
	} else {
		$_SESSION['alert']['message'] .= '<em>Photo 1 is larger than 150k. Please resize photo 1.</em><br />';
		$_SESSION['alert']['fields'] .= ",photo_1";
		$_SESSION['form']['photo_1'] = $_SESSION['form']['photo_1Old'];
		$errors++; 
	}
	
} else { $_SESSION['form']['photo_1'] = $_SESSION['form']['photo_1Old']; }

if(isset($_SESSION['form']['photo_1Delete']) && $_FILES['photo_1']['name'] == '') { $_SESSION['form']['photo_1'] = ''; }

# ===================================================================================
# Photo 2 upload
# ===================================================================================
if($_FILES['photo_2New']['name'] != '') {
	
	$_SESSION['form']['photo_2'] = $_FILES['photo_2New']['name'];
	
	# create array from file name to determine proper extension
	$photo2TypeArray = explode(".", $_SESSION['form']['photo_2']);
	$xtension = ( (count($photo2TypeArray))-1 );
	
	# check to make sure it's not over 150000 bytes (150k)
	if($_FILES['photo_2New']['size'] <= 150000) {
	
		# make sure it's a jpg or gif
		if( strtolower($photo2TypeArray[$xtension] != 'jpg') && strtolower($photo2TypeArray[$xtension] != 'gif') ) {
			# if not, set up error message/fields
			$_SESSION['alert']['message'] .= '- Photo 2 must be a ".jpg" or "gif" file type.<br />';
			$_SESSION['alert']['fields'] .= ',photo_2';
			$_SESSION['form']['photo_2'] = $_SESSION['form']['photo_2Old'];
			$errors++;
		} else {
			# else, the file checks out as a jpg or gif, rename it, and move it to the proper location
			$Photo2Name = 'newsPhoto2-'.date('YmdHis').".".$photo2TypeArray[$xtension];
			# check to make sure file uploaded ok and set the session value for the name of the file to be the file that was just uploaded
			if (move_uploaded_file($_FILES['photo_2New']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$Photo2Name)) {
				$_SESSION['form']['photo_2'] = $Photo2Name;
			} else {
				$_SESSION['error']['fields'].=',photo_2';
				$_SESSION['alert']['message'] .= "- There was an error uploading photo 2.<br />";
				$_SESSION['form']['photo_2'] = $_SESSION['form']['photo_2Old'];
				$errors++;
			}
		}
		
	} else {
		$_SESSION['alert']['message'] .= '<em>Photo 2 is larger than 150k. Please resize photo 2.</em><br />';
		$_SESSION['alert']['fields'] .= ",photo_2";
		$_SESSION['form']['photo_2'] = $_SESSION['form']['photo_2Old'];
		$errors++; 
	}
	
} else { $_SESSION['form']['photo_2'] = $_SESSION['form']['photo_2Old']; }

if(isset($_SESSION['form']['photo_2Delete']) && $_FILES['photo_2']['name'] == '') { $_SESSION['form']['photo_2'] = ''; }

# ===================================================================================
# Related Docs
# ===================================================================================

$relatedDocs = array();

for($i=0; $i<$_SESSION['form']['doc_count']; $i++) {
		
	if($_FILES['doc_file_'.$i.'_New']['name'] != '') {

		# set up related doc session value
		$_SESSION['form']['related_doc'] = $_FILES['doc_file_'.$i.'_New']['name'];
	
		# create array from file name to determine proper extension
		$docTypeArray = explode(".", $_SESSION['form']['related_doc']);
		$xtension = ( (count($docTypeArray))-1 );
		
		# check to make sure it's not over 1000000 bytes (1MB)
		if($_FILES['doc_file_'.$i.'_New']['size'] <= 1000000) {
		
			# make sure it's a pdf or doc
			if( strtolower($docTypeArray[$xtension]) != 'pdf' && strtolower($docTypeArray[$xtension]) != 'doc' ) {
				# if not, set up error message/fields
				$_SESSION['alert']['message'] .= '- Document '.(($i)+1).' must be a ".pdf" or ".doc" file type.<br />';
				$_SESSION['alert']['fields'] .= ",doc_file_".$i."_New";
				$_SESSION['form']['related_doc'] = $_SESSION['form']['doc_file_'.$i.'_Old'];
				$_SESSION['form']['file_type'] = $_SESSION['form']['doc_type_'.$i.'_Old'];
				$errors++;
			} else {
				# else, the file checks out as a jpg or gif, rename it, and move it to the proper location
				$docName = 'rltdDoc-'.$i.'-'.date('YmdHis').'.'.$docTypeArray[$xtension];
				# check to make sure file uploaded ok and set the session value for the name of the file to be the file that was just uploaded
				if (move_uploaded_file($_FILES['doc_file_'.$i.'_New']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/news-events/articles/documents/".$docName)) {
					$_SESSION['form']['related_doc'] = $docName; $_SESSION['form']['file_type'] = $docTypeArray[$xtension];
				} else {
					$_SESSION['error']['fields'].=',doc_file_'.$i.'_New';
					$_SESSION['alert']['message'] .= "- There was an error uploading document ".(($i)+1).".<br />";
					$_SESSION['form']['related_doc'] = $_SESSION['form']['doc_file_'.$i.'_Old'];
					$_SESSION['form']['file_type'] = $_SESSION['form']['doc_type_'.$i.'_Old'];
					$errors++;
				}
			} # END if/else correct file extension
		
		# else, doc is too big, create error message, set values to old file/type
		} else {
			$_SESSION['alert']['message'] .= '<em>Document '.(($i)+1).' is larger than 1 MB. Please resize document '.(($i)+1).'.</em><br />';
			$_SESSION['alert']['fields'] .= "doc_file_".$i."_New";
			$_SESSION['form']['related_doc'] = $_SESSION['form']['doc_file_'.$i.'_Old']; 
			$_SESSION['form']['file_type'] = $_SESSION['form']['doc_type_'.$i.'_Old'];
			$errors++; 
		}

	# else, not uploading a new doc, so check to make sure there was a doc to begin with - if there was, set up proper session values
	} else {
		if( isset($_SESSION['form']['doc_file_'.$i.'_Old']) ) { $_SESSION['form']['related_doc'] = $_SESSION['form']['doc_file_'.$i.'_Old']; }
		if( isset($_SESSION['form']['doc_type_'.$i.'_Old']) ) { $_SESSION['form']['file_type'] = $_SESSION['form']['doc_type_'.$i.'_Old']; }
	}
	
	# if not deleting the doc, and the related doc/file type sessions exist, plop everything into the related docs array
	if( !isset($_SESSION['form']['doc_file_'.$i.'_Delete']) && isset($_SESSION['form']['related_doc']) && isset($_SESSION['form']['file_type']) ) {
		array_push($relatedDocs, array('doc_file'=>$_SESSION['form']['related_doc'],'doc_type'=>$_SESSION['form']['file_type'],'doc_title'=>$_SESSION['form']['doc_title_'.$i]));
	}
	
	# check for empty doc title option, if it exists, throw an error
	if( isset($_SESSION['form']['related_doc']) && isset($_SESSION['form']['file_type']) && $_SESSION['form']['doc_title_'.$i] == '' ) { 
		$_SESSION['alert']['message'] .= '- Document '.(($i)+1).' must have a title.<br />';
		$_SESSION['alert']['fields'] .= ",doc_title_".$i;
		$errors++; 
	}
	
	# unset the temp session values set up before going to next item in the loop
	unset($_SESSION['form']['related_doc']); unset($_SESSION['form']['file_type']);
	
} # End loop through related docs

if( !empty($relatedDocs) ) { $_SESSION['form']['docs'] = $relatedDocs; }

# ===================================================================================
# General info check
# ===================================================================================
# check for invalid/empty results
if($_SESSION['form']['title'] == '') { $_SESSION['alert']['fields'] .= ",title"; $_SESSION['alert']['message'] .= '<em>You must provide a title.</em><br />'; $errors++; }
if($_SESSION['form']['location'] == '') { $_SESSION['alert']['fields'] .= ",location"; $_SESSION['alert']['message'] .= '<em>You must provide a location.</em><br />'; $errors++; }
if($_SESSION['form']['start_date'] == '') { $_SESSION['alert']['fields'] .= ",start_date"; $_SESSION['alert']['message'] .= '<em>You must provide a start date.</em><br />'; $errors++; }

if( $_SESSION['form']['start_date'] != '' ) {
	if (!(eregi("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $_SESSION['form']['start_date']))) {
		$_SESSION['alert']['fields'] .= ',start_date';
		$_SESSION['alert']['message'] .= '<em>Please format the start date as MM/DD/YYYY.</em><br />';
		$errors++;
	}
}

if( $_SESSION['form']['end_date'] != '' ) {
	if (!(eregi("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $_SESSION['form']['end_date']))) {
		$_SESSION['alert']['fields'] .= ',end_date';
		$_SESSION['alert']['message'] .= '<em>Please format the end date as MM/DD/YYYY.</em><br />';
		$errors++;
	}
}

# if errors, return to the form
if($errors > 0) {
	
	include('p_createListing.php');

} else {
	
	unset($_SESSION['alert']);
	$content = "c_previewListing.php";

}

#echo '<pre>';
#print_r($_SESSION);
#echo '</pre>';
#exit;
?>