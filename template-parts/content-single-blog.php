<div class="container">
    <div class="row">
        <div class="col-12">
            <?php tru_post_thumbnail( 'single' ); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                    
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'tru-blog-single' ); ?>>
                    <header class="entry-header">
                        <?php	the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                
                        <div class="entry-meta">
                            <?php the_time( 'F j, Y' ); ?>
                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->
                
                    <div class="entry-content">
                        <?php
                            the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'the-run-up' ) );
                            wp_link_pages(
                                array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'the-run-up' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                )
                            );
                        ?>
                    </div><!-- .entry-content -->
                                        
                    <?php if ( have_rows( 'rider' ) ) : ?>
                        <?php $counter = count( get_field( 'rider' ) ); ?>
                        <!-- power rankings -->
                        
                        <div class="power-rankings">
                            <?php
                            while ( have_rows( 'rider' ) ) :
                                the_row();

                                // vars
                                $name = get_sub_field( 'name' );
                                $content = get_sub_field( 'details' );
                                $image = get_sub_field( 'image' );
                                ?>
                        
                                <div class="row rider">
                                    
                                    <div class="image-wrap col-12 col-sm-3">
                                        <?php if ( $image ) : ?>
                                            <img src="<?php echo $image['sizes']['blog-power-ranking']; ?>" alt="<?php echo empty( $image['alt'] ) ? $image['name'] : $image['alt']; ?>" />
                                        <?php endif; ?>
                                    </div>
                                                                        
                                    <div class="col-12 col-sm-9">
                                        <div class="rider-rank">
                                            <?php echo $counter; ?>. 
                                            <span class="rider-name"><?php echo $name; ?></span>
                                        </div>
                                    
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                                
                                <?php $counter--; ?>
                        
                            <?php endwhile; ?>
                    
                        </div>
                    
                    <?php endif; ?>
                    
                    <?php if ( have_rows( 'race' ) ) : ?>
                        <!-- predictions -->
                        
                        <div class="predictions">
                            <?php while ( have_rows( 'race' ) ) : the_row(); ?>

                                <div class="row">
                                    <div class="col-12">
                                        <h3><?php the_sub_field('race_name'); ?></h3>
                                    </div>
                                </div>
                                    
                                <?php if ( have_rows( 'predictions' ) ) : ?>
                                    <?php $row = 0; ?>
                                    
                                    <div class="row">                                                
                                        <div class="col-6 col-sm-4 pred">
                                            Prediction
                                        </div>
                                        <div class="col-3 col-sm-2 place">
                                            Place
                                        </div>
                                        <div class="col-3 col-sm-2 place">
                                            Points
                                        </div>
                                    </div>

                                    <?php while ( have_rows( 'predictions' ) ) : the_row(); ?>
                                        <?php $row++; ?>
                                    
                                        <div class="row">
                                            <div class="col-4 pred">
                                                <?php if (4 === $row) : ?>
                                                    DH: <?php the_sub_field('rider_name'); ?>                                           
                                                <?php else : ?>
                                                    <?php echo $row; ?>. <?php the_sub_field('rider_name'); ?>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="col-3 place">
                                                <?php the_sub_field('place'); ?>
                                            </div>
                                            
                                            <div class="col-3 place">
                                                <?php the_sub_field('points'); ?>
                                            </div>
                                        </div>                                    
                                    <?php endwhile; ?>                                    
                                    
                                <?php endif; ?>

                            <?php endwhile; ?>
                    
                        </div>
                    
                    <?php endif; ?>                                      
                
                    <footer class="entry-meta">
                        <div class="tags-list">
                            <div class="tags-title">Tags</div>
                            
                            <?php the_tags( '<div class="tag-links">', ' ', '</div>' ); ?>
                        </div>
                        
                        <div class="categories-list">
                            <div class="categories-title">Categories</div>
                            
                            <div class="categories-link">
                                <?php tru_post_categories(' ', 1); ?>
                            </div>
                        </div>
                    </footer>
                </article><!-- #post-## -->
                                
            <?php endwhile; ?>
        </div>
    </div>
</div><!-- .container -->
