<div class="fc-row leagues">
    <div class="fc-col-xs-12">
        <h3>Leagues</h3>

        <div class="league">
            <?php foreach ( $args->leagues as $league_id ) : ?>
                <?php $league = fc_get_league( $league_id ); ?>

                <h4><?php echo $league->name; ?></h4>

                <?php echo fc_ordinal_number( fc_league_get_team_place( $args->id, $league ) ); ?> Place with <?php fc_league_team_total( $args->id, $league ); ?> Points
            <?php endforeach; ?>
        </div>

    </div>
</div>
