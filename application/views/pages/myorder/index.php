<main class="container">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view('layouts/_sidebar'); ?>
		</div>
		<div class="col-md-9">    
			<?php $this->load->view('layouts/_alert'); ?>            
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							Daftar Pembelian
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
									<?php foreach($content as $row): ?>
										<tr>
											<th><a href="<?= base_url("/myorder/detail/$row->invoice") ?>">#<?= $row->invoice ?></a></th>
											<td><?= str_replace('-', '/', date("d-m-Y", strtotime($row->date))) ?></td>
											<th>Rp<?= number_format($row->total, 0 ,',','.') ?>,-</th>
											<td><?php $this->load->view('layouts/_status', ['status' => $row->status]) ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
