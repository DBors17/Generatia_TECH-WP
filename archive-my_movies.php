<?php get_header(); ?>
<?php
if (have_posts()) { ?>
    <div class="row movies-list">
        <?php while (have_posts()) {
            the_post();
        ?>
            <?php get_template_part('template-parts/my_movies/content', 'excerpt'); ?>
        <?php
        } ?>
    </div>
    <?php the_posts_pagination(); ?>
<?php }
?>
<?php get_sidebar(); ?>
<?php get_footer();
