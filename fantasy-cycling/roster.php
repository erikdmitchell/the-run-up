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

			<?php if (empty($team->active_roster)) : ?>
				No roster found.
			<?php else : ?>
				<div class="active-roster">
					<h3>Active Roster</h3>
					<div class="active-roster-list">

						<?php foreach ($team->active_roster as $rider) : ?>
							<div class="row">
								<div class="col-xs-12 rider-name">
									<a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a>
									<?php fantasy_cycling_flag($rider->nat); ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if (!empty($team->prev_races)) : foreach ($team->prev_races as $race) : ?>

				<div id="race-<?php echo $race->id; ?>" class="race">
					<h3 class="name"><?php echo $race->event; ?> <span class="flag"><?php echo fantasy_cycling_flag($race->nat); ?></h3>

					<div class="race-details row">
						<div class="col-xs-6 race-date"><span>Date: </span><?php fantasy_cycling_date($race->date); ?></div>
						<div class="col-xs-6 race-class"><span> Class: </span><?php echo $race->class; ?></div>
					</div>

					<div class="fc-results">
						<div class="row header">
							<div class="col-xs-8 col-sm-4 rider-name">Rider</div>
							<div class="hidden-xs col-sm-2 rider-place">Finish</div>
							<div class="hidden-xs col-xs-4 col-sm-2 rider-points">Points</div>
							<div class="hidden-xs col-sm-2 rider-place-diff">Place Diff.</div>
							<div class="col-xs-4 col-sm-2 rider-total">Total</div>
						</div>

						<?php foreach ($race->riders as $rider) : ?>
							<div class="rider row">
								<div class="col-xs-8 col-sm-4 rider-name"><a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a> <?php fantasy_cycling_flag($rider->nat); ?></div>
								<div class="hidden-xs col-sm-2 rider-place"><?php echo $rider->place; ?></div>
								<div class="hidden-xs col-xs-4 col-sm-2 rider-points"><?php echo $rider->points; ?></div>
								<div class="hidden-xs col-sm-2 rider-place-diff"><?php echo $rider->place_differential; ?></div>
								<div class="col-xs-4 col-sm-2 rider-total"><?php echo $rider->total_points; ?></div>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="totals header row">
						<div class="col-xs-2 race-total">Total</div>
						<div class="col-xs-2 col-xs-offset-6 col-sm-offset-8 team-points"><?php echo $race->total_points; ?></div>
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