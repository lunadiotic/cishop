<main class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-3">
				<div class="card-header">
					Cart
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
							<th scope="col">Produk</th>
							<th scope="col" >Harga</th>
							<th scope="col" class="text-center">Jumlah</th>
							<th scope="col" class="text-center">Subtotal</th>
							<th scope="col"></th>
							</tr>
						</thead>
						<tbody class="">
							<?php foreach($content as $row) : ?>
							<tr>  
								<td>
									<p><img src="<?= base_url("/images/product/$row->image") ?>" alt="" height="50"> <strong><?= $row->title ?></strong></p>
								</td>
								<td>Rp<?= number_format($row->price, 0 ,',','.') ?>,-</td>
								<td class="text-center">
									<form action="<?= base_url("/cart/update/$row->id") ?>" method="POST">
										<input type="hidden" name="id" value="<?= $row->id ?>">
										<div class="input-group">
											<input type="number" class="form-control text-center" value="<?= $row->qty ?>">
											<div class="input-group-append">
												<button class="btn btn-info" type="submit"><i class="fas fa-check"></i></button>
											</div>
										</div>
									</form>
								</td>
								<td class="text-center">Rp<?= number_format($row->subtotal, 0 ,',','.') ?>,-</td>
								<td class="text-center">
									<form action="<?= base_url("/cart/delete/$row->id") ?>" method="POST">
										<input type="hidden" name="id" value="<?= $row->id ?>">
										<button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
									</form>
								</td>
							</tr>
							<?php endforeach ?>
						
							<tr>
								<td></td>
								<td></td>
								<td class="text-center"><strong>Total: </strong></td>
								<td class="text-center"><strong>Rp<?= number_format(array_sum(array_column($content, 'subtotal')), 0 ,',','.') ?>,-</strong></td>
								<td class="text-right"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="card-footer">
					<a href="/checkout.html" class="btn btn-success float-right">Pembayaran <i class="fas fa-angle-right"></i></a>
					<a href="/index.html" class="btn btn-warning text-white"><i class="fas fa-angle-left"></i> Belanja Lagi</a>
				</div>
			</div>
		</div>
	</div>
</main>
