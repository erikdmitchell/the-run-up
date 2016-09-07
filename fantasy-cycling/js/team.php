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
				<% if (!onTeam) { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
				<% } %>
			</div>
			<div class="col-xs-7 name"><span><%= name %></span> <%= flag %></div>
			<div class="col-xs-3 cost"><%= cost %></div>
		</div>

		<div class="hidden-sm hidden-md hidden-lg row stats">
			<div class="col-xs-2 rank"><%= rank.rank %></div>
			<div class="col-xs-2 points"><%= rank.points %></div>
			<div class="col-xs-3 last-year"><%= lastYearResult.place %></div>
			<div class="col-xs-5 last-race">
				<%= last_race.place %> (<a href="<%= last_race.url %>"><%= last_race.event %></a>)
			</div>
		</div>

		<div class="row hidden-xs smplus">
			<div class="col-sm-1">
				<% if (!onTeam) { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
				<% } else { %>
					<div class="empty-add-rider"></div>
				<% } %>
			</div>
			<div class="col-sm-4 name"><%= name %> <%= flag %></div>
			<div class="col-sm-1 proj"><%= predictedPlace %></div>
			<div class="col-sm-1 rank"><%= rank.rank %></div>
			<div class="col-sm-1 points"><%= rank.points %></div>
			<div class="col-sm-1 last-year"><%= lastYearResult.place %></div>
			<div class="col-sm-1 last-race"><%= last_race.place %></div>
			<div class="col-sm-2 cost"><%= cost %></div>
		</div>
	</div>
</script>

<script type="text/template" id="tmpl-fc-my-team-list">
	<div class="row header">
		<div class="col-xs-2 col-sm-1">&nbsp;</div>
		<div class="col-xs-6 col-sm-4 name">Name</div>
		<div class="col-xs-2 col-sm-1 cost">Cost</div>
		<div class="col-xs-2 col-sm-1 proj">Proj.</div>
		<div class="hidden-xs col-sm-1 rank">Rank</div>
		<div class="hidden-xs col-sm-1 points">Points</div>
		<div class="hidden-xs col-sm-1 last-year">Last Year</div>
		<div class="hidden-xs col-sm-2 last-race">Last Race</div>
	</div>

	<div id="team-riders"></div>
</script>

<script type="text/template" id="tmpl-fc-team-rider-row">
	<div id="rider-row-<%= rowID %>" class="row rider"></div>
</script>

<script type="text/template" id="tmpl-fc-team-rider-row-content">

	<% if (id) { %>
		<div class="col-xs-2 col-sm-1 add-remove">
			<span class="add-remove">
				<a href="">
					<i class="fa add-rider" aria-hidden="true">
						<button class="tru-add-riders-btn">Add Rider</button>
					</i>
					<i class="fa fa-minus-circle remove-rider" aria-hidden="true"></i>
				</a>
			</span>
		</div>

		<div class="col-xs-6 col-sm-3 name">
			<a href="<%= url %>"><%= name %></a>
			<span class="country"><%= flag %></span>
		</div>

	<% } else { %>
		<div class="col-xs-12 add-remove">
			<span class="add-remove">
				<a href="">
					<i class="fa add-rider" aria-hidden="true">
						<button class="tru-add-riders-btn">Add Rider</button>
					</i>
					<i class="fa fa-minus-circle remove-rider" aria-hidden="true"></i>
				</a>
			</span>
		</div>
	<% } %>

	<div class="col-xs-2 col-sm-1 cost">
		<% if (cost) { %>
			$
		<% } %>
		<%= cost %>
	</div>

	<div class="col-xs-1 col-sm-1 proj"><%= predictedPlace %></div>
	<div class="hidden-xs col-sm-1 rank"><%= rank.rank %> <%= rank.prev_icon %></div>
	<div class="hidden-xs col-sm-1 points"><%= rank.points %></div>
	<div class="hidden-xs col-sm-1 last-year"><%= last_year_result.place %></div>
	<div class="hidden-xs col-sm-3 last-race"><span><%= last_result.place %></span> <a href="<%= last_result.url %>"><%= last_result.event %></a></div>

	<input type="hidden" class="rider-id" value="<%= id %>" />
</script>