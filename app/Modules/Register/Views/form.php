<div class="card-body">
	<?php
	if (!empty($message)) {
		show_message($message);
	}

	helper('form');
	?>
	<form action="<?=current_url()?>" method="post" accept-charset="utf-8">
	
	<p style="text-align:center">Komitmen kami: kami akan menyimpan data Anda dengan aman dan <strong>tidak akan membagi data Anda</strong> ke siapapun</p>
	<div class="form-group">
		<label>Bagaimana kami memanggil Anda?</label>
		<div class="form-inline">
		<select name="gender" class="form-control register-input">
			<option value="L" <?=set_select('gender', 'L')?>>Bapak/Mas</option>
			<option value="P" <?=set_select('gender', 'P')?>>Ibu/Mbak</option>
		</select>
		<input type="text" name="nama" value="<?=set_value('nama')?>" class="form-control register-input" placeholder="Nama" aria-label="Nama" required>
		</div>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email"  name="email" value="<?=set_value('email', '')?>" class="form-control register-input" placeholder="Email" aria-label="Email" required>
		<p class="small">Kemana kami akan menginformasikan promo, kupon, produk baru, dan info menarik lainnya ?</p>
	</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text"  name="username" value="<?=set_value('username', '')?>" class="form-control register-input" placeholder="Username" aria-label="Username" required>
		<p class="small">Username untuk login</p>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password"  name="password" class="form-control register-input" placeholder="Password" aria-label="Password" required>
		<div class="pwstrength_viewport_progress"></div>
		<p class="small">Bantu kami untuk melindungi data Anda dengan membuat password yang kuat, indikator: medium-strong, min 8 karakter, paling sedikit mengandung huruf kecil, huruf besar, dan angka.</p>
	</div>
	<div class="form-group">
		<label>Confirm Password</label>
		<input type="password"  name="password_confirm" class="form-control register-input" placeholder="Confirm Password" aria-label="Confirm Password" required>
	</div>
	<div class="form-group" style="margin-bottom:0">
		<button type="submit" name="submit" value="submit" class="btn btn-success" style="display:block;width:100%">Register</button>
		<?=csrf_formfield()?>
	</div>
</div>