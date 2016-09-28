<?php
/**
 * template for the schedule page
 */

get_header(); ?>

<div class="fantasy-cycling-schedule fc-template container">

	<h1 class="page-title">Upcoming Races</h1>

		<div class="fc-races">

			<div class="header row">
				<div class="col-xs-4 col-sm-2 date">Date</div>
				<div class="col-xs-8 race">Race</div>
			</div>

			<?php foreach ($fantasy_cycling_schedule as $race) : ?>
				<div id="race-<?php echo $race->id; ?>" class="row">
					<div class="col-xs-4 col-sm-2 date">
						<?php fc_race_date_formatted($race->date); ?>
					</div>
					<div class="col-xs-8 race">
						<a href="<?php echo fantasy_cycling_get_race_link($race->code); ?>"><?php echo $race->name; ?></a>
					</div>
				</div>
			<?php endforeach; ?>

		</div>

</div>

<?php get_footer(); ?>


