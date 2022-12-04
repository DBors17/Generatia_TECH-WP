<form class="form-inline" action="/" method="get">
  <div class="input-group">
    <input class="form-control mr-sm-2" placeholder="Search" aria-label="Search" type="text" name="s" id="search" value="<?php the_search_query(); ?>">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" alt="Search" src="<?php bloginfo( 'template_url' ); ?>">Search</button>
  </div>
</form> 