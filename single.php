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
		 <div>
		 <b>Autorul: </b><?php the_author(); ?>
		 </div>
		 <div>
		 <b>Data: </b><?php the_date(); ?>
		 </div>
		 <div>
		 <b>Ora: </b><?php the_time(); ?>
		 </div>
		<?php
	} 
} 
?>
<?php // get_sidebar(); ?>
<?php get_footer();