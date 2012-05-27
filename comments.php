<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments', 'blank') ?>.</p>

			<?php
			return;
		}
	}
?>
<?php if (function_exists('wp_list_comments')) : //if WP version 2.7 display this ?>


	<?php if ( have_comments() ) : //if comments open and there are comments to show, display this ?>
 
		<?php if ( ! empty($comments_by_type['comment']) ) : ?>
        
 <li><h3 id="comments"><?php comments_number();?></h3></li>

  <ul class="commentlist"><!-- display omments -->
 
       	<?php wp_list_comments('callback=custom_comment&type=comment'); //'custom_comment' are edited in [themes/blank/functions.php] ?></ul>

        <div class="navigation comment-nav">
        <!-- if paged comments/pings are enabled in admin -->
        <div class="nav-prev"><?php previous_comments_link() ?></div>
        <div class="nav-next"><?php next_comments_link() ?></div>
        </div>
        
<?php endif; ?>

<ul class="pinglist"><!-- display trackbacks -->


	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
    
 	<li><h3 id="pings"><?php _e('Trackbacks', 'blank') ?></h3></li>
   
		<?php wp_list_comments('callback=custom_pings&type=pings'); //'custom_pings' are edited in [...themes/blank/functions.php] ?></ul>
	
    <div class="navigation comment-nav"> 
	<!-- if paged comments/pings are enabled in admin -->
	<div class="nav-prev"><?php previous_comments_link() ?></div>
	<div class="nav-next"><?php next_comments_link() ?></div>
	</div>

	<?php endif; ?>

<?php else : ?>
	
	<?php if ('open' == $post->comment_status) :
	// If comments are open but there are no comments yet, display this
		else : 	
	// if comments are closed display this
		endif;
	endif; ?>

<?php else : //if WP version prior to 2.7 ?>
			
	<?php return; $oddcomment = 'class="alt" '; /* This variable is for alternating comment background */ ?>

<?php if ($comments) : //if there are comments to show, display this ?>

	<h2 id="comments"><?php comments_number( __('No responses to', 'blank'), __('One response to', 'blank'), __('% responses to', 'blank'));?> <em><?php the_title(); ?></em></h2>
    
	<ol class="commentlist">
    
	<?php foreach ($comments as $comment) : ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 32 ); ?>
			<?php comment_author_link() ?>
			<?php if ($comment->comment_approved == '0') : ?>
			<em><?php _e('Your comment is awaiting moderation', 'blank'); ?>.</em>
			<?php endif; ?>
			<br />

			<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F j, Y') ?> <?php _e('at', 'blank'); ?> <?php comment_time() ?></a> <?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?></small>

			<?php comment_text() ?>
		
        </li>

	<?php /* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : ''; ?>

	<?php endforeach; /* end for each comment */ ?>
    
	</ol>

 <?php else : ?>
 
 <!-- // this is displayed if there are no comments so far -->

	<?php if ('open' == $post->comment_status) : ?>
		
        <!-- If comments are open, but there are no comments to show. -->

	 <?php else : ?>
		
		<!-- if comments are cosed -->
        <p class="nocomments"><?php _e('Comments are closed', 'blank'); ?>.</p>

	<?php endif; ?>
    
<?php endif; ?>

<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<div id="cancel-comment-reply"><small><?php cancel_comment_reply_link( __('Cancel reply', 'blank')) ?></small></div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p><?php _e('You must be', 'blank'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'blank'); ?></a> <?php _e('to post a comment', 'blank'); ?>.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p><?php _e('Logged in as', 'blank'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out', 'blank'); ?>"><?php _e('Log out', 'blank'); ?> &raquo;</a></p>

<?php else : ?>

		<p id="comment-notes"><?php _e('Your email is never shared', 'blank' ) ?>.<br />
		<?php if ($req) _e('Required fields are marked <span class="required">*</span>', 'blank' ) ?></p>
                             
<p>
<label for="author"><?php _e('Name', 'blank' ) ?> <?php if ($req) echo '*'; ?></label><br />
<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" class="text<?php if ($req) echo ' required'; ?>" />
</p>

<p>
<label for="email"><?php _e('Email', 'blank' ) ?> <?php if ($req) echo '*'; ?></label><br />
<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" class="text<?php if ($req) echo ' required'; ?>" />
</p>

<p>
<label for="url"><?php _e('Website', 'blank' ) ?></label><br />
<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
</p>

<?php endif; ?>

<div>
<?php comment_id_fields(); ?>
<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />
</div>

<p><textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Send', 'blank') ?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

</div><!-- end #respond -->

<?php endif; // if you delete this the sky will fall on your head ?>
