<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

    <head>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <?php wp_head(); ?>
    </head>

  <body <?php body_class('tru'); ?>>

	<nav class="navbar navbar-expand-md<?php tru_navbar_classes(); ?>">
        
        <a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/images/logos/logo-sm.png " height="93" width="204" alt="the run up logo" /></a>
      
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-menu" aria-controls="primary-menu" aria-expanded="true" aria-label="Toggle navigation">
            <i class="fa fa-bars fa-1x"></i>
        </button>
        
        <?php //tru_secondary_navigation_setup(); ?>

        <div class="navbar-collapse collapse primary-menu" id="primary-menu">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'container' => false,
				'menu_class' => 'navbar-nav ml-auto',
				'fallback_cb' => 'tru_wp_bootstrap_navwalker::fallback',
				'walker' => new tru_wp_bootstrap_navwalker()
			));
			?> 
        </div>
        
        <?php //tru_mobile_navigation_setup(); ?>
    </nav>