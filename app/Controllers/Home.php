<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'judul' => 'App CI4 | Home'
		];
		return view('home/index', $data);
	}
}
