<?php
/**
 * template for standings page
 */

get_header(); ?>

<div class="fantasy-cycling-standings fc-template container">

	<h1 class="page-title">Standings</h1>

	<div class="fc-standings">

		<?php if ($teams) : ?>
			<div class="header row">
				<div class="col-xs-2 rank">Rank</div>
				<div class="col-xs-8 team-name">Name</div>
				<div class="col-xs-2 team-points">Points</div>
			</div>

			<?php foreach ($teams as $team) : ?>
				<div id="team-<?php echo $team->id; ?>" class="row">
					<div class="col-xs-2 rank"><?php echo $team->rank; ?></div>
					<div class="col-xs-8 team-name"><a href="<?php fantasy_cycling_team_link($team->slug); ?>"><?php echo $team->name; ?></a></div>
					<div class="col-xs-2 team-points"><?php echo $team->total; ?></div>
				</div>
			<?php endforeach; ?>

		<?php else : ?>
			<div class="not-found">No current standings.</div>
		<?php endif; ?>
	</div>

</div>

<?php get_footer(); ?>