		<footer>
			<div class="footer-widgets">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<?php dynamic_sidebar('footer-1'); ?>
						</div>
						<div class="col-md-4">
							<?php dynamic_sidebar('footer-2'); ?>
						</div>
						<div class="col-md-4">
							<?php //dynamic_sidebar('footer-3'); ?>
							<h3>The Run Up</h3>
							<div class="copy">&copy <?php echo date('Y'); ?></div>
							<ul class="social">
								<li><i class="fa fa-twitter-square" aria-hidden="true"></i></li>
								<li><i class="fa fa-facebook-square" aria-hidden="true"></i></li>
							</ul>
						</div>
					</div>
				</div> <!-- /container -->
			</div><!-- .footer-widgets -->
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>