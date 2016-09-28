<?php
/**
 * template for roster page
 *
 * It can be overriden
 *
 * @since 0.1.0
 */

get_header(); ?>

<div class="fantasy-cycling-roster fc-template container">

	<?php if ($team) : ?>

		<h1 class="page-title"><?php echo $team->name; ?> (<span class="rank"><?php echo $team->rank; ?></span>)</h1>

		<div class="fc-roster">

			<?php if (empty($team->riders)) : ?>
				No roster found.
			<?php else : ?>
				<div class="active-roster">
					<h3>Active Roster</h3>

					<div class="active-roster-list">

							<div class="row header">
								<div class="col-xs-6 col-sm-3 rider-name">Rider</div>
								<div class="hidden-xs col-sm-1 rider-wins">Wins</div>
								<div class="hidden-xs col-sm-2 rider-podiums">Podiums</div>
								<div class="hidden-xs col-sm-1 col-md-2 rider-uci-rank">UCI Rank</div>
								<div class="col-xs-2 col-sm-1 rider-points">Points</div>
								<div class="col-xs-2 col-sm-2 rider-perc-owned">Owned</div>
								<div class="col-xs-2 col-sm-2 col-md-1 rider-cost">Value</div>
							</div>

						<?php foreach ($team->riders as $rider) : ?>
							<div id="rider-<?php echo $rider->id; ?>" class="row">
								<div class="col-xs-6 col-sm-3 rider-name"><a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a> <span class="country"><?php //fantasy_cycling_flag($rider->nat); ?></span></div>
								<div class="hidden-xs col-sm-1 rider-wins"><?php echo $rider->fantasy->wins; ?></div>
								<div class="hidden-xs col-sm-2 rider-podiums"><?php echo $rider->fantasy->podiums; ?></div>
								<div class="hidden-xs col-sm-1 col-md-2 rider-uci-rank"><?php echo $rider->uci_rank; ?></div>
								<div class="col-xs-2 col-sm-1 rider-points"><?php echo $rider->fantasy->points; ?></div>
								<div class="col-xs-2 col-sm-2 rider-perc-owned"><?php echo $rider->fantasy->perc_owned; ?></div>
								<div class="col-xs-2 col-sm-2 col-md-1 rider-cost"><?php echo $rider->fantasy->cost; ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if (!empty($team->prev_races)) : foreach ($team->prev_races as $race) : ?>

				<div id="race-<?php echo $race->id; ?>" class="race">
					<h3 class="name"><?php echo $race->event; ?> <span class="flag"><?php fantasy_cycling_flag($race->nat); ?></h3>

					<div class="race-details row">
						<div class="col-xs-4 race-date"><?php fc_race_date_formatted($race->date); ?></div>
						<div class="col-xs-2 race-class"><?php echo $race->class; ?></div>
					</div>

					<div class="fc-results">

						<div class="rider row header">
							<div class="col-xs-6 col-sm-3 rider-name">Name</div>
							<div class="col-xs-2 col-sm-3 rider-finish">Finish Place</div>
							<div class="col-xs-2 col-sm-3 rider-place-diff">Place Diff.</div>
							<div class="col-xs-2 col-sm-3 rider-points">Points</div>
						</div>

						<?php foreach ($race->riders as $rider) : ?>
							<div class="rider row">
								<div class="col-xs-6 col-sm-3 rider-name"><a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a> <?php //fantasy_cycling_flag($rider->nat); ?></div>
								<div class="col-xs-2 col-sm-3 rider-finish"><?php echo $rider->place; ?></div>
								<div class="col-xs-2 col-sm-3 rider-place-diff"><?php echo $rider->place_differential; ?></div>
								<div class="col-xs-2 col-sm-3 rider-points"><?php echo $rider->total_points; ?></div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="totals header row">
						<div class="col-xs-2 col-xs-offset-8 col-sm-offset-7 text rider-name">Total</div>
						<div class="col-xs-2 col-sm-3 number rider-points"><?php echo $race->total_points; ?></div>
					</div>

				</div>

			<?php endforeach; endif; ?>

		</div>

	<?php else : ?>
		<h1 class="page-title">Not Found</h1>

		<div class="not-found">Roster not found.</div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>