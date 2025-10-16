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
# Asset checks
# ===================================================================================
$assetsArrayNew = array();

for($i=0; $i<10; $i++) {
    if($_FILES['asset_'.$i.'_new']['name'] != '') {
        
        //$_SESSION['form']['photo_1'] = $_FILES['photo_1New']['name'];
        
        # create array from file name to determine proper extension
        $photoTypeArray = explode(".", $_FILES['asset_'.$i.'_new']['name']);
        $xtension = ( (count($photoTypeArray))-1 );
        
        # check to make sure it's not over 1000000 bytes (1MBk)
        if($_FILES['asset_'.$i.'_new']['name'] <= 1000000) {
        
            # make sure it's a jpg or gif
            if( strtolower($photoTypeArray[$xtension] != 'jpg') ) {
                # if not, set up error message/fields
                $_SESSION['alert']['message'] .= '- Photo '.($i + 1).' must be a ".jpg" file type.<br />';
                $_SESSION['alert']['fields'] .= ",assets,photo".$i;
                if( isset($_SESSION['form']['asset_'.$i.'_file_old']) ) { array_push($assetsArrayNew, array('file' => $_SESSION['form']['asset_'.$i.'_file_old'], 'thumbnail' => $_SESSION['form']['asset_'.$i.'_thumb_old'], 'caption' => $_SESSION['form']['asset_'.$i.'_caption']) ); }
                $errors++;
            } else {
                # else, the file checks out as a jpg, rename it, resize it, and move it to the proper location
                $FullPhotoName = 'b_'.$_REQUEST['bID'].'_F'.$i.'_'.date('YmdHis').'.'.$photoTypeArray[$xtension];
                # check to make sure file uploaded ok and set the session value for the name of the file to be the file that was just uploaded
                if (move_uploaded_file($_FILES['asset_'.$i.'_new']['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$FullPhotoName)) {
                    
                    # set up thumbnail name, create file from full size version
                    $PhotoName = 'b_'.$_REQUEST['bID'].'_P'.$i.'_'.date('YmdHis').'.jpg';
                    $ThumbName = 'b_'.$_REQUEST['bID'].'_T'.$i.'_'.date('YmdHis').'.jpg';
                    
                    $pic = @imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].'/news-events/articles/photos/'.$FullPhotoName);
                    $picWidth = imagesx($pic);
                    $picHeight = imagesy($pic);
                    
                    # thumbnail image resize
                    $thumb = @imagecreatetruecolor (50, 50) or die ('Can not create thumb image '.$i.'!');
                    
                    if ($picWidth < $picHeight) {
                            $twidth = 50;
                            $theight = $twidth * $picHeight / $picWidth;
                            imagecopyresized($thumb, $pic, 0, 0, 0, ($picHeight/2)-($picWidth/2), $twidth, $theight, $picWidth, $picHeight);
                    } else {
                            $theight = 50;
                            $twidth = $theight * $picWidth / $picHeight;
                            imagecopyresized($thumb, $pic, 0, 0, ($picWidth/2)-($picHeight/2), 0, $twidth, $theight, $picWidth, $picHeight);
                    }
                    imagejpeg ($thumb, $_SERVER['DOCUMENT_ROOT'].'/news-events/articles/photos/'.$ThumbName, 100);
                    
                    # photo image resize
                    if($picWidth > 300) { $photoWidth = 300; } else { $photoWidth = $picWidth; }
                    $photoHeight = round( (($photoWidth * $picHeight)/$picWidth) );
                    $photo = @imagecreatetruecolor ($photoWidth, $photoHeight) or die ('Can not create file image '.$i.'!');
                    imagecopyresized($photo, $pic, 0, 0, 0, 0, $photoWidth, $photoHeight, $picWidth, $picHeight);
                    
                    imagejpeg ($photo, $_SERVER['DOCUMENT_ROOT'].'/news-events/articles/photos/'.$PhotoName, 100);
                    
                    array_push($assetsArrayNew, array('file' => $PhotoName, 'thumbnail' => $ThumbName, 'caption' => $_SESSION['form']['asset_'.$i.'_caption']) );
                    
                    @unlink($_SERVER['DOCUMENT_ROOT']."/news-events/articles/photos/".$FullPhotoName);
                    
                } else {
                    $_SESSION['alert']['message'] .= '- There was an error uploading Photo '.($i + 1).'.<br />';
                    $_SESSION['error']['fields'].=',assets,photo'.$i;
                    if( isset($_SESSION['form']['asset_'.$i.'_file_old']) ) { array_push($assetsArrayNew, array('file' => $_SESSION['form']['asset_'.$i.'_file_old'], 'thumbnail' => $_SESSION['form']['asset_'.$i.'_thumb_old'], 'caption' => $_SESSION['form']['asset_'.$i.'_caption']) ); }
                    $errors++;
                }
            }
            
        } else {
            $_SESSION['alert']['message'] .= '<em>Photo '.$i.' is larger than 1MB. Please resize photo '.($i + 1).'.</em><br />';
            $_SESSION['alert']['fields'] .= ',assets,photo'.$i;
            if( isset($_SESSION['form']['asset_'.$i.'_file_old']) ) { array_push($assetsArrayNew, array('file' => $_SESSION['form']['asset_'.$i.'_file_old'], 'thumbnail' => $_SESSION['form']['asset_'.$i.'_thumb_old'], 'caption' => $_SESSION['form']['asset_'.$i.'_caption']) ); }
            $errors++; 
        }
        
    } else {
    
        if( !isset($_SESSION['form']['asset_'.$i.'_delete']) && $_SESSION['form']['asset_'.$i.'_file_old'] != '') {
            array_push($assetsArrayNew, array('file' => $_SESSION['form']['asset_'.$i.'_file_old'], 'thumbnail' => $_SESSION['form']['asset_'.$i.'_thumb_old'], 'caption' => $_SESSION['form']['asset_'.$i.'_caption']) );
        }
        
    }
}

$_SESSION['form']['assetsArray'] = $assetsArrayNew;

/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';
exit;*/

# ===================================================================================
# General info check
# ===================================================================================
# check for invalid/empty results
if($_SESSION['form']['post_title'] == '') { $_SESSION['alert']['fields'] .= ",title"; $_SESSION['alert']['message'] .= '<em>You must provide a title for this blog entry.</em><br />'; $errors++; }
if($_SESSION['form']['post_content'] == '') { $_SESSION['alert']['fields'] .= ",location"; $_SESSION['alert']['message'] .= '<em>You must provide content for this blog entry.</em><br />'; $errors++; }

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