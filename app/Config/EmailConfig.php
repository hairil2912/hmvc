<?php

namespace Config;

class EmailConfig
{

	public $provider = 'Standard';
	// public $provider = 'Google';
	// public $provider = 'AmazonSES';

	public $client = [
		'standard' => [
			'host' => 'mail.khairilanwar.web.id', 'username' => 'info@khairilanwar.web.id', 'password' => 'Password'
		], 'google' => [
			'client_id' => '', 'client_secret' => '', 'refresh_token' => ''
		], 'ses' => [
			'username' => '', 'password' => ''
		]
	];

	// Disesuaikan dengan konfigurasi username
	public $from = 'support@khairilanwar.web.id';
	public $emailSupport = 'support@khairilanwar.web.id';
}
