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

		<div class="col-xs-5 col-sm-3 name">
			<a href="<%= url %>"><%= name %></a>
			<span class="hidden-xs country"><%= flag %></span>
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

	<div class="hidden-xs col-sm-2 fantasy-points"><%= fantasy_points %></div>
	<div class="hidden-xs col-sm-2 uci-points"><%= uci_points %></div>
	<div class="col-xs-2 col-sm-1 rank"><%= rank %></div>
	<div class="hidden-xs col-sm-1 last-race"><a href="<%= last_result.url %>"><%= last_result.place %></a></div>
	<div class="hidden-xs col-sm-1 perc-owned"><%= perc_owned %></div>
	<div class="col-xs-3 col-sm-1 value">
		<% if (cost) { %>
			$
		<% } %>
		<%= cost %>
	</div>

	<input type="hidden" class="rider-id" value="<%= id %>" />

</script>