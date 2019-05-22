<main class="container">
	<div class="row">
		<div class="col-md-9">
			<?php $this->load->view('layouts/_alert'); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-body">
							Kategori: <strong>Semua Kategori</strong>
							<span class="float-right">
								Urutkan Harga: <a href="<?= base_url('home/sortby/asc') ?>" class="badge badge-primary">Termurah</a> | <a href="<?= base_url('home/sortby/desc') ?>" class="badge badge-primary">Termahal</a>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<?php foreach($content as $row) : ?>
				<div class="col-md-6">
					<div class="card mb-3">
						<img class="card-img-top img-fluid" src="<?= $row->image ? base_url("/images/product/$row->image") : base_url('/images/product/default.png') ?>" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-title"><?= $row->title ?></h5>
							<p class="card-text"><strong>Rp<?= number_format($row->price, 0, ',', '.') ?>,-</strong></p>
							<p class="card-text"><?= $row->description ?></p>
							<a href="#" class="badge badge-primary"><i class="fas fa-tags"></i> <?= $row->category_title ?></a>
						</div>
						<div class="card-footer text-muted">
							<div class="input-group">
								<input type="number" class="form-control" >
								<div class="input-group-append">
									<button class="btn btn-primary" type="button" id="button-addon2">Add to Cart</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach;?>
			</div>

			<nav aria-label="Page navigation example">
				<?= $pagination ?>
			</nav>

		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-header">
							Pencarian
						</div>
						<div class="card-body">
							<div class="input-group">
								<input type="text" class="form-control" >
								<div class="input-group-append">
									<button class="btn btn-primary" type="button" id="button-addon2">Cari</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card mb-3">
						<div class="card-header">
							Kategori
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item">Semua Kategori</li>
							<li class="list-group-item">Kategori 1</li>
							<li class="list-group-item">Kategori 2</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
