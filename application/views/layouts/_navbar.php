<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
	<div class="container">
		<a class="navbar-brand" href="#">CIShop</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-1" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse justify-content-between" id="navbar-1">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
				</li>
				<?php if($this->session->userdata('is_login') && $this->session->userdata('role') == 'admin') : ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</a>
					<div class="dropdown-menu" aria-labelledby="dropdown-1">
						<a class="dropdown-item" href="<?= base_url('/category') ?>">Kategori</a>
						<a class="dropdown-item" href="<?= base_url('/product') ?>">Produk</a>
						<a class="dropdown-item" href="/admin-order.html">Orders</a>
					</div>
				</li>
				<?php endif ?>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="/cart.html"><i class="fas fa-shopping-cart"></i> Cart(0)</a>
				</li>
				<?php if (!$this->session->userdata('is_login')): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('/login') ?>">Masuk</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('/register') ?>">Daftar</a>
					</li>
				<?php else: ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata('name') ?></a>
						<div class="dropdown-menu" aria-labelledby="dropdown-1">
							<a class="dropdown-item" href="/profile.html">Profil</a>
							<a class="dropdown-item" href="/orders.html">Order</a>
							<a class="dropdown-item" href="<?= base_url('logout') ?>">Keluar</a>
						</div>
					</li>
				<?php endif ?>
			</ul>
		</div>
	</div>
</nav>
