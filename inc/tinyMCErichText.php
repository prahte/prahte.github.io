<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "exact",
	elements : "<?php print $richTextAreas; ?>",
	theme : "advanced",
	plugins : "fullscreen",
	theme_advanced_buttons1 : "bold,italic,underline,separator,link,unlink,separator,code,separator,formatselect,separator,styleselect,separator,fullscreen",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_blockformats : "p,h4",
	content_css : "/styles/ditc-tinyMCE.css",
	verify_css_classes : true
});
</script>