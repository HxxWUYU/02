<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Panel - @yield('title')</title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<body>

  <div class="off-canvas position-left reveal-for-large" id="offCanvas" data-off-canvas>

    <!-- Close button -->
    <button class="close-button" aria-label="Close menu" type="button" data-close>
      <span aria-hidden="true">&times;</span>
    </button>

    <!-- Side bar-->
    <ul class="vertical menu">
      <li><a href="#">Foundation</a></li>
      <li><a href="#">Dot</a></li>
      <li><a href="#">ZURB</a></li>
      <li><a href="#">Com</a></li>
      <li><a href="#">Slash</a></li>
      <li><a href="#">Sites</a></li>
    </ul>
    <!-- End Side bar-->

  </div>

  <div class="off-canvas-content" data-off-canvas-content>
    <!-- Your page content lives here -->
    @yield('content')
  </div>
	<script src="/js/all.js"></script>
</body>
</html>