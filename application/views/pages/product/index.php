<main class="container">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<?php $this->load->view('layouts/_alert'); ?>
			<div class="card mb-3">
				<div class="card-header">
					<span>Product</span>
					<a href="<?= base_url('/product/create') ?>" class="btn btn-sm btn-secondary">Tambah</a> 
					<div class="float-right">
						<?= form_open('product/search', ['method' => 'POST']) ?>
						<div class="input-group">
							<?= form_input('keyword', $this->session->userdata('keyword'), ['placeholder' => 'Search', 'class' => 'form-control form-control-sm text-center']) ?>
							<div class="input-group-append">
								<button class="btn btn-info btn-sm" type="submit"><i class="fas fa-search"></i></button>
								<a href="<?= base_url('product/reset') ?>" class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></a>
							</div>
						</div>
						<?= form_close() ?>
					</div>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Product</th>
								<th scope="col">Kategori</th>
								<th scope="col">Harga</th>
								<th scope="col">Stok</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0; foreach ($content as $row): $no++; ?>
							<tr>
								<th scope="row"><?= $no ?></th>
								<td>
									<p>
										<?php if ($row->image != ''): ?>
										<img src="<?= base_url("/images/product/$row->image") ?>" alt="" height="50">
										<?php else : ?>
										<img src="<?= base_url("/images/product/default.png") ?>" alt="" height="50">
										<?php endif ?>
										<?= $row->title ?>
									</p> 
								</td>
								<td><span class="badge badge-primary"><i class="fas fa-tags"></i> <?= $row->category_title ?></span></td>
								<td>Rp<?= number_format($row->price, 0, ',', '.') ?>,-</td>
								<td><?=  $row->is_available ? 'Ya' : 'Tidak' ?></td>
								<td>
									<?= form_open("product/delete/{$row->id}", ['method' => 'POST']) ?>
										<?= form_hidden('id', $row->id) ?>
										<a href="<?= base_url("product/edit/{$row->id}") ?>">
											<button class="btn btn-sm action-icon" type="button"><i class="fas fa-edit text-info"></i></button>
										</a>
										<button 
											class="btn btn-sm action-icon" 
											type="submit" 
											onclick="return confirm('Are you sure you want to delete this item?');"
										>
											<i class="fas fa-trash text-danger"></i>
										</button>
									<?= form_close() ?>
								</td>
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
