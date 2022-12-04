<div class="col-12 col-md-6 col-lg-4 mb-4" id="person-<?php echo get_the_ID(); ?>">
    <div class="card">
        <div class="person-poster card-img-top position-relative" style="background-image: url( <?php echo (has_post_thumbnail()) ? get_the_post_thumbnail_url() : "https://mjsolpac.com/wp-content/uploads/2017/03/person-placeholder.jpg"; ?>)"></div>
        <div class="card-body">
            <h5 class="card-title"><?php the_title(); ?></h5>
            <p class="card-text"><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
        </div>
    </div>
</div>