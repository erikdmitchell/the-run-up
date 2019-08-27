<?php
/**
 * The template for displaying race predictions
 *
 * @package WordPress
 * @subpackage the-run-up
 * @since 1.0.0
 */

?>

<?php if ( have_rows( 'race' ) ) : ?>
    <!-- predictions -->
    
    <div class="predictions">
        <?php
        while ( have_rows( 'race' ) ) :
            the_row();
            ?>

            <div class="row">
                <div class="col-12">
                    <h3><?php the_sub_field( 'race_name' ); ?></h3>
                </div>
            </div>
                
            <?php if ( have_rows( 'predictions' ) ) : ?>
                <?php $row = 0; ?>
                
                <div class="row header">                                                
                    <div class="col-6 col-sm-4 col-lg-3 pred">
                        Prediction
                    </div>
                    <div class="col-3 col-sm-2 col-lg-1 place">
                        Result
                    </div>
                    <div class="col-3 col-sm-2 col-lg-1 points">
                        Points
                    </div>
                </div>

                <?php
                while ( have_rows( 'predictions' ) ) :
                    the_row();
                    ?>
                    <?php $row++; ?>
                
                    <div class="row">
                        <div class="col-6 col-sm-4 col-lg-3 pred">
                            <?php if ( 4 === $row ) : ?>
                                DH: <?php the_sub_field( 'rider_name' ); ?>                                           
                            <?php else : ?>
                                <?php echo $row; ?>. <?php the_sub_field( 'rider_name' ); ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-3 col-sm-2 col-lg-1 place">
                            <?php the_sub_field( 'place' ); ?>
                        </div>
                        
                        <div class="col-3 col-sm-2 col-lg-1 points">
                            <?php the_sub_field( 'points' ); ?>
                        </div>
                    </div>                                    
                <?php endwhile; ?>                                    
                
            <?php endif; ?>

        <?php endwhile; ?>

    </div>

<?php endif; ?>
