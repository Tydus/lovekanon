<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php if (is_home()) {
	echo bloginfo('name'); echo " &#8211; "; echo bloginfo('description');
} elseif (is_404()) {
	echo '404 Not Found';
}
else {
	echo bloginfo('name'); echo wp_title('&#8211;');
}
?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script type="text/javascript">
<!--//--><![CDATA[//><!--
sfHover = function() {
	if (!document.getElementsByTagName) return false;
	var sfEls = document.getElementById("nav").getElementsByTagName("li");


	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}

}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]>
</script>
<style type="text/css">
<?php
$desu_logo_url = get_option('x21_logo_url');
if ($desu_logo_url == "") {
/*
echo "#header h1 a {background: url(";
echo get_bloginfo('template_url');
#echo "/images/logo.png) no-repeat right bottom;}";
echo "/sprites.png) no-repeat -703px -273px;}";
*/
echo "#header h1 a {background: url(//tydus.googlecode.com/files/sprites.png) no-repeat -703px -273px;}";
}
else { 
echo "#header h1 a {background: url(".$desu_logo_url.") no-repeat right bottom;}";
}
?>
</style>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> <!-- enables nested comments in WP 2.7 -->
<?php wp_head(); //leave for plugins ?>
</head>
<?php
$this_exclude_pages = get_option('x21_exclude_pages');
$this_exclude_categories = get_option('x21_exclude_categories');
 ?>
<body>
<div id="wrapper"> <!-- #wrapper ends in footer.php -->

<div id="header">
<h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
<ul><li><h2><span><?php bloginfo('description'); ?></span></h2></li></ul>
<a href="<?php bloginfo('rss2_url'); ?>" id="rsslink" title="<?php _e('Entries (RSS)', 'blank'); ?>"></a>
</div><!-- end #header -->
<div id="topnav">
<ul>
<li id="first-item"<?php if(is_home()) { ?> class="current_page_item"<?php } ?>><a href="<?php bloginfo('url'); ?>">Home</a></li>
<?php wp_list_pages('title_li=0&exclude='.$this_exclude_pages.'&depth=1'); ?>
</ul>

<form method="get" id="searchformrel" action="<?php bloginfo('url'); ?>/">
<fieldset><input type="text" value="<?php _e('Search'); ?>" onfocus="if (this.value == '<?php _e('Search'); ?>') {this.value='';}; return true;" onblur="if (this.value == '') {this.value='<?php _e('Search'); ?>';}; return true;" name="s" id="s" />
<input type="submit" id="searchsubmit" value="<?php _e('Search'); ?>" />
</fieldset>
</form>

</div>

<div id="topcat">
<ul id="nav">
<?php wp_list_categories('title_li=0&exclude='.$this_exclude_categories.'&hierarchical=1'); ?>
</ul>
</div>
