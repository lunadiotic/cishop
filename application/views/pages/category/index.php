<main class="container">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<?php $this->load->view('layouts/_alert'); ?>
			<div class="card mb-3">
				<div class="card-header">
					<span>Kategori</span>
					<a href="<?= base_url('/category/create') ?>" class="btn btn-sm btn-secondary">Tambah</a> 
					<div class="float-right">
						<div class="input-group">
							<input type="text" class="form-control form-control-sm text-center" placeholder="Cari">
							<div class="input-group-append">
								<button class="btn btn-info btn-sm" type="submit"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
							<th scope="col">#</th>
							<th scope="col">Slug</th>
							<th scope="col">Title</th>
							<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0; foreach ($content as $row): $no++; ?>
							<tr>
								<th scope="row"><?= $no ?></th>
								<td><?= $row->slug ?></td>
								<td><?= $row->title ?></td>
								<td>
									<?= form_open("category/delete/{$row->id}", ['method' => 'POST']) ?>
										<?= form_hidden('id', $row->id) ?>
										<a href="<?= base_url("category/edit/{$row->id}") ?>">
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
