<?php
/**
 * template for home page - main content
 */
?>

<?php get_header(); ?>

<?php $team = fc_get_team(); ?>

<div class="fantasy-cycling-landing fc-template container">
    <div class="row">
        <div class="col-12">
            <?php fc_team_message(); ?>
        </div>
    
        <div class="col-12 col-md-7">
            <?php echo fantasy_cycling_get_template_part( 'home/user-team', $team ); ?>
            <?php // echo fantasy_cycling_get_template_part( 'home/leagues', $team ); ?>     
            <?php echo fantasy_cycling_get_template_part( 'home/races', $team ); ?>       
        </div>
        
        <div class="col-12 col-md-5">
        
            <div class="schedule row">
                <div class="col-12">
                    
                    <h3>Upcoming Races</h3>
    
                    <ul class="upcoming-races">
                        
                        <?php foreach ( fc_get_races() as $race ) : ?>
                        
                            <li id="race-<?php echo $race->ID; ?>">
                                <div class="col-8">
                                    <div class="race-date"><?php fc_date( $race->start ); ?></div>
                                    <div class="race-name"><a href="<?php echo get_permalink( $race->ID ); ?>"><?php fc_race_title( $race->ID ); ?></a></div>
                                </div>
                                <div class="col-4">
                                    <?php fc_join_button( $race->ID, $team->id ); ?>
                                </div>                              
                            </li>
                            
                        <?php endforeach; ?>
                    
                        <a class="schedule-link" href="<?php fc_schedule_link(); ?>">View Full Schedule</a>
                    </ul>
    
                    
                </div>
            </div>
        
        </div>  
    </div>
</div>

<?php get_footer();
