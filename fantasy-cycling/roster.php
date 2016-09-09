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

		<h1 class="page-title"><?php echo $team->name; ?> (<span class="rank"><?php echo fantasy_cycling_get_team_rank($team->id); ?></span>)</h1>

		<div class="fc-roster">

			<?php if (empty((array) $team->races)) : ?>

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

			<?php else : ?>

				<?php if (!empty($team->races)) : foreach ($team->races as $race) : ?>

					<div id="race-<?php echo $race->id; ?>" class="race">
						<h3 class="name"><?php echo $race->event; ?> <span class="flag"><?php echo ucicurl_get_country_flag($race->nat); ?></h3>

						<div class="race-details fc-row">
							<div class="race-date"><?php fantasy_cycling_date($race->date); ?></div>
							<div class="race-class"><?php echo $race->class; ?></div>
						</div>

						<div class="fc-results">
							<?php foreach ($race->riders as $rider) : ?>
								<div class="rider fc-row">
									<div class="rider-name"><a href="<?php fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a></div>
									<div class="rider-country"><?php fantasy_cycling_flag($rider->nat); ?></div>
									<div class="rider-points"><?php echo $rider->points; ?></div>
								</div>
							<?php endforeach; ?>
						</div>

						<div class="totals header fc-row">
							<div class="text rider-name">Total</div>
							<div class="rider-country">&nbsp;</div>
							<div class="number rider-points"><?php echo $race->total_points; ?></div>
						</div>

					</div>
				<?php endforeach; endif; ?>

			<?php endif; ?>

		</div>

	<?php else : ?>
		<h1 class="page-title">Not Found</h1>

		<div class="not-found">Race not found.</div>
	<?php endif; ?>

</div>

<?php get_footer(); ?>