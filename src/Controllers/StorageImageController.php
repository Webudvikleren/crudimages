<?php

namespace Webudvikleren\CrudImages\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class StorageImageController extends Controller
{
	public function show(string $path)
	{
		$path = 'public/' . $path;
		if (!Storage::exists($path))
		{
			abort(404);
		}

		return Storage::response($path);
	}
}