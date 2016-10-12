<?php
global $fantasy_cycling_user_team;
$this_weeks_races=fc_get_this_weeks_races();
?>

<script type="text/template" id="tmpl-fc-rider-table">

	<div class="row upper">
		<span class="budget">
			<div class="col-xs-offset-2 col-xs-3 col-sm-offset-3 col-sm-2 text">Budget:</div>
			<div class="col-xs-3 col-sm-offset-0 amount"><?php echo fantasy_cycling_format_cost($fantasy_cycling_user_team->budget); ?></div>
		</span>
	</div>

	<div class="row actions">

		<form id="rider-list-filter" name="rider-list-filter">

			<div class="races-this-week col-sm-6">
				<div class="sub-header">Races this Week</div>

				<?php foreach ($this_weeks_races as $race) : ?>
					<input type="radio" name="startlist" class="startlist-filter" value="<?php echo $race->id; ?>"> <?php echo $race->name; ?>
				<?php endforeach; ?>

			</div>

			<div class="col-sm-1">
				<a href="#" class="clear">Clear</a>
			</div>
		</form>
	</div>

	<div class="riders-table">
		<div class="row rider header"></div>

		<div class="rider-list"></div>

		<div id="rider-list-loading-more">loading more riders...</div>
	</div>
</script>