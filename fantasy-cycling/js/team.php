<?php
/**
 * template for add rider modal content
 * these are backbone tempaltes
 */

global $fantasy_cycling_user_team;
?>

<script type="text/template" id="tmpl-fc-rider-table">

	<div class="row budget">
		<div class="col-xs-3 col-sm-offset-7 col-sm-2 text">Budget:</div>
		<div class="col-xs-offset-6 col-xs-3 col-sm-offset-0 amount"><?php echo fantasy_cycling_format_cost($fantasy_cycling_user_team->budget); ?></div>
	</div>

	<div class="riders-table">

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

		<div class="rider-list"></div>

	</div>

	<div id="rider-list-loading-more">loading more...</div>

</script>

<script type="text/template" id="tmpl-fc-rider-row">
	<div id="rider-<%= id %>" class="rider">
		<div class="hidden-sm hidden-md hidden-lg row actions">
			<div class="col-xs-2">
				<% if (onTeam) { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
				<% } %>
			</div>
			<div class="col-xs-7 name"><%= name %> FLAG</div>
			<div class="col-xs-3 cost"><%= cost %></div>
		</div>

		<div class="hidden-sm hidden-md hidden-lg row stats">
			<div class="col-xs-2 rank"><%= rank %></div>
			<div class="col-xs-2 points"><%= points %></div>
			<div class="col-xs-3 last-year"><%= lastYearResult.place %></div>
			<div class="col-xs-5 last-race">
				<%= last_race.place %> (<a href="<%= last_race.url %>"><%= last_race.event %></a>)
			</div>
		</div>

		<div class="row hidden-xs smplus">
			<div class="col-sm-1">
				<% if (onTeam) { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
				<% } else { %>
					<div class="empty-add-rider">N</div>
				<% } %>
			</div>
			<div class="col-sm-4 name"><%= name %> FLAG</div>
			<div class="col-sm-1 proj">PREDIC</div>
			<div class="col-sm-1 rank"><%= rank %></div>
			<div class="col-sm-1 points"><%= points %></div>
			<div class="col-sm-1 last-year"><%= lastYearResult.place %></div>
			<div class="col-sm-1 last-race"><%= last_race.place %></div>
			<div class="col-sm-2 cost"><%= cost %></div>
		</div>
	</div>
</script>