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
	'client_id'     => '624101920982827',
	'client_secret' => 'aad8fbcdf836603df0094b02a849386d',
	'scope'         => [],
	],

	'Google' => [
	'client_id'     => '238267222685-ddrq5l13iloqpcdsm9igd2ir86ba8js4.apps.googleusercontent.com',
	'client_secret' => 'VIdgkeiTGxdAZ747s3F4DkIT',
	'scope'         => ['userinfo_email', 'userinfo_profile'],
	],

	]

	];