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
								Urutkan Harga: <a href="#" class="badge badge-primary">Termurah</a> | <a href="#" class="badge badge-primary">Termahal</a>
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="card mb-3">
						<img class="card-img-top" src="https://placehold.co/100x70" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-title">Product title</h5>
							<p class="card-text"><strong>Rp100.000,-</strong></p>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="badge badge-primary"><i class="fas fa-tags"></i> Category</a>
						</div>
						<div class="card-footer text-muted">
							<!-- <a href="#" class="btn btn-sm btn-primary float-right">Order</a> -->
							<div class="input-group">
								<input type="number" class="form-control" >
								<div class="input-group-append">
									<button class="btn btn-primary" type="button" id="button-addon2">Add to Cart</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card mb-3">
						<img class="card-img-top" src="https://placehold.co/100x70" alt="Card image cap">
						<div class="card-body">
							<h5 class="card-title">Product title</h5>
							<p class="card-text"><strong>Rp100.000,-</strong></p>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="badge badge-primary"><i class="fas fa-tags"></i> Category</a>
						</div>
						<div class="card-footer text-muted">
							<!-- <a href="#" class="btn btn-sm btn-primary float-right">Order</a> -->
							<div class="input-group">
								<input type="number" class="form-control" >
								<div class="input-group-append">
									<button class="btn btn-primary" type="button" id="button-addon2">Add to Cart</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<nav aria-label="Page navigation example">
				<ul class="pagination">
					<li class="page-item"><a class="page-link" href="#">Previous</a></li>
					<li class="page-item"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">Next</a></li>
				</ul>
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
