<?php require_once 'controller/SuspectsController.php'; ?>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Filter</h3>
			</div>

			<div class="card-body">
				<form method="GET">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
					          <label for="name" class="col-sm-2 col-form-label">Name</label>
					          <div class="col-sm-8">
					            <input type="text" class="form-control" id="name" name="name" placeholder="Enter First/Last Name" value="<?= $filter_name; ?>">
					          </div>
					        </div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<label for="bdate" class="col-sm-2 col-form-label">Birthdate</label>
								<div class="col-sm-8">
									<div class="input-group date" id="reservationdate" data-target-input="nearest">
										<input type="text" class="form-control datetimepicker-input" name="bdate" data-target="#reservationdate" value="<?= $filter_bdate; ?>"/>
										<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
											<div class="input-group-text"><i class="fa fa-calendar"></i></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="btn-group">
								<button type="submit" class="btn btn-sm btn-info btn-block"><i class="fa fa-filter"></i> Filter</button>
							</div>

							<div class="btn-group">
								<a href="suspects.php" class="btn btn-sm btn-secondary btn-block"><i class="fa fa-refresh" aria-hidden="true"></i> Clear</a>
							</div>

						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Suspects List</h3>
				<div class="card-tools">
					<a href="encode_suspect.php" class="btn btn-block btn-primary btn-sm"><i class="fa fa-plus"></i> Encode</a>
				</div>
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
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $key => $dd): ?>
							<tr>
								<td><?= $dd['id']; ?></td>
								<td><?= $dd['name']; ?></td>
								<td><?= $dd['address']; ?></td>
								<td><?= $dd['birthdate']; ?></td>
								<td><?= $dd['age']; ?></td>
								<td><?= $dd['contact_no']; ?></td>
								<td><?= $dd['status']; ?></td>
								<td>
									<div class="btn-group">
										<a href="edit_suspect.php?id=<?= $dd['id']; ?>" class="btn btn-sm btn-primary btn-block"><i class="fa fa-edit"></i></a>
									</div>
									<div class="btn-group">
										<a href="route/suspects/delete_suspect.php?id=<?= $dd['id']; ?>" class="btn btn-sm btn-danger btn-block"><i class="fa fa-trash-alt"></i></a>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
					
				</table>
			</div>

		</div>
	</div>

</div>
