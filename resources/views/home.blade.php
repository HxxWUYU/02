@extends('layouts.app')
@section('title','Homepage')
@section('data-page-id','home')

@section('content')
	<div class="home">
		<section class="hero">
			<div class="hero-slider">
				<div >
					<img src="/02/public/images/sliders/slide_1.jpg" alt='Hxx Store' >
				</div>
				<div >
					<img src="/02/public/images/sliders/slide_2.jpg" alt='Hxx Store' >
				</div>
				<div >
					<img src="/02/public/images/sliders/slide_3.jpg" alt='Hxx Store' >
				</div>
			</div>
		</section>
		<section>
			<div id="root">
				@{{message}}
				<!-- If not using blade, remove the @-->
			</div>
		</section>
	</div>
	<script type="text/javascript">
		new Vue({
			el:'#root',
			data:{
				message:'Vue JS'
			}
		});
	</script>
@stop