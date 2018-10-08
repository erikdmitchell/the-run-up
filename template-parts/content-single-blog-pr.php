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
