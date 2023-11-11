@extends('layout.app')
@section('meta_title', trans('crudimages::image.images'))

@section('content')
<h1>{{ trans('crudimages::image.images') }}</h1>
<x-crudimages::status />

<a class="btn btn-light mb-3" href="{{ route($baseroute . 'create') }}">
	<x-iconcomponents::plus-circle color="green" size="20" />
	{{ trans('crudimages::image.upload') }}
</a>

<table class="table table-hover table-list">
	<thead>
		<td>{{ trans('crudimages::image.category') }}</td>
		<td>{{ trans('crudimages::image.title') }}</td>
		<td class="text-center" colspan="4">{{ trans('crudimages::image.actions') }}</td>
	</thead>
	@foreach ($images as $image)
		<tr>
			<td>{{ ucfirst($image->category) }}</td>
			<td>{{ ucfirst($image->title) }}</td>
			<td class="text-center">
				<a href="{{ asset('storage/' . $image->location) }}" target="_blank" title="{{ trans('crudimages::image.show') }}">
					<x-iconcomponents::search />
				</a>
			</td>
			<td class="text-center">
				<a class="" onclick="navigator.clipboard.writeText('{{ asset('storage/' . $image->location) }}')" style="cursor:pointer" title="{{ trans('crudimages::image.clipholder') }}">
					<x-iconcomponents::card-image color="black" />
				</a>
			</td>
			<td class="text-center">
				<a href="{{ route($baseroute . 'edit', ['id' => $image->id]) }}" title="{{ trans('crudimages::image.edit') }}">
					<x-iconcomponents::pencil-square />
				</a>
			</td>
			<td class="text-center">
				<a href="{{ route($baseroute . 'delete', ['id' => $image->id]) }}" onclick="return confirm('{{ trans('crudimages::image.delete.confirm') }}')">
					<x-iconcomponents::trash color="red" />
				</a>
			</td>
		</tr>
	@endforeach
</table>
@endsection