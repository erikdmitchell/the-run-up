<script type="text/template" id="tmpl-fc-rider-row">

	<div id="rider-<%= id %>" class="rider">
		<div class="hidden-sm hidden-md hidden-lg row actions">
			<div class="col-xs-2 add-rider-wrap">
					<i class="fa fa-usd dollar" aria-hidden="true"></i>
					<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
					<a href="#" class="remove-rider" data-id="<%= id %>"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
			</div>
			<div class="col-xs-7 name">
				<span><a href="<%= url %>"><%= name %></a></span>
				<%= flag %>
			</div>
			<div class="col-xs-3 cost">$<%= cost %></div>
		</div>

		<div class="hidden-sm hidden-md hidden-lg row stats">
			<div class="col-xs-3 fantasy-points"><%= fantasy_points %></div>
			<div class="col-xs-3 rank"><%= rank %></div>
			<div class="col-xs-3 last-race"><a href="<%= last_result.url %>"><%= last_result.place %></a></div>
			<div class="col-xs-3 perc-owned"><%= perc_owned %></div>
		</div>

		<div class="row hidden-xs smplus add-rider-wrap">
			<div class="col-sm-1">
				<i class="fa fa-usd dollar" aria-hidden="true"></i>
				<a href="#" class="add-rider" data-id="<%= id %>"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
				<a href="#" class="remove-rider" data-id="<%= id %>"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
			</div>
			<div class="col-sm-4 name">
				<a href="<%= url %>"><%= name %></a>
				<%= flag %>
			</div>

			<div class="col-sm-1 fantasy-points"><%= fantasy_points %></div>
			<div class="col-sm-1 rank"><%= rank %></div>
			<div class="col-sm-1 last-race"><a href="<%= last_result.url %>"><%= last_result.place %></a></div>
			<div class="col-sm-2 perc-owned"><%= perc_owned %></div>
			<div class="col-sm-2 cost">$<%= cost %></div>
		</div>
	</div>

</script>