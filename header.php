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

	<nav class="navbar navbar-default <?php tru_navbar_classes(); ?>" role="navigation">
		<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".koksijde-theme-mobile-menu">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logos/logo-sm.png " height="93" width="204" alt="the run up logo" /></a>
		</div>
		<?php tru_secondary_navigation_setup(); ?>
		<div class="collapse navbar-collapse primary-menu">
			<?php
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'container' => false,
				'menu_class' => 'nav navbar-nav pull-right',
				'fallback_cb' => 'tru_wp_bootstrap_navwalker::fallback',
				'walker' => new tru_wp_bootstrap_navwalker()
			));
			?>
		</div> <!-- .primary-menu -->
		<?php tru_mobile_navigation_setup(); ?>
		</div>
	</nav>
