<?php
include('../../includes/global/constants.php');
include(homepath.'includes/global/functions.php');

/**
* Ugly fix for stripping out fancy quotes, em dashes, etc.
* @param string $string The string needing to be 'cleaned'
*/
function cleanInvalidRSSChars($string) {
    $encoded = stripslashes($string);
	$encoded = str_replace (chr(145), '\'', $encoded); // left single quote
	$encoded = str_replace (chr(146), '\'', $encoded); // right single quote
	$encoded = str_replace (chr(147), '"', $encoded); // left double quote
	$encoded = str_replace (chr(148), '"', $encoded); // right double quote
	$encoded = str_replace (chr(233), 'e', $encoded); // accented e
	$encoded = str_replace (chr(150), '-', $encoded); // en dash
	$encoded = str_replace (chr(151), '-', $encoded); // em dash
	$encoded = str_replace ('&nbsp;', '', $encoded); // em dash
	return htmlentities($encoded);
}

header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "\n";

/* Pull in posts */
include(homepath.'includes/global/ditcdbConnect.php');
$blogPostsQuery = "SELECT p.id, p.blog_id, p.user_id, p.post_title, p.post_content, p.asset_flag, p.comment_flag, p.post_date, u.fname, u.lname
				   FROM blogs_posts AS p, users AS u 
				   WHERE
				   p.blog_id = 1
				   AND
				   u.id = p.user_id
				   ORDER BY p.post_date DESC";
$result = mysql_query($blogPostsQuery);
for($i=0;$i<mysql_num_rows($result);$i++) {
	$posts[$i] = mysql_fetch_assoc($result);
}
$limit = count($posts);
?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>ATLANTA Dekalb International Training Center (ATLANTA DITC) Beijing Games Blog</title>
<link>http://ditc.us/beijing/</link>
<atom:link href="http://<? echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>" rel="self" type="application/rss+xml" />
<description>An ongoing report from the ATLANTA Dekalb International Training Center (ATLANTA DITC) during the Beijing Games</description>
<language>en-us</language>
<copyright>Copyright <?=date('Y')?>, The ATLANTA Dekalb International Training Center (ATLANTA DITC)</copyright>
<webMaster>webmaster@ditc.us (ATLANTA DITC Master)</webMaster>
<pubDate><? echo(date('D, d M Y')) ?> <? echo("08:00:00 EST") ?></pubDate>
<lastBuildDate><?=date('D, d M Y H:i:s T', strtotime($posts[0]['post_date']))?></lastBuildDate>
<category>Blog Posts</category>
<generator>ATLANTA DITC</generator>
<docs>http://blogs.law.harvard.edu/tech/rss/</docs>
<? for ($i=0; $i<$limit; $i++) { ?>
<item>
<title><?=intl_clean(cleanInvalidRSSChars($posts[$i]['post_title']),0,0)?></title>
<link>http://ditc.us/beijing/post.php?pID=<?=$posts[$i]['id']?></link>
<description><?=intl_clean(strip_tags(cleanInvalidRSSChars($posts[$i]['post_content'])),0,1)?></description>
<content:encoded>
<![CDATA[
<?=intl_clean($posts[$i]['post_content'],0,1)?>
]]>
</content:encoded>
<pubDate><?=date('D, d M Y H:i:s T', strtotime($posts[$i]['post_date']))?></pubDate>
<dc:creator>
<?=intl_clean($posts[$i]['fname'],0,0).' '.intl_clean($posts[$i]['lname'],0,0)?>
</dc:creator>
<guid isPermaLink="true">http://ditc.us/beijing/post.php?pID=<?=$posts[$i]['id']?></guid>
</item>
<?php } ?>
</channel>
</rss>