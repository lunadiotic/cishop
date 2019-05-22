<main class="container">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="card mb-3">
				<div class="card-header">
					<span>Tambah Pengguna</span>
				</div>
				<div class="card-body">
					<?= form_open_multipart($form_action, ['method' => 'POST']) ?>
						<?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>
						<div class="form-group">
							<label for="">Nama</label>
							<?= form_input('name', $input->name, ['class' => 'form-control', 'placeholder' => 'Masukkan nama lengkap']) ?>
							<?= form_error('name') ?>
						</div>
						<div class="form-group">
							<label for="">E-Mail</label>
							<?= form_input(['type' => 'email', 'name' => 'email', 'value' => $input->email, 'class' => 'form-control', 'placeholder' => 'Masukkan alamat email aktif']) ?>
							<?= form_error('email') ?>
						</div>
						<div class="form-group">
							<label for="">Password</label>
							<?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Password']) ?>
							<?= form_error('password') ?>	
						</div>
						<div class="form-group">
							<label for="">Role</label> <br>
							<?= form_radio(['name' => 'role', 'value' => 'admin', 'checked' => $input->role == 'admin' ? true : false]) ?> <label for="">Admin</label>
							<?= form_radio(['name' => 'role', 'value' => 'member', 'checked' => $input->role == 'member' ? true : false]) ?> <label for="">Member</label>
							<?= form_error('is_active') ?>
						</div>
						<div class="form-group">
							<label for="">Status</label> <br>
							<?= form_radio(['name' => 'is_active', 'value' => 1, 'checked' => $input->is_active == 1 ? true : false]) ?> <label for="">Aktif</label>
							<?= form_radio(['name' => 'is_active', 'value' => 0, 'checked' => $input->is_active == 0 ? true : false]) ?> <label for="">Non-Aktif</label>
							<?= form_error('is_active') ?>
						</div>
						<div class="form-group">
							<label for="">Foto</label> <br>
							<?= form_upload('photo') ?>
							<?php if ($this->session->flashdata('image_error')) : ?>
								<small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
							<?php endif ?>
							<?php if (!empty($input->photo)): ?>
								<img src="<?= site_url("/images/profile/$input->photo") ?>" alt="">
							<?php endif ?>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</main>
