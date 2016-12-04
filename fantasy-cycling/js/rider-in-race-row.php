<script type="text/template" id="tmpl-fc-rider-in-race-row">

	<div id="rider-<%= id %>" class="rider">
		<div class="hidden-sm hidden-md hidden-lg row actions">
			<div class="col-xs-2 add-rider-wrap">
				<% if (!onTeam) { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
				<% } %>
			</div>
			<div class="col-xs-7 name">
				<span><a href="<%= url %>"><%= name %></a></span>
				<%= flag %>
			</div>
			<div class="col-xs-3 cost"><%= cost %></div>
		</div>

		<div class="hidden-sm hidden-md hidden-lg row stats">
			<div class="col-xs-3 proj-finish"><%= projected_finish %></div>
			<div class="col-xs-3 start-pos"><%= start_position %></div>
			<div class="col-xs-3 last-year"><%= last_year_result.place %></div>
			<div class="col-xs-3 rank"><%= rank %></div>
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
				<a href="<%= url %>"><%= name %></a>
				<%= flag %>
			</div>

			<div class="col-sm-1 proj-finish"><%= projected_finish %></div>
			<div class="col-sm-1 start-pos"><%= start_position %></div>
			<div class="col-sm-1 last-year"><%= last_year_result.place %></div>
			<div class="col-sm-1 fantasy-points"><%= fantasy_points %></div>
			<div class="col-sm-1 rank"><%= rank %></div>
			<div class="col-sm-2 cost"><%= cost %></div>
		</div>
	</div>

</script>