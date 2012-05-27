<?php get_header(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="posts-wrap"> 

<div class="post" id="page">
		
		<h2 class="page-title"><?php the_title(); ?></h2>

			<div class="entry-content" id="page-content">
			
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div><!-- end #page-content -->

	</div><!-- end #page -->
    
			<?php endwhile; endif; ?>
            
	<?php edit_post_link( __('Edit this page', 'blank'), '<p>', '</p>'); ?>
 </div><!-- end .posts-wrap -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>