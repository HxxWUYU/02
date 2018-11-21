<?php
$categories = \App\Models\Category::width('subCategories')->get()
?>
<header class="navigation">
	<div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="example-menu"></button>
  <div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="main-menu">
 	<div class="menu medium-horizontal expanded medium-text-center" data-responsive-menu="drilldown medium=dropdown" data-click-open="true" data-disable-hover="true" data-close-on-click-inside="false">
 		<div class="top-bar-title show-fow-medium">
 			<a href="/" class="logo">Hxx Store</a>
 		</div>
 <div class="top-bar-left">
    <ul class="dropdown menu vertical medium-horizontal">
      <li>Hxx Products</li>
      @if(count($categories)>0)
      	<li>
      		<a href="#">Categories</a>
      		<ul class="menu vertical sub dropdown">
      			@foreach($categories as $category)
      				<a href="#">{{$category->name}}</a>
      				@if(count($category->subCategories)>0)
      					<ul class="menu sub dropdown">
      						@foreach($category->subCategories as $subCategory)
      							<li>
      								<a href="#">{{$subCategory->name}}</a>
      							</li>
      						@endforeach
      					</ul>
      				@endif
      			@endoreach
      		</ul>
      	</li>
      @endif
      
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="dropdown menu vertical medium-horizontal">
    	<li>Username</li>
    	<li><a href="#">Sign In</a></li>
    	<li><a href="#">Register</a></li>
    	<li><a href="#">Cart</a></li>  
    </ul>
  </div>
 	</div>
</div>
</header>