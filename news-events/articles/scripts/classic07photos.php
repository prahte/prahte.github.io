<?php
$dir = "photos/DekalbClassic07Photos";

$files_array = array();

if (is_dir($dir)) {
// open directory stream
if ($dir_handler = opendir($dir)) { 
	// loop thru files in directory & count
	while (($file = readdir($dir_handler)) != false) {
		// push all files except . and .. onto array
		if (($file != ".") && ($file != ".."))
			array_push($files_array, $file);
	}
}
// close directory stream
closedir($dir_handler);
sort($files_array);
?>
<?php if(!empty($files_array)) { ?>
<h4 class="green-text clear-float">ADDITIONAL PHOTOGRAPHS</h4>

<p class="italic">Click on an image to view a larger version.</p>

<table border="0" width="100%" cellspacing="0" cellpadding="0" id="galleryTable">
<?php
$cell_count = 0;
$cell_reset = 0;
$total = 0;
for ($i=0; $i<count($files_array); $i++) {
?>
<?php $total++; ?>
<?php if($cell_reset == 0) { echo("<tr>"); }?>
	<td class="align-center">
		<?php list($w, $h) = getimagesize($dir."/".$files_array[$i]);
		if($w > 50) { $width = 50; $height = round(($h * $width)/($w)); } else { $width = $w; $height = $h; } ?>
		<a href="<?=$dir?>/<?=$files_array[$i]?>" rel="lightbox[DIPCphotos07]" title="The Dekalb International Prep Classic - May 19, 2007"><img src="<?=$dir?>/<?=$files_array[$i]?>" width="<?=$width?>" height="<?=$height?>" alt="" border="0" /></a>
		<?php #echo("<br>".$total); ?>
	<?php if($total == count($files_array) ) {
		if($cell_count == 0) { echo("</td><td>&nbsp;</td><td>&nbsp;</td>"); }
		if($cell_count == 1) { echo("</td><td>&nbsp;</td>"); }
		if($cell_count == 2) { echo("</td>"); }
	} else { echo("</td>"); } ?>
<?php 
$cell_count++;
$cell_reset++; 
if($cell_count == 3 || $total == count($files_array)) { $cell_reset = 0; $cell_count = 0; echo("</tr>"); }  ?>
<?php ; } ?>
</table>
<?php } ?>
<?php } ?>