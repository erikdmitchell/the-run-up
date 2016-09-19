<?php
/**
 * template for the schedule page
 */

get_header(); ?>

<div class="fantasy-cycling-schedule fc-template container">

	<h1 class="page-title">Schedule</h1>

		<div class="fc-races">

			<div class="header row">
				<div class="col-xs-4 col-sm-3 date">Date</div>
				<div class="col-xs-8 race">Race</div>
			</div>

			<?php foreach ($fantasy_cycling_schedule as $race) : ?>
				<div id="race-<?php echo $race->id; ?>" class="row">
					<div class="col-xs-4 col-sm-3 date">
						<?php echo date('M. j, Y', strtotime($race->date)); ?>
					</div>
					<div class="col-xs-8 race">
						<?php echo $race->name; ?>
					</div>
				</div>
			<?php endforeach; ?>

		</div>

</div>

<?php get_footer(); ?>


