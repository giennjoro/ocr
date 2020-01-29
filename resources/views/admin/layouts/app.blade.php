<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>DoubleQuick | Admin</title>

  <!-- Bootstrap -->
  <link href="{{ asset('adm/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('adm/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- NProgress -->
  <link href="{{ asset('adm/vendors/nprogress/nprogress.css" rel="stylesheet') }}">
  <!-- bootstrap-daterangepicker -->
  <link href="{{ asset('adm/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="{{ asset('adm/build/css/custom.css') }}" rel="stylesheet">

  <!-- Datatables -->
  <link href="{{ asset('adm/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('adm/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('adm/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
    rel="stylesheet">
  <link href="{{ asset('adm/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
    rel="stylesheet">
  <link href="{{ asset('adm/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

  {{-- toastr --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  @yield('assets')
  <!-- jQuery Validate -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="/" class="site_title"><i class="fa fa-soccer-ball-o"></i><span> DoubleQuick </span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
            <a href="{{ route('users.show', ['slug'=> Auth::user()->slug]) }}">
              <img src="{{ asset('avatar.png') }}" alt="..." class="img-circle profile_img">
            </a>
              
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <a href="{{ route('users.show', ['slug'=> Auth::user()->slug]) }}">
                <h2>{{ Auth::user()->name }}</h2>
              </a>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Navigation</h3>

              <ul class="nav side-menu">
                <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a><i class="fa fa-users"></i> Admins <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('admin_index') }}"><i class="fa fa-users"></i>View all Admins</a>
                    </li>
                    @if (Auth::user()->type == 'super')
                    <li><a href="{{ route('add_admin') }}"><i class="fa fa-user-plus"></i>Add Admin</a></li>
                    @endif

                  </ul>
                </li>
                <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i>View all Users</a>
                    </li>
                    <li><a href="{{ route('users.create') }}"><i class="fa fa-user-plus"></i>Add User</a></li>

                  </ul>
                </li>
                <li><a><i class="fa fa fa-soccer-ball-o "></i>Matches <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('matches.create') }}"><i class="fa fa-plus"></i>Add Match</a></li>
                    <li><a href="{{ route('matches.index') }}"><i class="fa fa-soccer-ball-o "></i>View all Matches</a>
                    <li><a href="{{ route('matches.pending') }}"><i class="fa fa-soccer-ball-o "></i>Pending Matches</a>
                    <li><a href="{{ route('matches.upcoming') }}"><i class="fa fa-soccer-ball-o "></i>Upcoming Matches</a>
                    <li><a href="{{ route('matches.recent', ['days' => 2]) }}"><i class="fa fa-soccer-ball-o "></i>Recent Matches</a>
                    <li style="display: none"><a href="{{ route('matches.recent', ['days' => 7]) }}"><i class="fa fa-soccer-ball-o "></i>Recent Matches</a>
                    <li style="display: none"><a href="{{ route('matches.recent', ['days' => 30]) }}"><i class="fa fa-soccer-ball-o "></i>Recent Matches</a>
                    <li style="display: none"><a href="{{ route('matches.recent', ['days' => 1]) }}"><i class="fa fa-soccer-ball-o "></i>Recent Matches</a>
                    <li><a href="{{ route('matches.winnings') }}"><i class="fa fa-check "></i>Winnings</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-money"></i> Plans <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('plans.index') }}"><i class="fa fa-money"></i>View all Plans</a>
                    </li>
                    <li><a href="{{ route('plans.create') }}"><i class="fa fa-plus"></i>Add Plan</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-money"></i> Subscriptions <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{ route('subscriptions.all') }}"><i class="fa fa-money"></i>View all Subscriptions</a></li>
                    <li><a href="{{ route('subscriptions.active') }}"><i class="fa fa-money"></i>Active Subscriptions</a></li>
                    <li><a href="{{ route('subscribers.active') }}"><i class="fa fa-users"></i>Active Subscribers</a></li>
                    <li style="display:none"><a href="{{ route('subscriptions.search') }}">Searching Subscribers</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-google-wallet"></i> Transactions  <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                      <li><a href="{{ route('mpesa.transactions') }}"><i class="fa fa-money"></i>Mpesa Transactions</a></li>
                      <li><a href="{{ route('mpesa.completed') }}"><i class="fa fa-money"></i>Mpesa Completed</a></li>
                      <li><a href="{{ route('mpesa.cancelled') }}"><i class="fa fa-money"></i>Mpesa Cancelled/Failed</a>
                      <li style="display:none"><a href="{{ route('mpesa.search') }}">Searching Mpesa</a>
                      </li>
                      <li><a href="{{ route('paypal.completed') }}"><i class="fa fa-paypal"></i>Paypal Completed</a>
                  </ul>
                </li> 
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('avatar.png') }}" alt="">{{ Auth::user()->name }}
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li>
                    <a href="{{ route('users.show', ['slug' => Auth::user()->slug]) }}"> Profile</a>
                  </li>
                  <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                      <i class="fa fa-sign-out pull-right"></i>
                      Log Out
                    </a>
                  </li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </ul>
              </li>



              {{-- <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown button
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div> --}}


              
             
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main" id="main_div">

        @yield('content')

      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Copyright © DoubleQuick | Best Tips <script>
            document.write(new Date().getFullYear());
          </script>. All rights reserved.
          Developed By <a target="_blank" href="https://www.24seven.co.ke">24seven
            Developers.</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('adm/vendors/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('adm/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('adm/vendors/fastclick/lib/fastclick.js') }}"></script>
  <!-- NProgress -->
  <script src="{{ asset('adm/vendors/nprogress/nprogress.js') }}"></script>
  <!-- Chart.js -->
  <script src="{{ asset('adm/vendors/Chart.js/dist/Chart.min.js') }}"></script>
  <!-- jQuery Sparklines -->
  <script src="{{ asset('adm/vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
  <!-- Flot -->
  <script src="{{ asset('adm/vendors/Flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('adm/vendors/Flot/jquery.flot.pie.js') }}"></script>
  <script src="{{ asset('adm/vendors/Flot/jquery.flot.time.js') }}"></script>
  <script src="{{ asset('adm/vendors/Flot/jquery.flot.stack.js') }}"></script>
  <script src="{{ asset('adm/vendors/Flot/jquery.flot.resize.js') }}"></script>
  <!-- Flot plugins -->
  <script src="{{ asset('adm/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
  <script src="{{ asset('adm/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/flot.curvedlines/curvedLines.js') }}"></script>
  <!-- DateJS -->
  <script src="{{ asset('adm/vendors/DateJS/build/date.js') }}"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="{{ asset('adm/vendors/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('adm/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

  <!-- Datatables -->
  <script src="{{ asset('adm/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
  <script src="{{ asset('adm/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/jszip/dist/jszip.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
  <script src="{{ asset('adm/vendors/pdfmake/build/vfs_fonts.js') }}"></script>

  <!-- Custom Theme Scripts -->
  <script src="{{ asset('adm/build/js/custom.min.js') }}"></script>

  {{-- Toastr --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  @include('layouts.messages')
  @yield('date')
  @yield('scripts')
</body>

</html>