<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?= $current_module['judul_module'] ?></h5>
	</div>

	<div class="card-body">
		<?php
		if (!empty($message)) {
			show_alert($message);
		} ?>
		<a href="<?= $config->baseURL ?>produk/add" class="btn btn-success btn-xs"><i class="fas fa-plus pr-1"></i> Tambah Data</a>
		<hr />
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Gedung</th>
						<th>Ruangan</th>
						<th>Kapasitas TT</th>
						<th>Terpakai</th>
						<th>Upate</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					helper('html');
					$no = 1;
					foreach ($result as $val) : ?>


						<?= $val['id']; ?><tr>
							<td><?= $no++; ?></td>

							<td><?= $val['namaruangan']; ?> </td>
							<form method="post" action="<?= base_url() ?>/index.php/ruangan/update" class="form-horizontal" enctype="multipart/form-data">

								<td><input class="form-control" type="text" name="kapasitas" value="<?= $val['kapasitas']; ?>" required="required" /></td>
								<td><input class="form-control" type="text" name="terpakai" value="<?= $val['terpakai']; ?>" required="required" /></td>
								<td><input class="form-control" type="text" name="terpakai" value="<?= $val['terpakai']; ?>" required="required" /></td>
								<td><input class="form-control" type="text" name="terpakai" value="<?= $val['terpakai']; ?>" required="required" /></td>
								<td><input class="form-control" type="text" name="terpakai" value="<?= $val['terpakai']; ?>" required="required" /></td>
								<td><input class="form-control" type="text" name="terpakai" value="<?= $val['terpakai']; ?>" required="required" /></td>
								<td style="font-weight: bold;"><?= $val['updated_at']; ?></td>
								<td>
									<button type="submit" name="submit" value="submit" class="btn btn-primary">Simpan</button>
									<input type="hidden" name="id" value="<?= $val['id']; ?>" />
									<input class="form-control" type="hidden" name="updated_at" value="<?= date('Y-m-d H:i:s'); ?>" required="required" disable />

								</td>
							</form>
						</tr>

					<?php endforeach ?>

				</tbody>
			</table>
		</div>
	</div>
</div>