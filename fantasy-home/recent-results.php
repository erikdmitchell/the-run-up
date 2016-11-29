<?php
global $fantasy_cycling_races_with_results;
?>

<div class="row recent-results">
	<div class="col-xs-12">
		<h3>Recent Results</h3>

		<div class="results">

			<?php if ($fantasy_cycling_races_with_results) : ?>
				<div class="header row">
					<div class="col-xs-2 race-date">Date</div>
					<div class="col-xs-6 race-name">Race</div>
					<div class="col-xs-2 race-nat">Nat</div>
					<div class="col-xs-2 race-class">Class</div>
				</div>

				<?php foreach ($fantasy_cycling_races_with_results as $race) : ?>
					<div id="race-<?php echo $race->id; ?>" class="row">
						<div class="col-xs-2 race-date"><?php echo date('M. j, Y', strtotime($race->date)); ?></div>
						<div class="col-xs-6 race-name"><a href="<?php fantasy_cycling_get_race_link($race->code); ?>"><?php echo $race->name; ?></a></div>
						<div class="col-xs-2 race-nat"><?php echo $race->nat; ?></div>						
						<div class="col-xs-2 race-class"><?php echo $race->class; ?></div>
					</div>
				<?php endforeach; ?>

			<?php else : ?>
				<div class="not-found">No recent results.</div>
			<?php endif; ?>
		</div>

	</div>
</div>