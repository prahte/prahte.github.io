<h4 class="blue-text"><?=$_SESSION['form']['blogTitle']?></h4>

<p>Below is a preview of your blog entry. To save it, click the <strong>Save</strong> button. To make changes, click the <strong>Go Back</strong> button.</p>

<hr class="clear-float"/>

<h4 class="blue-text"><?=intl_clean($_SESSION['form']['post_title'],0,1)?></h4>

<?php
$userInfoQuery = "SELECT fname, lname FROM users WHERE id = ".$_SESSION['form']['user_id'];
$userInfo = db_select(DITCDB, $userInfoQuery);
$_SESSION['form']['post_date'] = date('Y-m-d',strtotime($_SESSION['form']['post_day'])).' '.date('H:i:00',strtotime($_SESSION['form']['post_time']));
$date = date('M j, Y \a\t g:i a',strtotime($_SESSION['form']['post_date']));
?>

<p class="light-gray italic">Posted By: <?=intl_clean($userInfo[0]['fname'],0,1).' '.intl_clean($userInfo[0]['lname'],0,1)?> on <?=$date?></p>

<?php
if(substr($_SESSION['form']['post_content'],0,2) != '<p' && substr($_SESSION['form']['post_content'],0,2) != '<h') {
    $_SESSION['form']['post_content'] = '<p>'.$_SESSION['form']['post_content'].'</p>';
}
echo intl_clean($_SESSION['form']['post_content'],0,0);
?>
 
<?php if( !empty($_SESSION['form']['assetsArray'][0]) ) {
    echo "<h5 class=\"blue-text\">Related Photos</h5>\n";
    echo "<p class=\"light-gray italic\">Click on a photo for a larger version.</p>";
    echo "<ul class=\"clearfix\">\n";
    for($i=0; $i<10; $i++) {
        if( $_SESSION['form']['assetsArray'][$i]['file'] != '' ) {
            echo '<li class="float-left pad5">';
            echo '<a class="lightbox" href="/news-events/articles/photos/'.$_SESSION['form']['assetsArray'][$i]['file'];
            echo '" rel="photos" ';
            echo 'title="'.intl_clean($_SESSION['form']['assetsArray'][$i]['caption'],0,0);
            echo '"><img src="/news-events/articles/photos/'.$_SESSION['form']['assetsArray'][$i]['thumbnail'];
            echo '" class="p-border" width="50" /></a></li>';
        }
    }
    echo "</ul>\n";
}
?>

<hr />

<!--<pre>
</pre>-->

<form action="<?=$_SERVER['PHP_SELF']?>?<?=$_SERVER['QUERY_STRING']?>" method="post" enctype="multipart/form-data">
<fieldset class="p-border gray-bkgd-fade align-center clear-float">
<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Go Back" class="button" /> 
</fieldset>
</form>
	
</div><!-- END #content -->

<div id="admin-sidebar">



</div>