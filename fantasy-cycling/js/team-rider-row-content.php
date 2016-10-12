<script type="text/template" id="tmpl-fc-team-rider-row-content">
	<div class="em-col-sm-4">
		<span class="add-remove">
			<a href="">
				<i class="fa add-rider" aria-hidden="true">Add Rider</i>
				<i class="fa fa-minus-circle remove-rider" aria-hidden="true"></i>
			</a>
		</span>
		<span class="name"><a href="<%= url %>"><%= name %></a></span>
		<span class="country"><%= flag %></span>
	</div>

	<div class="em-col-sm-2 fantasy-points"><%= fantasy_points %></div>
	<div class="em-col-sm-2 uci-points"><%= uci_points %></div>
	<div class="em-col-sm-1 rank"><%= rank %></div>
	<div class="em-col-sm-1 last-race"><a href="<%= last_result.url %>"><%= last_result.place %></a></div>
	<div class="em-col-sm-1 perc-owned"><%= perc_owned %></div>
	<div class="em-col-sm-1 cost">
		<% if (cost) { %>
			$
		<% } %>
		<%= cost %>
	</div>

	<input type="hidden" class="rider-id" value="<%= id %>" />
</script>

