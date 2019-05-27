<main class="container">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<?php $this->load->view('layouts/_alert'); ?>
			<div class="card mb-3">
				<div class="card-header">
					<span>Pesanan</span>
					<div class="float-right">
						<?= form_open('orders/search', ['method' => 'POST']) ?>
						<div class="input-group">
							<?= form_input('keyword', $this->session->userdata('keyword'), ['placeholder' => 'Search', 'class' => 'form-control form-control-sm text-center']) ?>
							<div class="input-group-append">
								<button class="btn btn-info btn-sm" type="submit"><i class="fas fa-search"></i></button>
								<a href="<?= base_url('orders/reset') ?>" class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></a>
							</div>
						</div>
						<?= form_close() ?>
					</div>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
						</thead>
						<tbody>
							<?php $no = 0; foreach ($content as $row): $no++; ?>
							<tr>
								<td>
									<strong><a href="<?= base_url("/orders/detail/$row->id") ?>">#<?= $row->invoice ?></a></strong>
								</td>
								<td><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))) ?></td>
								<td>Rp<?= number_format($row->total, 0 ,',','.') ?>,-</td>
								<td><?php $this->load->view('layouts/_status', ['status' => $row->status]) ?></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<nav aria-label="Page navigation example">
						<?= $pagination ?>
					</nav>
				</div>
			</div>
		</div>
	</div>
</main>
