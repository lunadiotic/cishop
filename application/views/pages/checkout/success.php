<main class="container">
	<div class="row">
		<div class="col-md-12">
			<?php $this->load->view('layouts/_alert'); ?>
			<div class="card">
				<div class="card-header">
					Berhasil
				</div>
				<div class="card-body">
					<h5>Nomor Order: <?= $content->invoice ?></h5>
					<p>Terima kasih, sudah berbelanja</p>
					<p>Silakan lakukan pembayaran untuk bisa kami proses selanjutnya dengan cara:</p>
					<ol>
						<li>Lakukan pembayaran pada rekening <strong>BCA 320909182</strong> a/n <strong>PT. CIShop</strong></li>
						<li>Sertakan keterangan dengan nomor order: <strong><?= $content->invoice ?></strong></li>
						<li>Total Pembayaran: <strong>Rp<?= number_format($content->total, 0 ,',','.') ?>,-</strong></li>
					</ol>
					<p>Jika sudah, silakan kirimkan bukti transfer di halaman konfirmasi atau bisa <a href="<?= base_url("/profile/orders/detail/$content->invoice") ?>">klik di sini</a></p>
					<a href="<?= base_url('/') ?>" class="btn btn-primary"><i class="fas fa-angle-left"></i> Kembali</a>
				</div>
			</div>
		</div>
	</div>
</main>
