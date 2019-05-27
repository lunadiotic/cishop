<main class="container">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view('layouts/_sidebar'); ?>
		</div>
		<div class="col-md-9">                
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							Profile
						</div>
						<div class="card-body">
						<?= form_open_multipart($form_action, ['method' => 'POST']) ?>
							<?= form_hidden('id', $input->id) ?>
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
		</div>
	</div>
</main>
