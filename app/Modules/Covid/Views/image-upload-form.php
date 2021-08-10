<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?= $title ?></h5>
	</div>

	<div class="card-body">
		<?php
		helper('html');

		if (!empty($msg)) {
			show_message($msg['content'], $msg['status']);
		}

		echo btn_label([
			'attr' => ['class' => 'btn btn-success btn-xs'],
			'url' => $config->baseURL . 'covid/add',
			'icon' => 'fa fa-plus',
			'label' => 'Tambah Data'
		]);

		echo btn_label([
			'attr' => ['class' => 'btn btn-light btn-xs'],
			'url' => $config->baseURL . 'covid',
			'icon' => 'fa fa-arrow-circle-left',
			'label' => 'Lihat Data'
		]);
		?>
		<hr />
		<form method="post" action="" id="form-setting">
			<div class="tab-content" id="form-container">
				<?php

				if (empty($_POST['tanggal'])) {
					$_POST['ruangan'][0] = '';
					$_POST['terkonfirmasi'][0] = '';
					$_POST['suspek'][0] = '';
				}

				foreach ($_POST['ruangan'] as $key => $val) {
					$options = options(['name' => 'ruangan[]'], ['1' => 'ISO A', '2' => 'ISO B', '3' => 'ISO C'], set_value('ruangan[' . $key . ']', @$ruangan));
					$btn_icon = $key == 0 ? 'fa-plus' : 'fa-times';
					$btn_add = $key == 0 ? 'id="add-row"' : '';
					$btn_remove = $key == 0 ? '' : 'delete-row';
					$btn_color = $key == 0 ? 'btn-success' : 'btn-danger';
				?>
					<div class="form-group row">
						<div class="col-sm-12 form-inline clearfix">
							<?= $options ?>
							<input class="form-control" type="date" name="tanggal[]" value="<?= date('Y-m-d'); ?>" placeholder="<?= date('Y-m-d'); ?>" required="required" />
							<input class="form-control" type="text" placeholder="SUSPEK" name="suspek[]" value="<?= set_value('suspek[' . $key . ']', '') ?>" placeholder="" />
							<input class="form-control" type="text" name="terkonfirmasi[]" value="<?= set_value('terkonfirmasi[' . $key . ']', '') ?>" placeholder="TERKONFIRMASI" required="required" />
							<input class="form-control" type="text" size="8" placeholder="dirawat" name="dirawat[]" value="<?= set_value('dirawat[' . $key . ']', '') ?>" placeholder="" />

							<input class="form-control" type="text" size="8" placeholder="p izin" name="izin[]" value="<?= set_value('izin[' . $key . ']', '0') ?>" placeholder="" />
							<input class="form-control" type="text" size="8" placeholder="pap" name="pap[]" value="<?= set_value('pap[' . $key . ']', '0') ?>" placeholder="" />
							<input class="form-control" type="text" size="8" placeholder="p rujuk" name="rujuk[]" value="<?= set_value('rujuk[' . $key . ']', '0') ?>" placeholder="" />
							<input class="form-control" type="text" size="8" placeholder="p pindah ruang" name="p_pr[]" value="<?= set_value('p_pr[' . $key . ']', '0') ?>" placeholder="" />
							<input class="form-control" type="text" size="8" placeholder="p gone" name="p_m[]" value="<?= set_value('p_m[' . $key . ']', '0') ?>" placeholder="" />


							<?php
							$router = service('router');
							if ($router->methodName() == 'add') {
								echo '<a href="javascript:void(0)" ' . $btn_add . ' class="btn ' . $btn_color . ' ' . $btn_remove . '"><i class="fas ' . $btn_icon . '"></i></a>';
							}
							?>
						</div>

					</div>
				<?php
				} ?>
				<div class="form-group row" style="margin-top:-7px">
					<div class="col-sm-5 form-inline clearfix">
						<div class="text-muted">TANGGAL INPUTAN | RUANGAN | TERKONFIRMASI | SUSPEK</div>
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-sm-5">
						<button type="submit" name="submit" id="btn-submit" value="submit" class="btn btn-primary">KIRIM DATA</button>
						<input type="hidden" name="id" value="<?= @$_GET['id'] ?>" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>