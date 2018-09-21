<?php
global $fantasy_cycling_user_team, $fantasy_cycling_pages;
?>

<h2 class="team-name"><?php echo $fantasy_cycling_user_team->name; ?></h2>

<div class="row team">
    <div class="col-xs-12">

        <a href="<?php echo get_permalink( $fantasy_cycling_pages['my_team'] ); ?>" class="btn-tru">
            <?php tru_team_roster_button_text(); ?>
        </a>

        <div class="team-standings">
            Currently <?php echo tru_ordinal_number( $fantasy_cycling_user_team->standing->rank ); ?> overall with <?php echo $fantasy_cycling_user_team->standing->total; ?> points.
        </div>

    </div>
</div>
