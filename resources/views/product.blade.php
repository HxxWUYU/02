@extends('layouts.app')
@section('title') {{$product->name}}@endsection
@section('data-page-id','product')

@section('content')
	<div class="product">
		<section>
			<div class="row column">
				<img src="/02/public/{{$product->image_path}}" width="200" height="200"> <br>
				{{$product->name}}
			</div>
		</section>
	</div>

	
@stop