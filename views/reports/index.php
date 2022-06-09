<?php require_once 'controller/ReportsController.php'; ?>

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
							<a href="masterlist.php" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-refresh" aria-hidden="true"></i> Clear</a>
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
							<th>NAME</th>
							<th>ADDRESS</th>
							<th>BIRTHDATE</th>
							<th>AGE</th>
							<th>CONTACT NO.</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody id="tbody-suspects">
						<?php foreach ($data as $key => $dd): ?>
							<tr>
								<td><?= $dd['id']; ?></td>
								<td><?= $dd['name']; ?></td>
								<td><?= $dd['address']; ?></td>
								<td><?= $dd['birthdate']; ?></td>
								<td><?= $dd['age']; ?></td>
								<td><?= $dd['contact_no']; ?></td>
								<td><?= $dd['status']; ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
					
				</table>
			</div>

		</div>
	</div>

</div>
