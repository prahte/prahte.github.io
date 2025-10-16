<?php
echo '<p>Fill in the appropriate information below and click on the "Save" button at the bottom. Listings are ranked by the <strong>competition date</date>, but only the year is displayed. All fields are required.</p>';
echo '<form action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" method="post" enctype="multipart/form-data">';
echo '<h4 class="kerned uppercase trebuchet blue-text">Competition Information</h4>';
echo "<fieldset>\n";
echo "<div class=\"pad5 t-border\">\n";
echo '<p class="clearfix '.$class['comp_title'].'"><label for="comp_title" class="bold">Competition Title:</label><input name="comp_title" id="comp_title" class="textfield" type="text" value="'.intl_clean($_SESSION['form']['comp_title'],1,0).'" /></p>'; 
echo '<p class="clearfix '.$class['comp_location'].'"><label for="comp_location" class="bold">Competition Location:</label><input name="comp_location" id="comp_location" class="textfield" type="text" value="'.intl_clean($_SESSION['form']['comp_location'],1,0).'" /></p>'; 
echo '<p class="clearfix '.$class['comp_date'].'" id="dateWrapper"><label for="compMonth" class="bold">Competition Date:</label>';
echo '<strong>Month:</strong> <select id="compMonth" name="compMonth">';
for($i=1;$i<13;++$i) {
	echo '<option value="'.$i.'"';
	if( date('n',strtotime($_SESSION['form']['comp_date'])) == $i ) {
		echo ' selected="selected"';
	}
	echo '>'.date('M',strtotime($i.'/1/2000')).'</option>';
}
echo '</select>';
echo '<strong>Day:</strong> <select id="compDay" name="compDay">';
for($i=1;$i<32;++$i) {
	echo '<option value="'.$i.'"';
	if( date('j',strtotime($_SESSION['form']['comp_date'])) == $i ) {
		echo ' selected="selected"';
	}
	echo '>'.$i.'</option>';
}
echo '</select>';
echo '<strong>Year:</strong> <select id="compYear" name="compYear">';
for($i=1999;$i<(date('Y') +3);++$i) {
	echo '<option value="'.$i.'"';
	if( date('Y',strtotime($_SESSION['form']['comp_date'])) == $i ) {
		echo ' selected="selected"';
	}
	echo '>'.$i.'</option>';
}
echo '</select>';
echo '</p>';
echo "</div>\n";
echo "</fieldset>\n";
echo '<fieldset class="p-border gray-bkgd-fade align-center">';
echo '<input name="submit" type="submit" value="Save" class="button" /> <input name="submit" type="submit" value="Cancel" class="button" />';
echo '</fieldset>';
echo "</form>\n";
echo "</div>\n";
echo '<div id="admin-sidebar"></div>';
unset($_SESSION['form']);
unset($_SESSION['alert']);
?>