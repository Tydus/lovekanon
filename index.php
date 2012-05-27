<?php get_header(); ?>

	<?php if (have_posts()) : ?>
<div class="posts-wrap"> 

		<?php while (have_posts()) : the_post(); ?>
	
    <div class="post post-index" id="post-<?php the_ID(); ?>">
    
        <h2 class="entry-title index-entry-title">
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h2>

				<div class="additional-meta"><?php the_time('l, j F, Y') ?></div>
			
            <div class="entry-content entry-content-index">
					<?php the_excerpt( __('Read the rest of this entry &raquo;', 'blank')); ?>
			</div><!-- end .entry-content -->
            
     <div class="entry-meta entry-meta-index">
	
    	<?php the_tags( __('Tags: ', 'blank'), ", ", " ") ?>
        <?php _e('Category: ', 'blank'); ?><?php the_category(', ') ?>
        
		<?php comments_popup_link( __( 'Comments (0)', 'blank' ), __( 'Comments (1)', 'blank' ), __( 'Comments (%)', 'blank' ), 'comments-link', __('Comments closed', 'blank')); ?>
        
        <?php edit_post_link( __('Edit'), ' | ', ''); ?>
 
      </div><!-- end .entry-meta -->
     </div><!-- end .post -->
        
		<?php endwhile; ?>
        
		<div class="navigation navigation-index">
			<div class="nav-prev"><?php next_posts_link( __('&laquo; Older Entries', 'blank')) ?></div>
			<div class="nav-next"><?php previous_posts_link( __('Newer Entries &raquo;', 'blank')) ?></div>
		</div>

	<?php else : ?>

		<h2><?php _e('The page you`re looking for doesn`t exist', 'blank'); ?></h2>
		<div class="search-404">
		<?php _e('Do you want to search for it?', 'blank'); ?><br />
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		</div>
        
	<?php endif; ?>
 </div><!-- end .posts-wrap -->
<?php get_sidebar(); ?>

<?php get_footer(); ?>
