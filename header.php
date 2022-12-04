<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title><?php wp_title(); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <?php wp_head(); ?>
       </head>
		<body <?php body_class(); ?> >
     <!-- <div class="lds-ripple"><div></div><div></div></div> -->
      <?php get_template_part('template-parts/navigation/navigation','top'); ?>
      <div class="container">
        