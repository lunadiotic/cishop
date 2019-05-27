<main class="container">
	<div class="row">
		<div class="col-md-8">
		<?php $this->load->view('layouts/_alert'); ?>
			<div class="card">
				<div class="card-header">
					Alamat Pengiriman
				</div>
				<div class="card-body">
					<?= form_open('/checkout/done') ?>
						<div class="form-group">
							<label for="">Nama</label>
							<?= form_input('name', $input->name, ['class' => 'form-control', 'placeholder' => 'Masukkan nama penerima']) ?>
							<?= form_error('name') ?>
						</div>
						<div class="form-group">
							<label for="">Alamat</label>
							<?= form_textarea(['name' => 'address', 'value' => $input->address, 'rows' => 4, 'class' => 'form-control']) ?>
							<?= form_error('address') ?>	
						</div>
						<div class="form-group">
							<label for="">Telepon</label>
							<?= form_input('phone', $input->phone, ['class' => 'form-control', 'placeholder' => 'Masukkan nomor telepon penerima']) ?>
							<?= form_error('phone') ?>
						</div>
						<button type="submit" class="btn btn-primary">Checkout</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-header">
							Cart
						</div>
						<div class="card-body">
							<table class="table">
								<thead>
									<tr>
										<th>Produk</th>
										<th>Qty</th>
										<th>Harga</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($cart as $row): ?>
									<tr>
										<td><?= $row->title ?></td>
										<td><?= $row->qty ?></td>
										<td>Rp<?= number_format($row->price, 0 ,',','.') ?>,-</td>
									</tr>
									<tr>
										<td colspan="2">Subtotal</td>
										<td class="text-center">Rp<?= number_format($row->subtotal, 0 ,',','.') ?>,-</td>
									</tr>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="2">Total</th>
										<th>Rp<?= number_format(array_sum(array_column($cart, 'subtotal')), 0 ,',','.') ?>,-</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
