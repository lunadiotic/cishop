<main class="container">
	<div class="row">
		<div class="col-md-8 mx-auto">
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-header">
							Formulir Registrasi
						</div>
						<div class="card-body">
							<?php $this->load->view('layouts/_alert'); ?>
							<?= form_open('register', ['method' => 'POST']) ?>
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
									<label for="">Konfirmasi Password</label>
									<?= form_password('password_confirmation', '', ['class' => 'form-control', 'placeholder' => 'Masukkan ulang password Anda']) ?>
									<?= form_error('password_confirmation') ?>	
								</div>
								<button type="submit" class="btn btn-primary">Daftar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
