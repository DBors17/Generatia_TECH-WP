<?php get_header(); ?>
<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		?>
         <h2>
		<?php the_title(); ?>
		 </h2>
		 <div class="post-content">
			<?php the_content(); ?>
		 </div>
		<?php
	} 
} 
?>
<?php // get_sidebar(); ?>
<?php get_footer();