<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
           <?php
                 $url = URL('/');                
                 $auth_id = auth()->guard('superadmin')->id();
                 if($auth_id)
                 {
                    $current_user = DB::table('superadmin')->where('id', $auth_id)->first();
                    $image_path = 'superadmin_photos';
                    $dashboard_url = "superadmin/home";
                    $user_type = 'superadmin';

                 }
                 else
                 {
                    $auth_id = auth()->guard('user')->id();
                    $current_user = DB::table('users')->where('id', $auth_id)->first();
                    $image_path = 'user_photos';
                    $dashboard_url = "user/home";
                    $user_type = 'user';
                 }
            ?>

        @if($current_user->photo)
        <img src="{{ URL::to('public/images')}}/{{$image_path}}/{{$current_user->photo}}" class="img-circle" width="20" height="24">            
         @else
        <img src="{{ URL::to('public/images/default-user.png')}}" class="img-circle" width="20" height="20">     
        @endif
       
       </div>
      <div class="pull-left info">
        <p>{{ $current_user->name }}</p>


        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu scrollbar-dynamic">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview">
        <a href="{{$url}}/{{$dashboard_url}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="treeview">
        <a href="{{URL::route('product-list')}}">
          <i class="fa fa-dashboard"></i> <span>Products</span>
        </a>
      </li>

      <li class="treeview">
        <a href="{{URL::route('supplier-list')}}">
          <i class="fa fa-dashboard"></i> <span>Suppliers</span>
        </a>
      </li>



     {{-- <li class="treeview">
        <a href="{{URL::route('customer-list')}}">
          <i class="fa fa-dashboard"></i> <span>Customers</span>
        </a>
      </li>--}}

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Purchase</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('add-purchase')}}"><i class="fa fa-circle-o"></i>Make Purchase</a></li>
           <li class="treeview-item"><a href="{{route('payment-list')}}"><i class="fa fa-circle-o"></i>Make Payment</a></li>
        </ul>
      </li> 

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Sales</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('make-sales')}}"><i class="fa fa-circle-o"></i>Make Sales</a></li>
          <li class="treeview-item"><a href="{{route('sales-list')}}"><i class="fa fa-circle-o"></i>Sales List</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Reports</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('sales-report')}}"><i class="fa fa-circle-o"></i>Sales Report</a></li>
          <li class="treeview-item"><a href="{{route('purchase-report')}}"><i class="fa fa-circle-o"></i>Purchase Report</a></li>
          <li class="treeview-item"><a href="{{route('dues-report')}}"><i class="fa fa-circle-o"></i>Dues Report</a></li>
        </ul>
      </li>
  
      <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Users</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-user')}}"><i class="fa fa-circle-o"></i>List Users</a></li>
           <li class="treeview-item"><a href="{{route('user-register')}}"><i class="fa fa-circle-o"></i>Create users</a></li>
        </ul>
      </li> 

      <li class="treeview">
        <a href="{{URL::route('list-stock')}}">
          <i class="fa fa-dashboard"></i> <span>Stock</span>
        </a>
      </li>

       <li class="treeview">
        <a href="{{URL::route('update-general-settings')}}">
          <i class="fa fa-dashboard"></i> <span>General Settings</span>
        </a>
      </li>
      
      @if($user_type == "superadmin")
        <li class="treeview">
        <a href="#">
          <i class="fa fa-globe"></i>
          <span>Permissions</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview-item"><a href="{{route('list-modules')}}"><i class="fa fa-circle-o"></i>Modules/ Permission  Roles</a></li>

        </ul>
      </li>
      @endif
      

    </ul>

  </section>
  <!-- /.sidebar -->
</aside>