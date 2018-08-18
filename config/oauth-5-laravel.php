<?php

return [

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => '\\OAuth\\Common\\Storage\\Session',

	/**
	 * Consumers
	 */
	'consumers' => [

	'Facebook' => [
	'client_id'     => '734771876860976',
	'client_secret' => '31c45a1bdf8de8873d15d72a0260f705',
	'scope'         => [],
	],

	'Google' => [
	'client_id'     => '238267222685-ddrq5l13iloqpcdsm9igd2ir86ba8js4.apps.googleusercontent.com',
	'client_secret' => 'VIdgkeiTGxdAZ747s3F4DkIT',
	'scope'         => ['userinfo_email', 'userinfo_profile'],
	],

	]

	];