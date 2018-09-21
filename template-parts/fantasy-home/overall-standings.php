<?php
$overall_standings = fc_get_overall_standings();
?>

<div class="row overall-standings">
    <div class="col-xs-12">
        <h3>Overall Standings</h3>

        <div class="standings">

            <?php if ( $overall_standings ) : ?>
                <div class="header row">
                    <div class="col-xs-2 rank">Rank</div>
                    <div class="col-xs-8 team-name">Name</div>
                    <div class="col-xs-2 team-points">Points</div>
                </div>

                <?php foreach ( $overall_standings as $team ) : ?>
                    <div id="team-<?php echo $team->slug; ?>" class="row">
                        <div class="col-xs-2 rank"><?php echo $team->rank; ?></div>
                        <div class="col-xs-8 team-name"><a href="<?php fantasy_cycling_team_link( $team->slug ); ?>"><?php echo $team->name; ?></a></div>
                        <div class="col-xs-2 team-points"><?php echo $team->total; ?></div>
                    </div>
                <?php endforeach; ?>

            <?php else : ?>
                <div class="not-found">No overall standings.</div>
            <?php endif; ?>
        </div>

    </div>
</div>
