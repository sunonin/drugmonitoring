<form action="<?= $product_route; ?>" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="customer_id" value="<?= $id; ?>">
	
	<div class="row">
		<div class="col-md-12 mb-3">
			<div class="btn-group float-right">
	            <button type="button" id="btn-add-product" class="btn btn-info btn-sm btn-add-product"><i class="fas fa-plus"></i> Add Product</button>
	        </div>
		</div>

		<div class="col-md-12">
			<table id="tb-cust-product" class="table table-bordered table-striped">
				<thead>
					<tr style="background-color: #28a745; color: white;">
						<th class="text-center" width="3%">#</th>
						<th class="text-center" width="15%">PRODUCT</th>
						<th class="text-center" width="15%">UOM</th>
						<th class="text-center" width="15%">PRICE</th>
						<th class="text-center" width="5%">ACTION</th>
					</tr>
				</thead>
				<tbody id="tbody-cust-product">
					<?php if (empty($entries)): ?>
						<tr class="init">
							<td colspan="5" class="text-center">No data Available</td>
						</tr>
					<?php else: ?>
						<?php foreach ($entries as $key => $entry): ?>
							<tr>
								<td><b><?= $key+1; ?>.</b></td>
								<td>
									<div class="form-group">
								      <select name="prod_ids[]" class="form-control select2 prod_id" placeholder="-- Please Select Product --" style="width: 100%;">
								      	<option selected disabled>-- Please Select Product --</option>
								          <?php foreach ($prod_opts as $key => $type): ?>
								            <option value="<?= $key; ?>" data-price="<?= $type['price']; ?>" data-uom="<?= $type['uom']; ?>" <?= $entry['product'] == $key ? 'selected' : '';?>><?= $type['item']; ?></option>';
								          <?php endforeach ?>
								      </select>
								    </div>
								</td>
								<td class="text-center">
									<input type="text" name="uom[]" class="form-control uom text-right" value="<?= $entry['uom'];?>" readonly>
								</td>
								<td class="text-center">
									<input type="number" step="0.0001" min="0.0000" name="price[]" class="form-control price text-right" value="<?= number_format($entry['price'], 4);?>">
								</td>
								<td class="text-center">
									<div class="btn-group">
								    	<button class="btn btn-sm btn-danger btn-block btn-remove"><i class="fa fa-trash"></i> Remove</button>
								    </div>
								</td>
							</tr>
						<?php endforeach ?>						
					<?php endif ?>
				</tbody>
				
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="btn-group float-right">
	            <a href="customers.php" class="btn btn-default btn-sm"><i class="fas fa-arrow-left"></i> Cancel</a>
	            <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-save"></i> Submit</button>
	        </div>
		</div>
	</div>

</form>