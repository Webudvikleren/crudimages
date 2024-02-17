@extends('layout.app')
@section('meta_title', trans('crudimages::image.images'))

@section('content')
<h1>{{ trans('crudimages::image.images') }}</h1>
<x-crudimages::status />

<a class="btn btn-light mb-3" href="{{ route($baseroute . 'create') }}">
	<x-bootstrapicons::plus-circle color="green" size="20" />
	{{ trans('crudimages::image.upload') }}
</a>

<table class="table table-hover table-list">
	<thead>
		<td>{{ trans('crudimages::image.category') }}</td>
		<td>{{ trans('crudimages::image.title') }}</td>
		<td class="text-center" colspan="4">{{ trans('crudimages::image.actions') }}</td>
	</thead>
	@forelse ($images as $image)
		<tr>
			<td>{{ ucfirst($image->category) }}</td>
			<td>{{ ucfirst($image->title) }}</td>
			<td class="text-center">
				<a href="{{ asset('storage/' . $image->location) }}" target="_blank" title="{{ trans('crudimages::image.show') }}">
					<x-bootstrapicons::search />
				</a>
			</td>
			<td class="text-center">
				<a class="" onclick="navigator.clipboard.writeText('{{ $image->getImageUrl() }}')" style="cursor:pointer" title="{{ trans('crudimages::image.clipholder') }}">
					<x-bootstrapicons::card-image color="black" />
				</a>
			</td>
			<td class="text-center">
				<a href="{{ route($baseroute . 'edit', ['id' => $image->id]) }}" title="{{ trans('crudimages::image.edit') }}">
					<x-bootstrapicons::pencil-square />
				</a>
			</td>
			<td class="text-center">
				<a href="{{ route($baseroute . 'delete', ['id' => $image->id]) }}" onclick="return confirm('{{ trans('crudimages::image.delete.confirm') }}')">
					<x-bootstrapicons::trash color="red" />
				</a>
			</td>
		</tr>
	@empty
		<tr>
			<td class="text-center" colspan="6">{{ trans('crudimages::image.no-images') }}</td>
		</tr>
	@endforelse
</table>
@endsection