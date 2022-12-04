<div class="container">
  <div class="row">
    <div class="col">
      <div class="card mb-3">
  <div class="card-body">
    <h5 class="card-title"><?php the_title(); ?></h5>
    <p class="card-text">Some quick example text to build.</p>
    <?php global $post; ?>
    <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary">Intra in <?php the_title(); ?></a>
  </div>
</div>
</div>
  </div>
</div>