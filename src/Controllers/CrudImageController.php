<?php

namespace Webudvikleren\CrudImages\Controllers;

use App\Http\Controllers\Controller;
use Webudvikleren\CrudImages\Models\CrudImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CrudImageController extends Controller
{
	protected string $baseroute = 'admin.crudimages.';
	protected array $breadcrumbs = [];
	
	public function create()
	{
		$this->breadcrumbs[] = [trans('crudimages::image.images'), route($this->baseroute . 'index')];
		return view('crudimages::create')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs);
	}

	public function delete($id)
    {
        $image = CrudImage::findOrFail($id);
		Storage::disk('public')->delete($image->location);
		$image->delete();

		session()->flash('success', trans('crudimages::image.deleted'));
		return redirect()->route($this->baseroute . 'index');        
    }

	public function edit($id)
	{
		$image = CrudImage::findOrFail($id);
		$this->breadcrumbs[] = [trans('crudimages::image.images'), route($this->baseroute . 'index')];
		return view('crudimages::edit')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs)
				->with('image', $image);
	}

	public function index()
	{
		$images = CrudImage::orderBy('category')->orderBy('title')->get();
		return view('crudimages::index')
				->with('baseroute', $this->baseroute)
				->with('breadcrumbs', $this->breadcrumbs)
				->with('images', $images);
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'category' => ['required', 'string'],
			'title' => ['required', 'string'],
            'image' => ['required', 'image', 'max:2048'],
		], [
			// TODO: Fix. 
		]);

		DB::transaction(function () use ($validated, $request) {
			$category = strtolower($validated['category']);
			$title = strtolower($validated['title']);

			$path = config('crudimages.folder') . '/' . $category;
			$filename = Str::uuid() . '.' . $request->image->getClientOriginalExtension();
			Storage::disk('public')->putFileAs($path, $request->image, $filename);
	
			$imagesize = getimagesize($request->image);

			CrudImage::create([
				'category' => $category,
				'title' => $title,
				'location' => $path . '/' . $filename,
				'height' => $imagesize[1],
				'width' => $imagesize[0],
				'mime' => $imagesize['mime']
			]);
		});

        session()->flash('success', trans('crudimages::image.uploaded'));
        return redirect()->route($this->baseroute . 'index');
	}

	public function update($id, Request $request)
	{
		$image = CrudImage::findOrFail($id);
		$validated = $request->validate([
			'category' => ['required', 'string'],
			'title' => ['required', 'string'],
			'image' => ['image', 'max:2048', 'nullable'],
		], [
			// TODO: Fix.
		]);

		$image->category = strtolower($validated['category']);
		$image->title = strtolower($validated['title']);

		if ($request->image !== null)
		{
			Storage::disk('public')->delete($image->location);

			$path = config('crudimages.folder') . '/' . $image->category;
			$filename = Str::uuid() . '.' . $request->image->getClientOriginalExtension();
			Storage::disk('public')->putFileAs($path, $request->image, $filename);

			$imagesize = getimagesize($request->image);

			$image->location = $path . '/' . $filename;
			$image->height = $imagesize[1];
			$image->width = $imagesize[0];
			$image->mime = $imagesize['mime'];
		}
		$image->save();

		session()->flash('success', trans('crudimages::image.uploaded'));
        return redirect()->route($this->baseroute . 'index');
	}
}
