<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="posts-wrap"> 

		
        
<div class="post" id="post-single">
		
		<h2 class="entry-title" id="entry-title-single"><?php the_title(); ?></h2>

			<div class="entry-content" id="entry-content-single">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
                <?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number')); ?>
                	</div><!-- end .entry-content -->
				
			
			<div class="entry-meta" id="entry-meta-single">
              	<?php the_tags( __('Tags: ', 'blank'), ", ", " <br />" ) ?>
                  	
					<?php _e('Category: ', 'blank'); ?><?php the_category(', ') ?> <br />
					
						<?php _e('This entry was posted', 'blank'); ?> <?php the_time('l, j F, Y') ?> <?php _e('at ', 'blank'); ?> <?php the_time() ?>	<br />
                                   
						<?php _e('You can follow any responses to this entry via', 'blank'); ?> <?php post_comments_feed_link('RSS'); ?>.<br />

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open ?>
							<?php _e('You can', 'blank'); ?><a href="#respond"> <?php _e('leave a comment', 'blank'); ?></a> <?php _e('or', 'blank'); ?> <a href="<?php trackback_url(); ?>" rel="trackback"><?php _e('trackback', 'blank'); ?></a> <?php _e('from your own site', 'blank'); ?>.

						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
				// Only Pings are Open ?>
							<?php _e('Comments are currently closed, but you can', 'blank'); ?> <a href="<?php trackback_url(); ?> " rel="trackback"><?php _e('trackback', 'blank'); ?></a> <?php _e('from your own site', 'blank'); ?>.

						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not ?>                            
							<?php _e('You can skip to the end to leave a comment. Trackbacks are currently not allowed.', 'blank'); ?>
                            
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open ?>
							<?php _e('Both comments and trackbacks are currently closed.', 'blank'); ?>
                            
                            <?php } edit_post_link( __('Edit'), ' | ', ''); ?>
						
					</div> <!-- end .entry-meta -->
				
</div><!-- end .post -->		
		
	<?php comments_template('', true); ?>

	<?php endwhile; else: ?>

		<?php _e('Sorry, no posts matched your criteria', 'blank'); ?>.

<?php endif; ?>
 </div><!-- end .posts-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
