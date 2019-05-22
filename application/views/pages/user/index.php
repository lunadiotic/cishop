<main class="container">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<?php $this->load->view('layouts/_alert'); ?>
			<div class="card mb-3">
				<div class="card-header">
					<span>User</span>
					<a href="<?= base_url('/user/create') ?>" class="btn btn-sm btn-secondary">Tambah</a> 
					<div class="float-right">
						<?= form_open('user/search', ['method' => 'POST']) ?>
						<div class="input-group">
							<?= form_input('keyword', $this->session->userdata('keyword'), ['placeholder' => 'Search', 'class' => 'form-control form-control-sm text-center']) ?>
							<div class="input-group-append">
								<button class="btn btn-info btn-sm" type="submit"><i class="fas fa-search"></i></button>
								<a href="<?= base_url('user/reset') ?>" class="btn btn-info btn-sm"><i class="fas fa-eraser"></i></a>
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
								<th scope="col">User</th>
								<th scope="col">E-Mail</th>
								<th scope="col">Role</th>
								<th scope="col">Status</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0; foreach ($content as $row): $no++; ?>
							<tr>
								<th scope="row"><?= $no ?></th>
								<td>
									<p>
										<?php if ($row->photo != ''): ?>
										<img src="<?= base_url("/images/profile/$row->photo") ?>" alt="" height="50">
										<?php else : ?>
										<img src="<?= base_url("/images/profile/default.jpg") ?>" alt="" height="50">
										<?php endif ?>
										<?= $row->name ?>
									</p> 
								</td>
								<td><?= $row->email ?></td>
								<td><?= $row->role ?></td>
								<td><?=  $row->is_active ? 'Aktif' : 'Non-Aktif' ?></td>
								<td>
									<?= form_open("user/delete/{$row->id}", ['method' => 'POST']) ?>
										<?= form_hidden('id', $row->id) ?>
										<a href="<?= base_url("user/edit/{$row->id}") ?>">
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
