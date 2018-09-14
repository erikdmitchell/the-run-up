<!doctype html>
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

        <?php wp_head(); ?>
    </head>

    <body <?php body_class('tru'); ?>>

    	<nav class="navbar tru-header-nav clearfix">
            
            <div class="primary-nav">
                <div class="header-logo">
                    <a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/inc/images/logos/logo-sm.png " height="93" width="204" alt="the run up logo" /></a>
                </div>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primary-menu" aria-controls="primary-menu" aria-expanded="true" aria-label="Toggle navigation">
                    <i class="material-icons">menu</i>
                </button>
        
    			<?php
    			wp_nav_menu(array(
    				'theme_location' => 'primary',
    				'container' => false,
    				'menu_class' => 'navbar-nav',
    			));
    			?> 
            </div>
			
			<?php if (is_user_logged_in()) : ?>
    			<div class="secondary-nav">
        			<?php
        			wp_nav_menu(array(
        				'theme_location' => 'secondary',
        				'container' => false,
        			));
        			?> 
    			</div>
            <?php endif; ?>
        </nav>