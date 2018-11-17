<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Panel - @yield('title')</title>
	<link rel="stylesheet" href="/02/public/css/all.css">
	<script src="https://use.fontawesome.com/82337c0b5c.js"></script>
</head>
<body>

 @include('includes.admin-sidebar')
  <div class="off-canvas-content admin_title_bar" data-off-canvas-content>
    <!-- Your page content lives here -->
    <div class="title-bar">
  <div class="title-bar-left">
    <button class="menu-icon " type="button" data-open="offCanvas"></button>
    <span class="title-bar-title">{{getenv("APP_NAME")}}</span>
  </div>
 
</div>
    @yield('content')
  </div>
<script src="/02/public/js/all.js"></script>
</body>
</html>