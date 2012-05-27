<?php load_theme_textdomain('blank'); ?>
<?php /*Start of Theme Options*/
 
$themename = "Visual";
$shortname = "x21";
$options = array (
 
array( "name" => "Anime Heaven",
	"type" => "title"),
 
array( "type" => "open"),

array(  "name" => "Custom Logo",
        "desc" => "Enter your logo URL (253 x 108). Logo template included in theme package and located in FILES folder.",
        "id" => $shortname."_logo_url",
        "std" => "",
        "type" => "text"),

array(  "name" => "Pages to exclude",
        "desc" => "Select the ID&rsquo;s that you would like to exclude from the top menu (Separate with commas).",
        "id" => $shortname."_exclude_pages",
        "std" => "",
        "type" => "text"),
		
array(  "name" => "Categories to exclude",
        "desc" => "Select the ID&rsquo;s that you would like to exclude from the category list located under the main banner (Separate with commas).",
        "id" => $shortname."_exclude_categories",
        "std" => "",
        "type" => "text"),
		
array( "type" => "close")
 
);
function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
if ( 'save' == $_REQUEST['action'] ) {
 
foreach ($options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
header("Location: themes.php?page=functions.php&saved=true");
die;
 
} else if( 'reset' == $_REQUEST['action'] ) {
 
foreach ($options as $value) {
delete_option( $value['id'] ); }
 
header("Location: themes.php?page=functions.php&reset=true");
die;
 
}
}
 
add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
 
}
 
function mytheme_admin() {
 
global $themename, $shortname, $options;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
 
?><div class="wrap">
<h2><?php echo $themename; ?> Settings</h2>
 
<form method="post">
 
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
<table width="100%" border="0" style="padding:10px;">
 
<?php break;
 
case "close":
?> 
</table><br /> 
<?php break;
 
case "title":
?>
<table width="100%" border="0" style="padding:5px 10px;"><tr>
<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
</tr> 
<?php break;
 
case 'text':
?> 
<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
</tr>
 
<tr>
<td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
<?php
break;
 
case 'textarea':
?> 
<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea></td>
 
</tr>
 
<tr>
<td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
<?php
break;
 
case 'select':
?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
</tr>
 
<tr>
<td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
<?php
break;
 
case "checkbox":
?>
<tr>
<td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
<td width="80%"><?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
</td>
</tr>
 
<tr>
<td><small><?php echo $value['desc']; ?></small></td>
</tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr> 
<?php break;
 
}
}
?><p class="submit">
<input name="save" type="submit" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form> 
<?php
}
add_action('admin_menu', 'mytheme_add_admin');
 ?>
<?php
if ( function_exists('register_sidebar') )
	register_sidebars(array(
		'name'=>'Sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',
    ));
?>
<?php function custom_comment($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID( ); ?>">
<?php echo get_avatar( $comment, 32 ); ?>
<?php comment_author_link() ?> <?php _e('says', 'blank'); ?>:

<?php if ($comment->comment_approved == '0') : //message if comment is held for moderation ?>
<em><?php _e('Your comment is awaiting moderation', 'blank'); ?>.</em>
<?php endif; ?>
<br />
<small class="commentmetadata">
<?php comment_date('l, j F, Y') ?> <?php _e('at', 'blank'); ?> <?php comment_date('G:i') ?><?php edit_comment_link( __('Edit', 'blank'),' &nbsp;|&nbsp; ',''); ?></small>
<br />
	<?php comment_text() ?>
 <div class="reply">
<?php echo comment_reply_link(array('reply_text' => __('Reply', 'blank'), 'depth' => $depth, 'max_depth' => $args['max_depth']));  ?>
</div>
<?php } ?>
<?php function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID( ); ?>">
     <?php _e('Trackback from', 'blank'); ?> <em><?php comment_author_link() ?></em>
     <br /><small><?php comment_date('l, j F, Y') ?></small>
     <br /><?php comment_text() ?>
     <?php edit_comment_link( __('Edit', 'blank'),'<br /> &nbsp;|&nbsp; ',''); ?>
<?php } ?>
