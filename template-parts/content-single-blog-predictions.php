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