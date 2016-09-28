<?php
/**
 * template for race page
 */

get_header(); ?>

<div class="fc-template fantasy-cycling-race container">

	<?php if ($race) : ?>
		<h1 class="page-title"><?php echo $race->event; ?> <span class="flag"><?php fantasy_cycling_flag($race->nat); ?></h1>

		<div class="race-details">
			<div class="row">
				<div class="col-xs-2 header">Date:</div>
				<div class="col-xs-10"><?php echo date(get_option('date_format'), strtotime($race->date)); ?></div>
			</div>
			<div class="row">
				<div class="col-xs-2 header">Class:</div>
				<div class="col-xs-10"><?php echo $race->class; ?></div>
			</div>
		</div>

		<div class="race-results">

			<?php if (!empty($race->results)) : ?>
				<div class="row header">
					<div class="col-xs-2">Place</div>
					<div class="col-xs-6">Name</div>
					<div class="col-xs-2">Time</div>
					<div class="col-xs-1">Pts</div>
				</div>

				<?php foreach ($race->results AS $key => $rider) : ?>
					<div id="result-<?php echo $key; ?>" class="row rider">
						<div class="col-xs-2"><?php echo $rider->place; ?></div>
						<div class="col-xs-6"><a href="<?php echo fantasy_cycling_rider_link($rider->slug); ?>"><?php echo $rider->name; ?></a> <?php fantasy_cycling_flag($rider->nat); ?></div>
						<div class="col-xs-2"><?php echo $rider->time; ?></div>
						<div class="col-xs-1"><?php echo $rider->points; ?></div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="row no-race-results">No race results.</div>
			<?php endif; ?>

		</div>
	<?php else : ?>
		<h1 class="page-title">Not Found</h1>

		<div class="not-found">Race not found.</div>
	<?php endif; ?>



</div>

<?php get_footer(); ?>