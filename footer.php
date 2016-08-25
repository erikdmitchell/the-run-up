		<footer>
			<div class="footer-widgets">
				<div class="container">
					<div class="row">
						<div class="primary-copyright footer-col col-xs-12 col-sm-3">
							<h3>The Run Up</h3>
							<div class="copy">
								&copy <?php echo date('Y'); ?> The Run Up<br />
								All Rights Reserved.
							</div>
						</div>

						<div class="col-xs-6 col-sm-3 footer-col">
							<?php dynamic_sidebar('footer-1'); ?>
						</div>

						<div class="col-xs-6 col-sm-3 footer-col">
							<?php dynamic_sidebar('footer-2'); ?>
						</div>

						<div class="col-xs-12 col-sm-3 footer-co footer-social">
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