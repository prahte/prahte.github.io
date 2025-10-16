<?php
/*echo '<pre>';
print_r($_SESSION);
echo '</pre>';
exit;*/

# set asset flag value
if( !empty($_SESSION['form']['assetsArray']) ) { $asset_flag = 1; } else { $asset_flag = 0; }

if( isset($_REQUEST['pID']) ) {
# =====================================================================================
# Updating an existing entry
# =====================================================================================
    $query = sprintf("UPDATE blogs_posts SET post_title = '%s', post_content = '%s', user_id = '%d', asset_flag = '%d', post_date = '%s', update_date = '%s' WHERE id = '%d'",
             mysql_real_escape_string($_SESSION['form']['post_title']),
             mysql_real_escape_string($_SESSION['form']['post_content']),
             mysql_real_escape_string($_SESSION['form']['user_id']),
             mysql_real_escape_string($asset_flag),
             mysql_real_escape_string($_SESSION['form']['post_date']),
             mysql_real_escape_string(date('Y-m-d H:i:s')),
             mysql_real_escape_string($_REQUEST['pID']));
    $do = db_update(DITCDB,$query);
    
    if($do < 0) { 
        $_SESSION['alert']['type'] = 'red';
        $_SESSION['alert']['message'] = 'There was a problem updating the blog entry. Please try again.';
        include('p_previewListing.php');
        exit;
    }
    
    #delete previous assets
    $query = "DELETE FROM blogs_assets WHERE post_id = ".$_REQUEST['pID'];
    $do = db_update(DITCDB,$query);
    
    # insert assets
    if( !empty($_SESSION['form']['assetsArray']) ) {
        
        $limit = count($_SESSION['form']['assetsArray']);
        for($i=0; $i<$limit; $i++) {
            $query = sprintf("INSERT INTO blogs_assets (blog_id,post_id,file,thumbnail,caption,type) VALUES('%d','%d','%s','%s','%s','%s')",
            mysql_real_escape_string($_REQUEST['bID']),
            mysql_real_escape_string($_REQUEST['pID']),
            mysql_real_escape_string($_SESSION['form']['assetsArray'][$i]['file']),
            mysql_real_escape_string($_SESSION['form']['assetsArray'][$i]['thumbnail']),
            mysql_real_escape_string($_SESSION['form']['assetsArray'][$i]['caption']),
            mysql_real_escape_string('jpg'));
            $do = db_insert(DITCDB,$query);
        }
    }

} else {
# =====================================================================================
# Entering a new entry
# =====================================================================================
    $query = sprintf("INSERT INTO blogs_posts (blog_id,user_id,post_title,post_content,asset_flag,post_date) VALUES('%d','%d','%s','%s','%d','%s')", 
    mysql_real_escape_string($_REQUEST['bID']),
    mysql_real_escape_string($_SESSION['form']['user_id']),
    mysql_real_escape_string($_SESSION['form']['post_title']),
    mysql_real_escape_string($_SESSION['form']['post_content']),
    mysql_real_escape_string($asset_flag),
    mysql_real_escape_string($_SESSION['form']['post_date']));
    $do = db_insert(DITCDB,$query);
    
    if($do < 0) { 
        $_SESSION['alert']['type'] = 'red';
        $_SESSION['alert']['message'] = 'There was a problem creating the entry. Please try again.';
        include('p_previewListing.php');
        exit;
    }
    
    # insert assets
    if( !empty($_SESSION['form']['assetsArray']) ) {
        
        $limit = count($_SESSION['form']['assetsArray']);
        for($i=0; $i<$limit; $i++) {
            $query = sprintf("INSERT INTO blogs_assets (blog_id,post_id,file,thumbnail,caption,type) VALUES('%d','%d','%s','%s','%s','%s')",
            mysql_real_escape_string($_REQUEST['bID']),
            mysql_real_escape_string($do),
            mysql_real_escape_string($_SESSION['form']['assetsArray'][$i]['file']),
            mysql_real_escape_string($_SESSION['form']['assetsArray'][$i]['thumbnail']),
            mysql_real_escape_string($_SESSION['form']['assetsArray'][$i]['caption']),
            mysql_real_escape_string('jpg'));
            $assetDO = db_insert(DITCDB,$query);
        }
    }
    
}

unset($_SESSION['form']); unset($_SESSION['alert']);
$_SESSION['alert']['type'] = 'green';
if( isset($_REQUEST['pID']) ) {
    $_SESSION['alert']['message'] = 'Blog entry successfully updated!';
} else {
    $_SESSION['alert']['message'] = 'Blog entry successfully created!';
}
header('Location:index.php?bID='.$_REQUEST['bID']);
?>