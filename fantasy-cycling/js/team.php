<?php
/**
 * template for add rider modal content
 * these are backbone tempaltes
 */
?>

<script type="text/template" id="tmpl-fc-rider-table">
	<div class="riders-table">
		<div class="row rider header">
			<div class="col-sm-3 name">Name</div>
			<div class="col-sm-2 cost">Cost</div>
			<div class="col-sm-1 points">Points</div>
			<div class="col-sm-1 rank">Rank</div>
			<div class="col-sm-2 last-year">Last Year</div>
			<div class="col-sm-3 last-race">Last Race</div>
		</div>

		<div class="rider-list"></div>

		<div id="rider-list-loading-more">loading more...</div>
	</div>
</script>

<script type="text/template" id="tmpl-fc-rider-row">
	<div id="rider-<%= id %>" class="row rider">
		<div class="col-sm-3">
			<span class="name">
				<% if (onTeam) { %>
				  <%= name %>
				<% } else { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><%= name %></a>
					<p><a href="<%= url %>" class="rider-more">more info</a></p>
				<% } %>
			</span>
		</div>

		<div class="col-sm-2 cost"><%= cost %></div>
		<div class="col-md-1 points"><%= points %></div>
		<div class="col-sm-1 rank"><%= rank %></div>
		<div class="col-sm-2 last-year"><%= lastYearResult.place %></div>
		<div class="col-sm-3 last-race"><span><%= last_race.place %></span> <a href="<%= last_race.url %>"><%= last_race.event %></a></div>
	</div>
</script>