<?php
/**
 * template for add rider modal content
 * these are backbone tempaltes
 */

global $fantasy_cycling_user_team;
?>

<script type="text/template" id="tmpl-fc-rider-table">

	<div class="row upper">

		<div class="col-xs-4 note"><i class="startlist fa fa-flag" aria-hidden="true"></i> - On Startlist</div>

		<span class="budget">
			<div class="col-xs-offset-2 col-xs-3 col-sm-offset-3 col-sm-2 text">Budget:</div>
			<div class="col-xs-3 col-sm-offset-0 amount"><?php echo fantasy_cycling_format_cost($fantasy_cycling_user_team->budget); ?></div>
		</span>
	</div>

	<div class="riders-table">

		<div class="hidden-sm hidden-md hidden-lg row stats header">
			<div class="col-xs-4 proj">Projected Finish</div>
			<div class="col-xs-4 rank">Rank</div>
			<div class="col-xs-4 last-year">Last Year</div>
		</div>

		<div class="hidden-xs row header smplus">
			<div class="col-sm-1">&nbsp;</div>
			<div class="col-sm-4 name">Name </div>
			<div class="col-sm-2 proj">Projected Finish</div>
			<div class="col-sm-2 rank">Current Rank</div>
			<div class="col-sm-1 last-year">Last Year</div>
			<div class="col-sm-2 cost">Cost</div>
		</div>

		<div class="rider-list"></div>

	</div>

	<div id="rider-list-loading-more">loading more...</div>

</script>

<script type="text/template" id="tmpl-fc-rider-row">
	<div id="rider-<%= id %>" class="rider">
		<div class="hidden-sm hidden-md hidden-lg row actions">
			<div class="col-xs-2 add-rider-wrap">
				<% if (!onTeam) { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
				<% } %>
			</div>
			<div class="col-xs-7 name">
				<span><a href=""><%= name %></a></span>
				<%= flag %>
				<% if (startlist) { %>
					<span class="startlist"><i class="fa fa-flag" aria-hidden="true"></i></span>
				<% } %>
			</div>
			<div class="col-xs-3 cost">$<%= cost %></div>
		</div>

		<div class="hidden-sm hidden-md hidden-lg row stats">
			<div class="col-xs-4 proj"><%= predictedPlace %></div>
			<div class="col-xs-4 rank"><%= rank.rank %></div>
			<div class="col-xs-4 last-year"><%= lastYearResult.place %></div>
		</div>

		<div class="row hidden-xs smplus add-rider-wrap">
			<div class="col-sm-1">
				<% if (!onTeam) { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
				<% } else { %>
					<div class="empty-add-rider"></div>
				<% } %>
			</div>
			<div class="col-sm-4 name">
				<a href=""><%= name %></a>
				<%= flag %>

				<% if (startlist) { %>
					<span class="startlist"><i class="fa fa-flag" aria-hidden="true"></i></span>
				<% } %>
			</div>
			<div class="col-sm-2 proj"><%= predictedPlace %></div>
			<div class="col-sm-2 rank"><%= rank.rank %></div>
			<div class="col-sm-1 last-year"><%= lastYearResult.place %></div>
			<div class="col-sm-2 cost">$<%= cost %></div>
		</div>
	</div>
</script>

<script type="text/template" id="tmpl-fc-my-team-list">
	<div class="row header">
		<div class="col-xs-2 col-sm-1">&nbsp;</div>
		<div class="col-xs-6 col-sm-3 name">Name</div>
		<div class="col-xs-2 col-sm-2 proj">Projected Finish</div>
		<div class="hidden-xs col-sm-2 rank">Current Rank</div>
		<div class="hidden-xs col-sm-2 last-year">Last Year</div>
		<div class="col-xs-2 col-sm-2 value">Value</div>
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

	<div class="col-xs-2 col-sm-2 proj"><%= predictedPlace %></div>
	<div class="hidden-xs col-sm-2 rank"><%= rank.rank %> <%= rank.prev_icon %></div>
	<div class="hidden-xs col-sm-2 last-year"><%= last_year_result.place %></div>

	<div class="col-xs-2 col-sm-2 value">
		<% if (cost) { %>
			$
		<% } %>
		<%= cost %>
	</div>

	<input type="hidden" class="rider-id" value="<%= id %>" />
</script>