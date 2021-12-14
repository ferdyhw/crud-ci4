<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Main extends BaseController
{
	public function index()
	{
		$data = [
			'judul' => 'App CI4'
		];

		return view('main/index', $data);
	}
}
