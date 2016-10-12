<script type="text/template" id="tmpl-fc-rider-in-race-row">
	<div id="rider-<%= id %>" class="em-row rider">
		<div class="em-col-sm-4">
			<span class="name">
				<% if (onTeam) { %>
				  <span><%= name %></span> <%= flag %>
				<% } else { %>
					<a href="#" class="add-rider" data-id="<%= id %>"><span><%= name %></span></a> <%= flag %>
				<% } %>
				<p><a href="<%= url %>" class="rider-more">more info</a></p>
			</span>
		</div>

		<div class="em-col-sm-1 proj-finish"><%= projected_finish %></div>
		<div class="em-col-sm-1 start-pos"><%= start_position %></div>
		<div class="em-col-sm-1 last-year"><%= last_year_result.place %></div>
		<div class="em-col-sm-2 fantasy-points"><%= fantasy_points %></div>
		<div class="em-col-sm-1 rank"><%= rank %></div>
		<div class="em-col-sm-1 cost">$<%= cost %></div>
	</div>
</script>