<div class="col-12 col-md-6 col-lg-4 mb-4" id="movie-<?php echo get_the_ID(); ?>">
    <div class="card">
        <div class="movie-poster card-img-top position-relative" style="background-image: url( <?php echo (has_post_thumbnail()) ? get_the_post_thumbnail_url() : "https://cringemdb.com/img/movie-poster-placeholder.png"; ?>)"></div>
        <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?></h5>
            <p class="card-text"><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
        </div>
    </div>
</div>