<main class="container">
	<div class="row">
		<div class="col-md-3">
			<?php $this->load->view('layouts/_sidebar'); ?>
		</div>
		<div class="col-md-9">
			<?php $this->load->view('layouts/_alert'); ?>                
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<img src="<?= $user->photo ? "/images/profile/$user->photo" : '/images/profile/default.jpg' ?>" alt="" height="200">
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<p>Nama: <?= $user->name ?></p>
							<p>Email: <?= $user->email ?></p>
							<a href='<?= base_url("/profile/update/{$user->id}") ?>' class="btn btn-primary">Edit</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
