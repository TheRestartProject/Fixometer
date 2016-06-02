<section id="ho-activity" class="row">
	<div class="col-md-12">
		<h2>Activity</h2>
	</div>
	<div class="col-md-3">
		<div class="text-center">
			<h4>Participants</h4>
			<div class="number"><?php echo $counters['pax']; ?></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="text-center">
			<h4>Hours Volunteered</h4>
			<div class="number"><?php echo $counters['hours']; ?></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="text-center">
			<h4>Restart Groups</h4>
			<div class="number"><?php echo $counters['groups']; ?></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="text-center">
			<h4>Parties Thrown</h4>
			<div class="number"><?php echo $counters['parties']; ?></div>
		</div>
	</div>
</section>

<section id="ho-devices" class="row">
	<div class="col-md-12">
		<h2>Devices &amp; Appliances</h2>
	</div>
	<div class="col-md-3">
		<div class="text-center">
			<h4>Total Attempts</h4>
			<div class="number"><?php echo $counters['devices']; ?></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="text-center">
			<h4>Fixed</h4>
			<div class="number"><?php echo $counters['statuses'][0]->counter; ?></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="text-center">
			<h4>Repairable</h4>
			<div class="number"><?php echo $counters['statuses'][1]->counter; ?></div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="text-center">
			<h4>End-of-life</h4>
			<div class="number"><?php echo $counters['statuses'][2]->counter; ?></div>
		</div>
	</div>
	<div class="col-md-12">
		<h3>Highest number of attempts</h3>
	</div>
	<div class="col-md-10 col-md-offset-1">		
		<div class="row">
			<div class="col-md-4 text-center">
				<h4><?php echo $counters['most_seen'][0]->name; ?></h4>
				<div class="number"><?php echo $counters['most_seen'][0]->counter; ?></div>
			</div>
			<div class="col-md-4 text-center">
				<h4><?php echo $counters['most_seen'][1]->name; ?></h4>
				<div class="number"><?php echo $counters['most_seen'][1]->counter; ?></div>
			</div>
			<div class="col-md-4 text-center">
				<h4><?php echo $counters['most_seen'][2]->name; ?></h4>
				<div class="number"><?php echo $counters['most_seen'][2]->counter; ?></div>
			</div>
		</div>
	</div>
</section>

<section class="row" id="ho-rates">
	<div class="col-md-12">
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="all">
			<table class="table table-striped">
				<thead>
					<tr>
						<th></th>
						<th>FIXED</th>
						<th>REPAIRABLE</th>
						<th>END-OF-LIFE</th>
						<th>MOST SEEN</th>
						<th>HIGHEST SUCCESS RATE</th>
						<th>LOWEST SUCCESS RATE</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Computers and Home Office</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Electronic Gadgets</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Home Entertainment</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Kitchen and Household Items</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
		
		
		
		<div role="tabpanel" class="tab-pane" id="profile">...</div>
		<div role="tabpanel" class="tab-pane" id="messages">...</div>
		<div role="tabpanel" class="tab-pane" id="settings">...</div>
	</div>
	<ul class="nav nav-pills nav-justified" role="tablist">
		<li role="presentation" class="active"><a href="#all" aria-controls="home" role="tab" data-toggle="tab">All</a></li>
		<li role="presentation"><a href="#">Profile</a></li>
		<li role="presentation"><a href="#">Messages</a></li>
	</ul>
	</div>
</section>

<?php dbga($rates); ?>