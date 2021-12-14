<?php

namespace App\Controllers;

class About extends BaseController
{
	public function index()
	{
		$data = [
			'judul' => 'App CI4 | About'
		];
		return view('about/index', $data);
	}
}
