<?php
/**
 * div e template for races page
 *
 * It can be overriden
 *
 * @since 2.0.0
 */

get_header(); ?>

<?php
$races = new UCI_Results_Query(
    array(
        'per_page' => 15,
        'type' => 'races',
    )
);
?>

<div class="container uci-results uci-results-races">

    <h1 class="page-title">Races</h1>

    <div class="uci-results-races">
        <div class="em-row header">
                <div class="col-xs-7 race-name">Name</div>
                <div class="col-xs-3 race-date">Date</div>
                <div class="col-xs-2 race-class">Class</div>
        </div>

        <?php
        if ( $races->have_posts() ) :
            while ( $races->have_posts() ) :
                $races->the_post();
                ?>
            <div class="em-row">
                <div class="col-xs-7 race-name">
                    <a href="<?php uci_results_race_url( $uci_results_post->code ); ?>"><?php echo $uci_results_post->name; ?></a>
                    <span class="hidden-xs nat">
                    <?php echo uci_results_get_country_flag( $uci_results_post->nat ); ?>
                    </span>
                </div>
                <div class="col-xs-3 race-date"><?php echo date( 'M j, Y', strtotime( $uci_results_post->date ) ); ?></div>
                <div class="col-xs-2 race-class"><?php echo $uci_results_post->class; ?></div>
            </div>
                    <?php
        endwhile;
endif;
        ?>

    </div>

    <?php uci_results_pagination(); ?>
</div>

<?php get_footer(); ?>
