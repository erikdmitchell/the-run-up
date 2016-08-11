<?php
global $uci_results_api, $fc_uci_results_riders_query;

$html=null;
$paged=isset($_POST['paged']) ? $_POST['paged'] : 0;
$args=array(
	'type' => 'riders',
	'rankings' => true,
	'season' => fantasy_cycling_get_previous_season(),
	'week' => $uci_results_api->request('seasons', 'lastWeek', array('season' => fantasy_cycling_get_previous_season())),
	'per_page' => 10,
	'paged' => $paged // AJAX ($_POST) //
);
$fc_uci_results_riders_query=$uci_results_api->request('resultsquery', 'q', $args);
$fc_uci_results_riders_query->ajax_paged=$paged;
$riders=$fc_uci_results_riders_query->posts;
$next_race=fantasy_cycling_get_next_race();
$user_team=fantasy_cycling_get_user_team();
?>

<div class="fc-add-riders-modal-content">

	<div clss="container">

		<!-- search filter -->
		<div class="row fc-arm-search">
			<div class="col-xs-12 col-sm-3"><label for="rider-search">Rider Search</label></div>
			<div class="col-xs-12 col-sm-8 search-box-wrap">
				<input type="text" name="rider-search" id="rider-search" class="" value="" />
				<a class="rider-search-close" data-page="<?php echo $paged; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
			</div>
		</div>

		<div class="row budget">
			<div class="col-xs-3 col-sm-offset-7 col-sm-2 text">Budget:</div>
			<div class="col-xs-offset-6 col-xs-3 col-sm-offset-0 amount"><?php echo fantasy_cycling_format_cost($user_team->budget); ?></div>
		</div>

		<div class="riders">

			<div class="hidden-sm hidden-md hidden-lg row stats header">
				<div class="col-xs-2 rank">Rank</div>
				<div class="col-xs-2 points">Points</div>
				<div class="col-xs-3 last-year">Last Year</div>
				<div class="col-xs-5 last-race">Last Race</div>
			</div>

			<div class="hidden-xs row header smplus">
				<div class="col-sm-1">&nbsp;</div>
				<div class="col-sm-4 name">Name</div>
				<div class="col-sm-1 proj">Proj.</div>
				<div class="col-sm-1 rank">Rank</div>
				<div class="col-sm-1 points">Points</div>
				<div class="col-sm-1 last-year">Last Year</div>
				<div class="col-sm-1 last-race">Last Race</div>
				<div class="col-sm-2 cost">Cost</div>
			</div>

			<?php if (count($riders)) :	foreach ($riders as $rider) : ?>
				<?php $last_year_result=fantasy_cycling_get_race_result($rider->id, $next_race->last_year_code); ?>
				<?php $last_race=fantasy_cycling_last_result($rider->id); ?>

				<div id="rider-<?php echo $rider->id; ?>" class="rider">
					<div class="hidden-sm hidden-md hidden-lg row actions">
						<div class="col-xs-2">
							<?php if (!fantasy_cycling_is_rider_on_team($rider->id, fantasy_cycling_get_user_team_id())) : ?>
								<a href="#" class="add-rider" data-id="<?php echo $rider->id; ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
							<?php endif; ?>
						</div>
						<div class="col-xs-7 name"><?php echo $rider->name; ?> <?php fantasy_cycling_flag($rider->nat); ?></div>
						<div class="col-xs-3 cost"><?php echo fantasy_cycling_rider_cost($rider->id, false, false); ?></div>
					</div>

					<div class="hidden-sm hidden-md hidden-lg row stats">
						<div class="col-xs-2 rank"><?php echo $rider->rank; ?></div>
						<div class="col-xs-2 points"><?php echo $rider->points; ?></div>
						<div class="col-xs-3 last-year"><?php echo $last_year_result->place; ?></div>
						<div class="col-xs-5 last-race">
							<?php echo $last_race->place; ?> (<?php echo fc_trim_string($last_race->event, 16); ?>)
						</div>
					</div>

					<div class="row hidden-xs smplus">
						<div class="col-sm-1">
							<?php if (!fantasy_cycling_is_rider_on_team($rider->id, fantasy_cycling_get_user_team_id())) : ?>
								<a href="#" class="add-rider" data-id="<?php echo $rider->id; ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
							<?php else : ?>
								<div class="empty-add-rider">N</div>
							<?php endif; ?>
						</div>
						<div class="col-sm-4 name"><?php echo $rider->name; ?> <?php fantasy_cycling_flag($rider->nat); ?></div>
						<div class="col-sm-1 proj"><?php echo fantasy_cycling_get_rider_place_prediction($next_race->id, $rider->id); ?></div>
						<div class="col-sm-1 rank"><?php echo $rider->rank; ?></div>
						<div class="col-sm-1 points"><?php echo $rider->points; ?></div>
						<div class="col-sm-1 last-year"><?php echo $last_year_result->place; ?></div>
						<div class="col-sm-1 last-race"><?php echo $last_race->place; ?></div>
						<div class="col-sm-2 cost"><?php echo fantasy_cycling_rider_cost($rider->id, false, false); ?></div>
					</div>

				</div>

			<?php endforeach; endif; ?>

		</div>

		<?php echo add_riders_modal_pagination_ajax(); ?>

	</div>

</div>
