<?php
/**
 * The template for displaing page-login.php content
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<div class="emcl-login-form">
			<form id="custom_login_form" class="custom_form" action="" method="post">
				<fieldset>
					<p>
						<label for="custom_user_login">Username</label>
						<input name="custom_user_login" id="custom_user_login" class="required" type="text" />
					</p>
					<p>
						<label for="custom_user_pass">Password</label>
						<input name="custom_user_pass" id="custom_user_pass" class="required" type="password" />
					</p>
					<p>
						<input type="hidden" name="custom_login_nonce" value="<?php echo wp_create_nonce('custom-login-nonce'); ?>" />
						<input id="custom_login_submit" class="btn-tru" type="submit" value="Login" />
					</p>
				</fieldset>
			</form>

			<?php emcl_login_extras(); ?>

		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->