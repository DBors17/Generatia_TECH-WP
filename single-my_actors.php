<?php get_header(); ?>
<?php
if (have_posts()) {
    while (have_posts()) {
        the_post(); ?>
        <article>
            <h1 class="title"> <?php the_title(); ?></h1>
            <div class="row">
                <div class="col-md-3">
                    <?php if (has_post_thumbnail()) { ?>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                    <?php } else { ?>
                        <img src="https://mjsolpac.com/wp-content/uploads/2017/03/person-placeholder.jpg" alt="">
                    <?php } ?>
                </div>
                <div class="col-md-9">
                    <?php $connected = new WP_Query([
                        'relationship' => [
                            'id'   => 'movies_to_actors',
                            'to' => get_the_ID(),
                        ],
                        'nopaging'     => true,
                    ]);
                    if ($connected->have_posts()) {   ?>
                        <div class="movies">
                            <div class="h5">
                                <?php _e('Movies with ', 'text_domain'); ?> <?php the_title(); ?>
                            </div>
                            <div class="row movies-list">
                                <?php while ($connected->have_posts()) {
                                    $connected->the_post();
                                    get_template_part('template-parts/my_movies/content', 'excerpt');
                                }
                                wp_reset_postdata();  ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </article>
<?php
    }
}
?>
<?php get_sidebar(); ?>
<?php get_footer();
