<form action="<?= $route; ?>" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="suspect_id" value="<?= $id; ?>">
	<input type="hidden" name="prev_status" value="<?= isset($data['status']) ? $data['status'] : ''; ?>">
	<div class="row">
		<div class="col-md-6">
				<div class="form-group row">
          <label for="lastname" class="col-sm-4 col-form-label">Last Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name" value="<?= isset($data['lastname']) ? $data['lastname'] : ''; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="firstname" class="col-sm-4 col-form-label">First Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name" value="<?= isset($data['firstname']) ? $data['firstname'] : ''; ?>" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="middlename" class="col-sm-4 col-form-label">Middle Name</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter Middle Name" value="<?= isset($data['middlename']) ? $data['middlename'] : ''; ?>" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="birthdate" class="col-sm-4 col-form-label">Birthdate</label>
          <div class="col-sm-8">
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
							<input type="text" class="form-control datetimepicker-input" name="birthdate" id="birthdate" data-target="#reservationdate" value="<?= isset($data['birthdate']) ? $data['birthdate'] : ''; ?>"/>
							<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
								<div class="input-group-text"><i class="fa fa-calendar"></i></div>
							</div>
						</div>
          </div>
        </div>

        <div class="form-group row">
          <label for="gender" class="col-sm-4 col-form-label">Gender</label>
          <div class="col-sm-8">
            <select name="gender" class="form-control select2" style="width: 100%;">
							<option selected disabled>-- Please Select Gender --</option>
							<?php if (isset($data['id'])): ?>
								<option value="male" <?= $data['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
								<option value="female" <?= $data['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
							<?php else: ?>
								<option value="male">Male</option>
								<option value="female">Female</option>
							<?php endif ?>
						</select>
          </div>
        </div>

        <div class="form-group row">
          <label for="contact_no" class="col-sm-4 col-form-label">Contact No.</label>
	        <div class="col-sm-8">
		        <div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><strong>(+63)</strong></span>
							</div>
							<input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact No." value="<?= isset($data['contact_no']) ? $data['contact_no'] : ''; ?>" required>
						</div>
	        </div>
        </div>

        <div class="form-group row">
          <label for="street" class="col-sm-4 col-form-label">Street</label>
          <div class="col-sm-8">
            <textarea class="form-control" rows="3" name="street" placeholder="Enter Street" value="<?= isset($data['street']) ? $data['street'] : ''; ?>"><?= isset($data['street']) ? $data['street'] : ''; ?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label for="region" class="col-sm-4 col-form-label">Region</label>
          <div class="col-sm-8">
            <select name="region" id="region" class="form-control select2" style="width: 100%;">
							<option selected disabled>-- Please Select Region --</option>
							<?php if (isset($data['id'])): ?>
								<?php foreach ($regions as $key => $region): ?>
									<option value="<?= $key; ?>" <?= $key == $data['region_c'] ? 'selected' : ''; ?>><?= $region; ?></option>
								<?php endforeach ?>
							<?php else: ?>
								<?php foreach ($regions as $key => $region): ?>
									<option value="<?= $key; ?>"><?= $region; ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
          </div>
        </div>

        <div class="form-group row">
          <label for="province" class="col-sm-4 col-form-label">Province</label>
          <div class="col-sm-8">
            <select name="province" id="province" class="form-control select2" style="width: 100%;">
							<option selected disabled>-- Please Select Province --</option>
							<?php if (isset($data['province_c'])): ?>
								<?php foreach ($provinces as $key => $province): ?>
									<option value="<?= $key; ?>" <?= $key == $data['province_c'] ? 'selected' : ''; ?>><?= $province; ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
          </div>
        </div>

        <div class="form-group row">
          <label for="lgu" class="col-sm-4 col-form-label">LGU</label>
          <div class="col-sm-8">
            <select name="lgu" id="lgu" class="form-control select2" style="width: 100%;">
							<option selected disabled>-- Please Select LGU --</option>
							<?php if (isset($data['lgu_c'])): ?>
								<?php foreach ($lgus as $key => $lgu): ?>
									<option value="<?= $key; ?>" <?= $key == $data['lgu_c'] ? 'selected' : ''; ?>><?= $lgu; ?></option>
								<?php endforeach ?>
							<?php endif ?>
						</select>
          </div>
        </div>

        <div class="form-group row">
          <label for="status" class="col-sm-4 col-form-label">Status</label>
          <div class="col-sm-8">
            <select name="status" class="form-control select2" style="width: 100%;">
							<option selected disabled>-- Please Select Status --</option>
							<?php if (isset($data['id'])): ?>
								<option value="Under Investigation" <?= $data['status'] == 'Under Investigation' ? 'selected' : ''; ?>>Under Investigation</option>
								<option value="Surrendered" <?= $data['status'] == 'Surrendered' ? 'selected' : ''; ?>>Surrendered</option>
								<option value="Apprehended" <?= $data['status'] == 'Apprehended' ? 'selected' : ''; ?>>Apprehended</option>
								<option value="Escaped" <?= $data['status'] == 'Escaped' ? 'selected' : ''; ?>>Escaped</option>
								<option value="Deceased" <?= $data['status'] == 'Deceased' ? 'selected' : ''; ?>>Deceased</option>
							<?php else: ?>
								<option value="Under Investigation">Under Investigation</option>
								<option value="Surrendered">Surrendered</option>
								<option value="Apprehended">Apprehended</option>
								<option value="Escaped">Escaped</option>
								<option value="Deceased">Deceased</option>
							<?php endif ?>
						</select>
          </div>
        </div>


		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="btn-group float-right">
	            <a href="suspects.php" class="btn btn-default btn-sm"><i class="fas fa-arrow-left"></i> Cancel</a>
	            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-save"></i> Submit</button>
	        </div>
		</div>
	</div>

</form>