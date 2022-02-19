<div class="aside-header">
  <a href="{{url('dashboard')}}"><img width="150" src="{{asset('assets/img/small-hurry.jpeg')}}"></a>
  <a href="" class="aside-menu-link">
    <i data-feather="menu"></i>
    <i data-feather="x"></i>
  </a>
</div>
<div class="aside-body">
  <div class="aside-loggedin">
    <div class="d-flex align-items-center justify-content-start">
      <a href="" class="avatar"><img src="{{Auth::user()->image_url == 'default-user.png'? Auth::user()->image_url: Auth::user()->image_url}}" class="rounded-circle" alt=""></a>
      <div class="aside-alert-link">
        {{-- <a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i data-feather="message-square"></i></a> --}}
        <a href="" class="{{Auth::user()->notifications->count()>=1?'new':''}}" data-toggle="tooltip" title="You have {{Auth::user()->notifications->count()>1?Auth::user()->notifications->count().' new notifications':Auth::user()->notifications->count().' new notification'}} "><i data-feather="bell"></i></a>
        <a href="{{ route('logout') }}" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
      </div>
    </div>
    <div class="aside-loggedin-user">
      <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
        <h6 class="tx-semibold mg-b-0">{{Auth::user()->first_name." ".Auth::user()->last_name}}</h6>
        <i data-feather="chevron-down"></i>
      </a>
      <p class="tx-color-03 tx-12 mg-b-0">{{Auth::user()->role->id == 3 ? Auth::user()->warehouse()->name :''}} {{Auth::user()->role->name}}</p>
    </div>
    <div class="collapse" id="loggedinMenu">
      <ul class="nav nav-aside mg-b-0">
        <li class="nav-item"><a href="{{route('dashboard.edit_user')}}" class="nav-link"><i data-feather="edit"></i> <span>Edit Profile</span></a></li>
        <li class="nav-item"><a href="{{route('dashboard.view_profile')}}" class="nav-link"><i data-feather="user"></i> <span>View Profile</span></a></li>
        {{-- <li class="nav-item"><a href="" class="nav-link"><i data-feather="settings"></i> <span>Account Settings</span></a></li>
          <li class="nav-item"><a href="" class="nav-link"><i data-feather="help-circle"></i> <span>Help Center</span></a></li> --}}

        <li class="nav-item"><a class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><i data-feather="log-out"></i><span>Sign Out</span></a>
        </li>
        <form id="logout-form" action="{{ route('logout')}}" method="POST" style="display: none;">
          @csrf
        </form>
      </ul>
    </div>
  </div><!-- aside-loggedin -->
  <ul class="nav nav-aside">
    {{-- <li class="nav-label">Dashboard</li> --}}
    <li class="nav-item"><a href="{{url('dashboard')}}" class="nav-link"><i data-feather="shopping-bag" style="color:#73ab22;"></i> <span style="color:#73ab22;">Dashboard</span></a></li>
    {{-- <li class="nav-item"><a href="{{url('dashboard/products')}}" class="nav-link"><i data-feather="globe"></i> <span>Manage Products</span></a></li> --}}

    {{--Not visible to warehouse--}}
    @if(Auth::user()->role->id != 3)
    <li class="nav-item with-sub">
      <a href="" class="nav-link"><i data-feather="setting"></i> <span>Settings</span></a>
      <ul>
        <li><a href="{{route('dashboard/discounts')}}">Manage Discounts</a></li>
        <li><a href="{{route('dashboard/attributes')}}">Manage Attributes</a></li>
      </ul>
    </li>
    @endif

    <li class="nav-item with-sub">
      <a href="" class="nav-link"><i data-feather="user"></i> <span>Manage Products</span></a>
      <ul>
        <li><a href="{{url('dashboard/create')}}">Add New Product</a></li>
        <li><a href="{{url('dashboard/products')}}">View Products</a></li>
      </ul>
    </li>

    {{--Not visible to warehouse--}}
    @if(Auth::user()->role->id != 3)
    <li class="nav-item with-sub">
      <a href="" class="nav-link"><i data-feather="life-buoy"></i> <span>Manage Stores</span></a>
      <ul>
        <li><a href="{{url('dashboard/add_store')}}">Add Store</a></li>
        <li><a href="{{url('dashboard/stores')}}">View Stores</a></li>
      </ul>
    </li>

    @endif


    {{--Not visible to warehouse--}}
    @if(Auth::user()->role->id != 3)
    <li class="nav-item with-sub">
      <a href="" class="nav-link"><i data-feather="file-text"></i> <span>Manage Users</span></a>
      <ul>
        <li><a href="{{url('dashboard/add_user')}}">Create User</a></li>
        <li><a href="{{url('dashboard/users')}}">View Users</a></li>
      </ul>
    </li>

    <li class="nav-item"><a href="{{route('dashboard.categories')}}" class="nav-link"><i data-feather="mail"></i> <span>Product Categories</span></a></li>
    @endif

    <li class="nav-item"><a href="{{route('dashboard.orders')}}" class="nav-link"><i data-feather="mail"></i> <span>Orders</span></a></li>
    <li class="nav-item"><a href="#" class="nav-link"><i data-feather="mail"></i> <span>Sales Report</span></a></li>


    {{-- <li class="nav-item"><a href="dashboard-three.html" class="nav-link"><i data-feather="pie-chart"></i> <span>Cryptocurrency</span></a></li>
      <li class="nav-item"><a href="dashboard-four.html" class="nav-link"><i data-feather="life-buoy"></i> <span>Helpdesk Management</span></a></li>
      <li class="nav-label mg-t-25">Web Apps</li>
      <li class="nav-item"><a href="app-calendar.html" class="nav-link"><i data-feather="calendar"></i> <span>Calendar</span></a></li>
      <li class="nav-item"><a href="app-chat.html" class="nav-link"><i data-feather="message-square"></i> <span>Chat</span></a></li>
      <li class="nav-item"><a href="app-contacts.html" class="nav-link"><i data-feather="users"></i> <span>Contacts</span></a></li>
      <li class="nav-item"><a href="app-file-manager.html" class="nav-link"><i data-feather="file-text"></i> <span>File Manager</span></a></li>
      <li class="nav-item"><a href="app-mail.html" class="nav-link"><i data-feather="mail"></i> <span>Mail</span></a></li>

      <li class="nav-label mg-t-25">Pages</li>
      <li class="nav-item with-sub">
        <a href="" class="nav-link"><i data-feather="user"></i> <span>User Pages</span></a>
        <ul>
          <li><a href="page-profile-view.html">View Profile</a></li>
          <li><a href="page-connections.html">Connections</a></li>
          <li><a href="page-groups.html">Groups</a></li>
          <li><a href="page-events.html">Events</a></li>
        </ul>
      </li>
      <li class="nav-item with-sub">
        <a href="" class="nav-link"><i data-feather="file"></i> <span>Other Pages</span></a>
        <ul>
          <li><a href="page-timeline.html">Timeline</a></li>
        </ul>
      </li>
      <li class="nav-label mg-t-25">User Interface</li>
      <li class="nav-item"><a href="../../components" class="nav-link"><i data-feather="layers"></i> <span>Components</span></a></li>
      <li class="nav-item"><a href="../../collections" class="nav-link"><i data-feather="box"></i> <span>Collections</span></a></li>
    </ul> --}}
</div>