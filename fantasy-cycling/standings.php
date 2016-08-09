<?php
/**
 * template for my standings page
 *
 * It can be overriden
 *
 * @since 0.1.0
 */

get_header(); ?>

<?php $teams=fantasy_cycling_standings(); ?>

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
				<div id="team-<?php echo $team->slug; ?>" class="row">
					<div class="col-xs-2 rank"><?php echo $team->rank; ?></div>
					<div class="col-xs-8 team-name"><a href="<?php fantasy_cycling_team_link($team->slug); ?>"><?php echo $team->name; ?></a></div>
					<div class="col-xs-2 team-points"><?php echo $team->overall_total; ?></div>
				</div>
			<?php endforeach; ?>

		<?php else : ?>
			<div class="not-found">No current standings.</div>
		<?php endif; ?>
	</div>

</div>

<?php get_footer(); ?>