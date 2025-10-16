<?php
include($_SERVER['DOCUMENT_ROOT'].'/inc/base.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title>The Atlanta Dekalb International Training Center (ATLANTA DITC) - Atlanta GA - The Living Legacy of the 1996 Atlanta Olympic Games - DITC Merchandise</title>
 
<?php include(homepath."/inc/head.inc") ?>

</head>

<body id="top">

<div id="main-container">

<?php include(homepath."/inc/masthead.inc") ?>

<?php include(homepath."/inc/top-nav.inc") ?>

<div id="body-container">

<?php include(homepath."/inc/left-nav.php") ?>

<div id="content">
	<div class="body-header">
		<img src="/images/headerIMG-merchandise.jpg" width="500" height="153" border="0" alt="DITC Merchandise" style="border-bottom: 2px solid #fff;"/>
	</div>
	<div style="clear: both"></div>
	
	<div class="body-section-title"><h3>&nbsp;</h3></div>
	
	<div class="pad20"><!-- START main body content -->
	
	<h6 class="green-text">Go to:</h6>
	<h3 class="anchor-list"><a href="../../../htdocs/merchandise/index.php">Shirts, Sweatshirts &amp; Hats</a> <a href="../../../htdocs/merchandise/bags-backpacks.php">Bags &amp; Backpacks</a> <a href="../../../htdocs/merchandise/artwork-music.php">Artwork, DVDs, and Pins</a></h3>
	
	<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" style="float: right;">
		<input type="hidden" name="cmd" value="_cart" />
		<input type="hidden" name="business" value="merch@ditc.us" />
		<input type="image" src="https://www.paypal.com/en_US/i/btn/view_cart_02_new.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
		<input type="hidden" name="display" value="1" />
	</form>
	
	<h5 class="section-header">BAGS &amp; BACKPACKS</h5>
		
	<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<table border="0" cellspacing="0" cellpadding="0" class="merchandise" >
		<tr>
			<th>ATLANTA DITC Canvas Bag</th>
		</tr>
		<tr>
			<td>
			<img src="../../../htdocs/merchandise/images/ditc-bag.jpg" alt="DITC Canvas Bag" width="142" height="142" border="0" class="float-left t-border" />
			<p class="italic">Size: 14" (wide) x 13" (high)</p>
			<h3>$10.00</h3>
			</td>
		</tr>
		<tr class="blue-bkgd">
			<td class="combined align-center" colspan="2">
				<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
				<input type="hidden" name="add" value="1" />
				<input type="hidden" name="cmd" value="_cart" />
				<input type="hidden" name="business" value="merch@ditc.us" />
				<input type="hidden" name="item_name" value="DITC Canvas Bag" />
				<input type="hidden" name="amount" value="10.00" />
				<input type="hidden" name="no_note" value="1">
				<input type="hidden" name="currency_code" value="USD" />
				<input type="hidden" name="tax" value="0.00" />
				<input type="hidden" name="lc" value="US" />
				<input type="hidden" name="bn" value="PP-ShopCartBF" />
			</td>
		</tr>	
	</table>
	</form>
	
	<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<table border="0" cellspacing="0" cellpadding="0" class="merchandise" >
		<tr>
			<th>DITC/Tunis 2005 Asics Backpack</th>
		</tr>
		<tr>
			<td>
			<a href="#" onmouseover="MM_swapImage('backpack','','../../../htdocs/merchandise/images/ditctunis-backpack-back.jpg',1)" onmouseout="MM_swapImgRestore()"><img src="../../../htdocs/merchandise/images/ditctunis-backpack-front.jpg" alt="DITC Tunis Backpack" width="142" height="142" border="0" class="float-left t-border" id="backpack" /></a>
			<p class="italic">Size: 14" (wide) x 13.5" (high)<br />Color: White</p>
			<h3>$45.00</h3>
			<p class="italic">(roll over image to see reverse side)</p>
			</td>
		</tr>
		<tr class="blue-bkgd">
			<td class="combined align-center" colspan="2">
				<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
				<input type="hidden" name="add" value="1" />
				<input type="hidden" name="cmd" value="_cart" />
				<input type="hidden" name="business" value="merch@ditc.us" />
				<input type="hidden" name="item_name" value="DITC/Tunis 2005 Asics Backpack" />
				<input type="hidden" name="amount" value="45.00" />
				<input type="hidden" name="no_note" value="1">
				<input type="hidden" name="currency_code" value="USD" />
				<input type="hidden" name="tax" value="0.00" />
				<input type="hidden" name="lc" value="US" />
				<input type="hidden" name="bn" value="PP-ShopCartBF" />
			</td>
		</tr>	
	</table>
	</form>
	
	<p class="top-anchor">&#8593; <a href="#top">BACK TO TOP</a></p>
			
	</div><!-- END main body content -->
	
</div><!-- END content -->
<?php include(homepath."/inc/right-sidebar.inc") ?>		
<div class="body-clear"></div>		
</div><!-- END body-container -->
</div><!-- END main-container -->
<?php include(homepath."/inc/footer.inc") ?>
<?php include(homepath."/inc/ga.inc") ?>
</body>
</html>