<?php
/**
 * template for race page
 */

get_header();
?>

<div class="fc-template fantasy-cycling-race container">

	<?php if ($race) : ?>
		<h1 class="page-title"><?php echo $race->name; ?> <span class="flag"><?php fantasy_cycling_flag($race->nat); ?></h1>

		<div class="race-details">
			<div class="row">
				<div class="col-xs-2 col-sm-1 header">Class:</div>
				<div class="col-xs-4"><?php echo $race->class; ?></div>
			</div>
			<div class="row">
				<div class="col-xs-2 col-sm-1 header">Date:</div>
				<div class="col-xs-4"><?php fc_race_date_formatted($race->date); ?></div>
			</div>
			<div class="row">
				<div class="col-xs-2 col-sm-1 header">Time:</div>
				<div class="col-xs-4"><?php fc_race_time_formatted($race->time); ?></div>
			</div>
		</div>

		<div class="fantasy-results">
			<h3>Fantasy Results</h3>

			<?php if ($race->fc_results) : ?>
				<div class="row header team">
					<div class="col-xs-2 col-sm-1 rank">Rank</div>
					<div class="col-xs-5 col-sm-4 team-name">Name</div>
					<div class="col-xs-3 col-sm-3 col-md-2 team-points">Points</div>
				</div>

				<?php foreach ($race->fc_results AS $team) : ?>
					<div id="team-<?php echo $team->team_id; ?>" class="row team">
						<div class="col-xs-2 col-sm-1 rank"><?php echo $team->rank; ?></div>
						<div class="col-xs-5 col-sm-4 team-name"><a href="<?php echo fantasy_cycling_team_link($team->slug); ?>"><?php echo $team->name; ?></a></div>
						<div class="col-xs-3 col-sm-3 col-md-2 team-points"><?php echo $team->points; ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="no-race-results">No fantasy results.</div>
			<?php endif; ?>

		</div>

		<div class="race-results">
			<h3>Race Results</h3>

			<?php if (!empty($race->results)) : ?>
				<div class="row header rider">
					<div class="col-xs-2 col-sm-1 rider-place">Place</div>
					<div class="col-xs-5 col-sm-4 rider-name">Name</div>
					<div class="hidden-xs col-sm-1 rider-nat">Nat</div>
					<div class="hidden-xs col-sm-1 rider-time">Time</div>
					<div class="col-xs-2 col-sm-2 rider-uci-points">UCI Points</div>
					<div class="col-xs-3 col-sm-3 col-md-2 rider-fantasy-points">Fantasy Points</div>
				</div>

				<?php foreach ($race->results AS $key => $rider) : ?>
					<div id="result-<?php echo $key; ?>" class="row rider">
						<div class="col-xs-2 col-sm-1 rider-place"><?php echo $rider->place; ?></div>
						<div class="col-xs-5 col-sm-4 rider-name"><a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a></div>
						<div class="hidden-xs col-sm-1 rider-nat"><?php echo $rider->nat; ?></div>
						<div class="hidden-xs col-sm-1 rider-time"><?php echo $rider->time; ?></div>
						<div class="col-xs-2 col-sm-2 rider-uci-points"><?php echo $rider->points; ?></div>
						<div class="col-xs-3 col-sm-3 col-md-2 rider-fantasy-points"><?php echo $rider->total_points; ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="no-race-results">No race results.</div>
			<?php endif; ?>

		</div>

		<div class="race-history">
			<h3>Race History</h3>

			<?php if (!empty($race->related)) : ?>
				<div class="row header race">
					<div class="col-xs-8 col-sm-5 col-md-4">Race</div>
					<div class="col-xs-4 col-sm-2 col-md-2">Date</div>
					<div class="hidden-xs col-sm-3 col-md-3">Winner</div>
					<div class="hidden-xs col-sm-2 col-md-3">Series</div>
				</div>

				<?php foreach ($race->related as $r_race) : ?>
					<div id="race-<?php echo $r_race->id; ?>" class="row race">
						<div class="col-xs-8 col-sm-5 col-md-4"><a href="<?php echo fantasy_cycling_get_race_link($r_race->code, $r_race->is_fantasy); ?>"><?php echo $r_race->event; ?></a></div>
						<div class="col-xs-4 col-sm-2 col-md-2"><?php fc_race_date_formatted($r_race->date); ?></div>
						<div class="hidden-xs col-sm-3 col-md-3"><?php echo fc_uci_race_get_winner($r_race); ?></div>
						<div class="hidden-xs col-sm-2 col-md-3"><?php echo fantasy_cycling_get_series_name($r_race->series_id); ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				No race history.
			<?php endif; ?>
		</div>
	<?php else : ?>
		<h1 class="page-title">Not Found</h1>

		<div class="not-found">Race not found.</div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>