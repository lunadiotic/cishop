<main class="container">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view('layouts/_sidebar'); ?>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					Konfirmasi Order #<?= $order->invoice ?>
					<div class="float-right">
						<?php $this->load->view('layouts/_status', ['status' => $order->status]) ?>
					</div>
				</div>
				<?= form_open_multipart($form_action, ['method' => 'POST']) ?>
					<?= form_hidden('id_orders', $order->id) ?>
					<div class="card-body">
						<div class="form-group">
							<label for="">Invoice</label>
							<?= form_input('invoice', $input->invoice, ['class' => 'form-control', 'readonly' => true]) ?>
						</div>
						<div class="form-group">
							<label for="">Dari Rekening</label>
							<?= form_input(['type' => 'number', 'name' => 'account_number', 'value' => $input->account_number, 'class' => 'form-control']) ?>
							<?= form_error('account_number') ?>
						</div>
						<div class="form-group">
							<label for="">Name Pemilik</label>
							<?= form_input('account_name', $input->account_name, ['class' => 'form-control']) ?>
							<?= form_error('account_name') ?>
						</div>
						<div class="form-group">
							<label for="">Sebesar</label>
							<?= form_input(['type' => 'number', 'name' => 'nominal', 'value' => $input->nominal, 'class' => 'form-control']) ?>
							<?= form_error('nominal') ?>
						</div>
						<div class="form-group">
							<label for="">Catatan</label>
							<?= form_textarea(['name' => 'note', 'value' => $input->note, 'rows' => 4, 'class' => 'form-control']) ?>
							<?= form_error('note') ?>	
						</div>
						<div class="form-group">
							<label for="">Bukti Transfer</label> <br>
							<?= form_upload('image') ?>
							<?php if ($this->session->flashdata('image_error')) : ?>
								<small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
							<?php endif ?>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
					</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</main>
