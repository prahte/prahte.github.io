<?php
if(isset($_SESSION['admin']['user_id'])) {
?>
<div id="left-nav">

</div>
<? } else { ?>
<script type="text/javascript">
if (document.images)
{
  img1= new Image(150,15); 
  img1.src="<?=homepath?>images/bkgd-navbutton-purpose-on.gif"; 
  img2= new Image(200,50);
  img2.src="<?=homepath?>images/bkgd-callout-merchandise-on.gif";
  img3= new Image(200,50);
  img3.src="<?=homepath?>images/bkgd-callout-competitions-on.gif"; 
}
</script>
<div id="left-nav">
<ul id ="main-nav">
<li id="purpose"><a href="<?=homepath?>purpose/">Our Purpose</a></li>
<li><a href="<?=homepath?>people/">Our People</a></li>
<li><a href="<?=homepath?>facilities/">Our Facilities</a></li>
<li><a href="<?=homepath?>athletes/">Athletes</a></li>
<li><a href="<?=homepath?>news-events/">News Archive</a></li>
<li id="apply"><a href="<?=homepath?>apply/">Apply Now</a></li>
</ul>
<div class="left-callout" id="donation">
<p><a href="<?=homepath?>donation/">The DITC seeks to support athletes across the globe.</a></p>
</div>
<div class="left-callout" id="olympicart">
<a href="<?=homepath?>olympic-art/"><img src="<?=homepath?>images/trans.gif" width="150" height="30" border="0" alt="DITC Olympic Art" /></a>
<p class="hidden">DITC Olympic Art</p>
</div>
<div class="left-callout" id="merchandise">
<a href="<?=homepath?>merchandise/"><img src="<?=homepath?>images/trans.gif" width="150" height="30" border="0" alt="DITC Merchandise" /></a>
<p class="hidden">DITC Merchandise</p>
</div>
<div class="left-callout" id="left-footer">
<a href="http://www.aroundtherings.com/" onclick="window.open('http://www.aroundtherings.com/'); return false;"><img src="<?=homepath?>images/ditc_banner.gif" alt="The Dekalb International Training Center - Dekalb's Sports Authority" width="120" height="240" /></a>
</div>
</div><!-- END left-nav -->
<? } ?>