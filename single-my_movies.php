<?php get_header(); ?>
<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
?>
        <article>
            <h1 class="title"> <?php the_title(); ?></h1>
            <div class="row">
                <div class="col-md-3">
                    <?php if (has_post_thumbnail()) { ?>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                    <?php } else { ?>
                        <img src="https://cringemdb.com/img/movie-poster-placeholder.png" alt="">
                    <?php } ?>
                </div>
                <div class="col-md-9">
                    <div>
                        Runtime: <?php echo runtime_prettier(get_field('my_runtime')); ?>
                    </div>
                    <div>
                        <?php $genres = get_the_terms(get_the_ID(), 'my_genres'); ?>
                        Genres: 
                        <?php $i = 0;
                        foreach ($genres as $genre) { ?>
                            <?php if ($i !== 0) echo '/'; ?> <a href="<?php echo get_term_link($genre->term_id); ?>"><?php echo $genre->name; ?></a>
                        <?php $i++;
                        } ?>
                    </div>
                    <div>
                        <?php $years = get_the_terms(get_the_ID(), 'my_years');?>
                        Year: 
                      <?php if (count($years)) {
                            $year = $years[0]; ?>
                            <a href="<?php echo get_term_link($year->term_id); ?>"><?php echo $year->name; ?></a>
                            <?php if (check_old_movie($year->name)) { ?>
                                Old movie: <b><?php echo check_old_movie($year->name); ?></b> years
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div>
                        <?php $connected = new WP_Query([
                            'relationship' => [
                                'id'   => 'movies_to_actors',
                                'from' => get_the_ID(),
                            ],
                            'nopaging'     => true,
                        ]);
                        if ($connected->have_posts()) {
                            echo "<div class='actors'>";

                            echo __('Actors', 'text_domain') . ": ";

                            $i = 0;
                            while ($connected->have_posts()) {
                                $connected->the_post();

                                if ($i !== 0) {
                                    echo ", ";
                                }
                                echo "<a href='" . get_the_permalink() . "'>" . get_the_title() . "</a>";

                                $i++;
                            }
                            wp_reset_postdata();
                            unset($i);

                            echo "</div>"; // div class="actors"
                        }
                        unset($connected); ?>

                        <?php $connected = new WP_Query([
                            'relationship' => [
                                'id'   => 'movies_to_directors',
                                'from' => get_the_ID(),
                            ],
                            'nopaging'     => true,
                        ]);
                        if ($connected->have_posts()) {
                            echo "<div class='directors'>";

                            echo __('Directors', 'text_domain') . ": ";

                            $i = 0;
                            while ($connected->have_posts()) {
                                $connected->the_post();

                                if ($i !== 0) {
                                    echo ", ";
                                }
                                echo "<a href='" . get_the_permalink() . "'>" . get_the_title() . "</a>";

                                $i++;
                            }
                            wp_reset_postdata();
                            unset($i);

                            echo "</div>"; // div class="actors"
                        }
                        unset($connected); ?>
                    </div>
                </div>
            </div>
        </article>
<?php
    }
}
?>
<?php get_sidebar(); ?>
<?php get_footer();
