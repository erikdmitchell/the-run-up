		<?php echo get_sponsors_section(); ?>
		
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
					<div class="col-md-4">
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
					<div class="col-md-4">
						<?php dynamic_sidebar('footer-3'); ?>
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</footer>
	
		<div class="container-fluid copy">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<span class="pull-right">
							&copy; <?php echo date('Y'); ?> | <?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?>
						</span>
					</div>
				</div>
			</div><!-- .container -->
		</div><!-- .container-fluid -->

		<?php wp_footer(); ?>
			
	</body>
</html>