        <footer>
            <div class="footer-widgets">
                <div class="container">
                    <div class="row">
                        <div class="primary-copyright footer-col col-12 col-sm-3">
                            <h3>The Run Up</h3>
                            <div class="copy">
                                &copy <?php echo date( 'Y' ); ?> The Run Up<br />
                                All Rights Reserved.
                            </div>
                        </div>

                        <div class="col-6 col-sm-3 footer-col">
                            <?php dynamic_sidebar( 'footer-1' ); ?>
                        </div>

                        <div class="col-6 col-sm-3 footer-col">
                            <?php dynamic_sidebar( 'footer-2' ); ?>
                        </div>

                        <div class="col-12 col-sm-3 footer-co footer-social">
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

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-11805581-1', 'auto');
          ga('send', 'pageview');

        </script>

    </body>
</html>
