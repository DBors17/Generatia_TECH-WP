<?php if ( is_active_sidebar( 'footer-widgets' ) ) { ?>
	<div id="footer-sidebar" class="bg-light py-4 mt-3">
        <div class="container">
          <?php dynamic_sidebar('footer-widgets'); ?>  
        </div>
</div>
<?php } ?>