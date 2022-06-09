<?php require_once 'controller/StatisticsController.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Filter</h3>
			</div>

			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
				        <div class="form-group row">
				          <label for="region" class="col-sm-3 col-form-label">Region</label>
				          <div class="col-sm-9">
				            <select name="region" id="region" class="form-control select2" style="width: 100%;">
								<option selected disabled>-- Please Select Region --</option>
								<?php foreach ($regions as $key => $region): ?>
									<option value="<?= $key; ?>"><?= $region; ?></option>
								<?php endforeach ?>
							</select>
				          </div>
				        </div>
					</div>

					<div class="col-md-4">
						<div class="form-group row">
				          <label for="province" class="col-sm-3 col-form-label">Province</label>
				          <div class="col-sm-9">
				            <select name="province" id="province" class="form-control select2" style="width: 100%;">
								<option value="" selected disabled>-- Please Select Province --</option>
							</select>
				          </div>
				        </div>
					</div>

					<div class="col-md-4">
						<div class="form-group row">
				          <label for="lgu" class="col-sm-3 col-form-label">LGU</label>
				          <div class="col-sm-9">
				            <select name="lgu" id="lgu" class="form-control select2" style="width: 100%;">
								<option value="" selected disabled>-- Please Select LGU --</option>
							</select>
				          </div>
				        </div>
					</div>
					

					<div class="col-md-12">
						<div class="btn-group">
							<button type="button" class="btn btn-sm btn-info btn-block btn-filter"><i class="fa fa-filter"></i> Filter</button>
						</div>

						<div class="btn-group">
							<a type="button" class="btn btn-block btn-sm btn-primary btn-generate"><i class="fa fa-download"></i> Generate</a>
						</div>

						<div class="btn-group">
							<a href="statistics_age.php" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-refresh" aria-hidden="true"></i> Clear</a>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Masterlist</h3>
			</div>

			<div class="card-body">
				<table id="tb-suspects" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th></th>
							<th>REGION</th>
							<th>PROVINCE</th>
							<th>LGU</th>
							<th>AGE<br>(0-12)</th>
							<th>AGE<br>(13-18)</th>
							<th>AGE<br>(19-25)</th>
							<th>AGE<br>(26-35)</th>
							<th>AGE<br>(36-50)</th>
							<th>AGE<br>(51-65)</th>
							<th>AGE<br>(66 and above)</th>
						</tr>
					</thead>
					<tbody id="tbody-suspects">
						<?php foreach ($age_bracket as $key => $dd): ?>
							<tr>
								<td><?= $dd['id']; ?></td>
								<td><?= $dd['region']; ?></td>
								<td><?= $dd['province']; ?></td>
								<td><?= $dd['lgu']; ?></td>
								<td><?= $dd['bracket1']; ?></td>
								<td><?= $dd['bracket2']; ?></td>
								<td><?= $dd['bracket3']; ?></td>
								<td><?= $dd['bracket4']; ?></td>
								<td><?= $dd['bracket5']; ?></td>
								<td><?= $dd['bracket6']; ?></td>
								<td><?= $dd['bracket7']; ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
					
				</table>
			</div>

		</div>
	</div>

</div>
