<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?= $current_module['judul_module'] ?></h5>
	</div>

	<div class="card-body">
		<a href="<?= current_url() ?>/add" class="btn btn-success btn-xs"><i class="fa fa-plus pr-1"></i> Tambah Data</a>
		<hr />
		<?php
		if (!$result) {
			show_message('Data tidak ditemukan', 'error', false);
		} else {
			if (!empty($msg)) {
				show_alert($msg);
			}
		?>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover data-tables">
					<thead>
						<tr>
							<td style="padding-top: 3%;background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; " rowspan="2">No</td>
							<td style="padding-top: 3%;background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; " rowspan="2">RUANGAN</td>
							<td style="padding-top: 3%;background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; " rowspan="2">SUSPECK</td>
							<td style="padding-top: 3%;background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; " rowspan="2">TERKONFIRMASI</td>
							<td style="padding-top: 3%;background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; " rowspan="2">DIRAWAT</td>
							<td style="padding-top: 3%;background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; " colspan="5">PASIEN TERKONFIRMASI PULANG</td>
						</tr>
						<tr>
							<td style="background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; ">DENGAN IZIN</td>
							<td style="background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; ">PAP</td>
							<td style="background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; ">RUJUK</td>
							<td style="background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; ">PINDAH RUANGAN</td>
							<td style="background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; ">MENINGGAL</td>
							<td style="background-color: black;color: rgba(255,255,255,.8);font-weight: bold;text-align: center; ">Aksi</td>


						</tr>
					</thead>
					<tbody>
						<?php
						helper('html');

						$i = 1;
						setlocale(LC_ALL, 'id-ID', 'id_ID');

						foreach ($result as $key => $val) {


							echo '<tr>
						<td>' . $i . '</td>
						<td>' . strftime("%A, %d %B %Y %H:%M:%S", strtotime($val['tanggal'])) . '</td>
						<td>' . $val['terkonfirmasi'] . ' Kasus</td>
						<td>' . $val['suspek'] . ' Kasus</td>
					
						
						<td>' . btn_action([
								'edit' => ['url' => current_url() . '/edit?id=' . $val['id']], 'delete' => [
									'url' => '', 'id' =>  $val['id'], 'delete-title' => 'Hapus data di Tanggal: <strong>' . strftime("%A, %d %B %Y %H:%M:%S", strtotime($val['tanggal'])) .  '</strong> ?'
								]
							]) .
								'</td>
					</tr>';
							$i++;
						}

						$settings['dom'] = 'Bfrtip';
						$settings['order'] = [0, 'asc'];
						$settings['columnDefs'][] = ['targets' => [1, 4], 'orderable' => true];
						?>
					</tbody>
				</table>
			</div>
			<span id="dataTables-setting" style="display:none"><?= json_encode($settings) ?></span>
		<?php
		} ?>
	</div>
</div>