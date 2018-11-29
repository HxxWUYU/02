
  <div class="off-canvas position-left nav reveal-for-large"  id="offCanvas"  data-off-canvas>

    <!-- Close button -->
    

    <h3>Admin Panel</h3>
    <div class="image-holder text-center">
      
      <img src='/02/public/images/Hxx.jpg' alt="Hxx" title="Admin">
      <p>{{user()->fullname}}</p>
    </div>
    <!-- Side bar-->
    <ul class="vertical menu">
      <li><a href="/02/public/admin"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>&nbsp; Dashboard</a></li>
      <li><a href="/02/public/admin/product/create"><i class="fa fa-plus fa-fw" aria-hidden="true"></i>&nbsp; Add Product</a></li>
      <li><a href="/02/public/admin/product/inventory"><i class="fa fa-edit fa-fw" aria-hidden="true"></i>&nbsp; Manage Product</a></li>
      <li><a href="/02/public/admin/product/categories"><i class="fa fa-compress" aria-hidden="true"></i>&nbsp; Categories</a></li>
      <li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; View Orders</a></li>
      <li><a href="#"><i class="fa fa-money fa-fw" aria-hidden="true"></i>&nbsp; Payments</a></li>
      <li><a href="/02/public/logout"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>&nbsp; Logout</a></li>
    </ul>
    <!-- End Side bar-->

  </div>


