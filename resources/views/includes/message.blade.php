<div class="row expanded">
	@if(count($errors))
		<div class="callout alert data-closable">
			@foreach($errors as $error_array)
				@foreach($error_array as @error_item)
					{{$error_item}} <br>
				@endforeach
			@endforeach

			<button class="close-button" arial-label="Dismiss Message" type="button" data-close>
				<span arial-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	@if(isset($message))
		<div class="callout alert data-closable">
			{{$message}}

			<button class="close-button" arial-label="Dismiss Message" type="button" data-close>
				<span arial-hidden="true">&times;</span>
			</button>
		</div>
	@endif
</div>