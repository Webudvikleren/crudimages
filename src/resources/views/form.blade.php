<form action="@if (isset($image)) {{ route($baseroute . 'edit', ['id' => $image->id]) }} @else {{ route($baseroute . 'create') }} @endif" enctype="multipart/form-data" method="post">
	@csrf

	@if (isset($image))
		<div class="row">
			<div class="col-sm-6 mb-3 text-center">
				<img class="img-fluid" src="{{ $image->getImageUrl() }}">
			</div>
			<div class="col-sm-6 align-self-center">
	@endif
	<div class="row">
		<x-formcomponents::input col="col-md-6" id="category" :name="trans('crudimages::image.category')" :value="old('category', isset($image) ? $image->category : '')" />
		<x-formcomponents::input col="col-md-6" id="title" :name="trans('crudimages::image.title')" :value="old('title', isset($image) ? $image->title : '')" />
		<x-formcomponents::image id="image" name="{{ trans('crudimages::image.select') }}" />

		<x-formcomponents::button>
			@if (isset($image)) 
				{{ trans('crudimages::image.update') }}
			@else 
				{{ trans('crudimages::image.upload') }}
			@endif
		</x-formcomponents::button>
	</div>
	@if (isset($image))
			</div>
		</div>
	@endif
</form>