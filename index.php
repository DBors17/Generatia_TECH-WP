<?php get_header(); ?>
<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		?>
         <?php get_template_part('template-parts/post/content','excerpt'); ?>
		<?php
	}?>
	<?php the_posts_pagination(); ?>
<?php } 
?>
<div id = "load">temporar</div>
<?php get_sidebar(); ?>
<?php get_footer(); 

