<div class="races row">
    <div class="col-12">
        <h3>Race Results</h3>

        <div class="race">
            <?php foreach ( $args->races as $race_id ) : ?>
                <?php if ( ! fc_is_race_upcoming( $race_id ) ) : ?>
                    <?php $race = fc_get_race( $race_id ); ?>

                    <h4><a href="<?php fc_race_url( $race_id ); ?>"><?php echo $race->name; ?></a></h4>

                    <?php echo fc_ordinal_number( fc_race_get_team_field( $args->id, $race ) ); ?> Place with <?php fc_race_team_points( $args->id, $race ); ?> Points
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>
</div>
