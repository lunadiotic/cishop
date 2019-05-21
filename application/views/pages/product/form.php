<main class="container">
	<div class="row">
		<div class="col-md-10 mx-auto">
			<div class="card mb-3">
				<div class="card-header">
					<span>Tambah Product</span>
				</div>
				<div class="card-body">
					<?= form_open_multipart($form_action, ['method' => 'POST']) ?>
						<?= isset($input->id) ? form_hidden('id', $input->id) : '' ?>
						<div class="form-group">
							<label for="">Judul</label>
							<?= form_input('title', $input->title, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => 'createSlug()', 'autofocus' => 'true']) ?>
							<?= form_error('title') ?>
						</div>
						<div class="form-group">
							<label for="">Deskripsi</label>
							<?= form_textarea(['name' => 'description', 'value' => $input->description, 'rows' => 4, 'class' => 'form-control']) ?>
							<?= form_error('description') ?>	
						</div>
						<div class="form-group">
							<label for="">Harga</label>
							<?= form_input(['type' => 'number', 'name' => 'price', 'value' => $input->price, 'class' => 'form-control']) ?>
							<?= form_error('price') ?>
						</div>
						<div class="form-group">
							<label for="">Gambar</label> <br>
							<?= form_upload('image') ?>
							<?php if ($this->session->flashdata('image_error')) : ?>
								<small class="form-text text-danger"><?= $this->session->flashdata('image_error') ?></small>
							<?php endif ?>
							<?php if (!empty($input->image)): ?>
								<img src="<?= site_url("/images/$input->image") ?>" alt="">
							<?php endif ?>
						</div>
						<div class="form-group">
							<label for="">Kategory</label>
							<?= form_dropdown('id_category', getDropdownList('category', ['id', 'title']), $input->id_category, ['class' => 'form-control']) ?>
							<?= form_error('id_category') ?>
						</div>
						<div class="form-group">
							<label for="">Stok Tersedia ?</label> <br>
							<?= form_radio(['name' => 'is_available', 'value' => 1, 'checked' => true]) ?> <label for="">Iya</label>
							<?= form_radio(['name' => 'is_available', 'value' => 0]) ?> <label for="">Tidak</label>
							<?= form_error('is_available') ?>
						</div>
						<div class="form-group">
							<label for="">Slug</label>
							<?= form_input('slug', $input->slug, ['class' => 'form-control', 'id' => 'slug']) ?>
							<?= form_error('slug') ?>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</main>
