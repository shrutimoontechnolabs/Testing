{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <title>Mash Able Light</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Codedthemes">
    <meta name="keywords" content="flat ui, admin flat ui, Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Codedthemes">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/auth/images/favicon.ico')}}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Mada:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/icon/icofont/css/icofont.css')}}">
    <!-- flag icon framework css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/pages/flag-icon/flag-icon.min.css')}}">
    <!-- Menu-Search css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/pages/menu-search/css/component.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/style.css')}}">
    <!--color css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/linearicons.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/simple-line-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
   
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header" >
                <div class="navbar-wrapper">
                    <div class="navbar-logo" navbar-theme="theme4">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a href="#!">
                            Project
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <div>
                            <ul class="nav-left">
                                <li>
                                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                </li>
                                <li>
                                    <a class="main-search morphsearch-search" href="#">
                                        <!-- themify icon -->
                                        <i class="ti-search"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                                </li>
                                
                            </ul>


                            <ul class="nav-right">
                               
                                

                                <li class="header-notification">
                                    <a href="#!">
                                        <i class="ti-bell"></i>
                                        <span class="badge">5</span>
                                    </a>
                                    <ul class="show-notification">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger">New</label>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('assets/auth/images/user.png')}}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">John Doe</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('assets/auth/images/user.png')}}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Joseph William</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('assets/auth/images/user.png')}}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Sara Soudein</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="user-profile header-notification">
                                    <a href="#!">
                                        <img src="{{ asset('assets/auth/images/user.png')}}" alt="User-Profile-Image">
                                        <span>{{ Auth::user()->name }}</span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                       
                                        <li>
                                            <a href="{{ route('profile.edit') }}">
                                                <i class="ti-user"></i> Profile
                                            </a>
                                        </li>
                                    
                                        <!-- Update Password link -->
                                        <li>
                                            <a href="{{route('update-password.show')}}">
                                                <i class="ti-unlock"></i> Update Password
                                            </a>
                                        </li>

                                    
                                        <!-- Logout link -->
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="flex items-center">
                                                    <i class="ti-layout-sidebar-left"></i> Logout
                                                </button>
                                            </form>
                                        </li>
                                        
                                        
                                    </ul>
                                </li>
                            </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar" >
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">

                            <div class="pcoded-navigatio-lavel">Layout</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active pcoded-trigger ">
                                    <a href="{{route('dashboard')}} ">
                                        <span class="pcoded-micon"><i class="ti-comments"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="pcoded-trigger ">
                                    <a href=" {{route('user.create')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-user-alt-7"></i></span>
                                        <span class="pcoded-mtext">Add User</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            

                            <ul class="pcoded-item pcoded-left-item">
                                <li>
                                    <a href="form-elements-component.html">
                                        <span class="pcoded-micon"><i class="ti-layers"></i></span>
                                        <span class="pcoded-mtext">Form Components</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pcoded-item pcoded-left-item">
                                <li>
                                    <a href="bs-basic-table.html">
                                        <span class="pcoded-micon"><i class="ti-receipt"></i></span>
                                        <span class="pcoded-mtext">Basic Table</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i></span>
                                        <span class="pcoded-mtext">Pages</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">

                                        <li class="">
                                            <a href="auth-sign-in-social.html" target="_blank">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Login</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                        <li class="">
                                            <a href="auth-sign-up-social.html" target="_blank">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Registration</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="auth-reset-password.html" target="_blank">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Forgot Password</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="auth-lock-screen.html" target="_blank">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Lock Screen</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="error.html">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Error</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="user-profile.html">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">User Profile</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="search-result.html">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Simple Search</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="sample-page.html">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Sample Page</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <div class="card-block table-border-style">
                                <div class="table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>gender</th>
                                                <th>City</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                            <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->city }}</td>
                                            
                                           
                                            <td>
                                                <a href="{{ route ('users.edit',  $user->id)}}" class="btn btn-success btn-sm">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{route('users.destroy',$user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery/dist/jquery.min.js') }}"></script>

    <!-- Other libraries that depend on jQuery -->
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/tether/dist/js/tether.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    
    <!-- Additional plugins -->
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/modernizr/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/modernizr/feature-detects/css-scrollbars.js')}}"></script>
    
    <!-- Morris Chart js -->
    <script src="{{ asset('assets/auth/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{ asset('assets/auth/plugins/morris.js/morris.js')}}"></script>
    
    <!-- Echarts js -->
    <script src="{{ asset('assets/auth/pages/chart/echarts/js/echarts-all.js')}}" type="text/javascript"></script>
    
    <!-- Morris Chart Custom js -->
    <script type="text/javascript" src="{{ asset('assets/auth/pages/dashboard/project-dashboard.js')}}"></script>
    
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('assets/auth/js/script.js')}}"></script>
    <script src="{{ asset('assets/auth/js/pcoded.min.js')}}"></script>
    <script src="{{ asset('assets/auth/js/demo-12.js')}}"></script>
    <script src="{{ asset('assets/auth/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    
     
    <!-- DataTables script -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
       <!-- Warning Section Ends -->
    <!-- Required Jquery (Keep the local jQuery version) -->


   <script>
    $(document).ready(function() {
        let table = $('.datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route("users.index") }}',
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'gender', name: 'gender' },
                { data: 'city', name: 'city' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });


        //delete user
        $('.datatable').on('click', '.delete-user', function() {
            const userId = $(this).data('id');

            if (userId) {
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: `{{ url('users') }}/${userId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                table.ajax.reload(null, false);
                                alert('User deleted successfully');
                            } else {
                                alert('Error deleting user');
                            }
                        },
                        error: function() {
                            alert('Error deleting user');
                        }
                    });
                }
            }
        });

        const editableColumns = [1, 2, 3, 4, 5];
        let currentEditableRow = null;

        //edit user
        $('.datatable').on('click', '.edit-user', function() {
          const userId = $(this).data('id');
          const currentRow = $(this).closest('tr');

          if (currentEditableRow && currentEditableRow[0] !== currentRow[0]) {
              resetEditableRow(currentEditableRow);
              }

          makeEditableRow(currentRow);
          currentEditableRow = currentRow;
          //console.log(currentRow);

          currentRow.find('td:last').html(`
        <button class="btn btn-primary btn-sm btn-update" data-id="${userId}">Update</button>
        <button data-id="${userId}" class="btn btn-danger btn-sm delete-user">Delete</button>
    `);

        });

        function makeEditableRow(currentRow){
          currentRow.find('td').each(function(index){
            
            const currentCell = $(this);
            const currentText = currentCell.text().trim();

            if(editableColumns.includes(index)){
                currentCell.html(`<input type="text" class="form-control editable-input" value="${currentText}" />`);
            }
          });
        }

        function resetEditableRow(currentEditableRow) {
          currentEditableRow.find('td').each(function(index) {
            const currentCell = $(this);

            if (editableColumns.includes(index)) {
              const currentValue = currentCell.find('input').val();
              currentCell.html(`${currentValue}`);
            }
          });

          const userId = currentEditableRow.find('.btn-update').data('id');

          currentEditableRow.find('td:last').html(`
            <button class="btn btn-success btn-sm edit-user" data-id="${userId}">Edit</button>
            <button class="btn btn-danger btn-sm delete-user" data-id="${userId}">Delete</button>
          `);
            currentEditableRow = null; // Clear the current editable row
        }

        $('table').on('click', '.btn-update', function() {
          const userId = $(this).data('id');
          const currentRow = $(this).closest('tr');
          const updatedUserData = {};

          currentRow.find('td').each(function(index) {
            if (editableColumns.includes(index)) {
              const inputValue = $(this).find('input').val();

              if (index === 1) updatedUserData.name = inputValue;
              if (index === 2) updatedUserData.email = inputValue;
              if (index === 3) updatedUserData.phone = inputValue;
              if (index === 5) updatedUserData.gender = inputValue;
              if (index === 4) updatedUserData.city = inputValue;
              
            }
          });
 

          $.ajax({
            url: '{{ route('users.update') }}',
              type: 'POST',
              data: {
                _method: "POST",
                id: userId,
                name: updatedUserData.name,
                email: updatedUserData.email,
                phone: updatedUserData.phone,
                gender: updatedUserData.gender,
                city: updatedUserData.city,
                
                _token: "{{ csrf_token() }}"
              },
                    success: function(response) {
                        if (response.status === 'success') {
                            table.ajax.reload(null,
                            false); // Reload table without resetting pagination
                            table.rowReorder.enable(); // Re-enable rowReorder
                            alert('User updated successfully!');
                        } else {
                            alert(response.message || 'Failed to update user.');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error occurred while updating the user.');
                    }
                });

                // Reset the row regardless of success or failure
                resetEditableRow(currentRow);
                currentEditableRow = null;
            });
    });
    
  </script>


</body>

</html> 

 --}}

 {{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'CRUD Operations')</title>
  <link rel="icon" href="{{asset('assets/auth/images/favicon.ico')}}" type="image/x-icon">
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Mada:300,400,600,700,800" rel="stylesheet">
  <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- themify-icons line icon -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/icon/themify-icons/themify-icons.css')}}">
  <!-- ico font -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/icon/icofont/css/icofont.css')}}">
  <!-- flag icon framework css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/pages/flag-icon/flag-icon.min.css')}}">
  <!-- Menu-Search css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/pages/menu-search/css/component.css')}}">
  <!-- Style.css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/style.css')}}">
  <!--color css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/linearicons.css')}}" >
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/simple-line-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/jquery.mCustomScrollbar.css')}}">

  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
</head>
<body style="background-color: #FDF0F0;">

  <div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">@yield('title')</h1>

    <div class="row">
      <div class="col-8">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif
      </div>
    </div>
      <nav class="navbar header-navbar pcoded-header" >
                <div class="navbar-wrapper">
                    <div class="navbar-logo" navbar-theme="theme4">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a href="#!">
                            Project
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <div>
                            <ul class="nav-left">
                                <li>
                                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                                </li>
                                <li>
                                    <a class="main-search morphsearch-search" href="#">
                                        <!-- themify icon -->
                                        <i class="ti-search"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="ti-fullscreen"></i>
                                    </a>
                                </li>
                                
                            </ul>


                            <ul class="nav-right">
                               
                                

                                <li class="header-notification">
                                    <a href="#!">
                                        <i class="ti-bell"></i>
                                        <span class="badge">5</span>
                                    </a>
                                    <ul class="show-notification">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger">New</label>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('assets/auth/images/user.png')}}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">John Doe</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('assets/auth/images/user.png')}}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Joseph William</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center" src="{{ asset('assets/auth/images/user.png')}}" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="notification-user">Sara Soudein</h5>
                                                    <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                    <span class="notification-time">30 minutes ago</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="user-profile header-notification">
                                    <a href="#!">
                                        <img src="{{ asset('assets/auth/images/user.png')}}" alt="User-Profile-Image">
                                        <span>{{ Auth::user()->name }}</span>
                                        <i class="ti-angle-down"></i>
                                    </a>
                                    <ul class="show-notification profile-notification">
                                       
                                        <li>
                                            <a href="{{ route('profile.edit') }}">
                                                <i class="ti-user"></i> Profile
                                            </a>
                                        </li>
                                    
                                        <!-- Update Password link -->
                                        <li>
                                            <a href="{{route('update-password.show')}}">
                                                <i class="ti-unlock"></i> Update Password
                                            </a>
                                        </li>

                                    
                                        <!-- Logout link -->
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="flex items-center">
                                                    <i class="ti-layout-sidebar-left"></i> Logout
                                                </button>
                                            </form>
                                        </li>
                                        
                                        
                                    </ul>
                                </li>
                            </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </nav>

    <div class="card-body">
      <div class="card">
        <div class="card-header bg-dark text-white">Item List</div>
        <div class="card-body">
          <table class="table table-striped datatable">
            <thead>
              <tr>
                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>gender</th>
                                                <th>City</th>
                                                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery/dist/jquery.min.js') }}"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
  <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('assets/auth/plugins/tether/dist/js/tether.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('assets/auth/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
   <!-- Additional plugins -->
   <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
   <script type="text/javascript" src="{{ asset('assets/auth/plugins/modernizr/modernizr.js')}}"></script>
   <script type="text/javascript" src="{{ asset('assets/auth/plugins/modernizr/feature-detects/css-scrollbars.js')}}"></script>
   
   <!-- Morris Chart js -->
   <script src="{{ asset('assets/auth/plugins/raphael/raphael.min.js')}}"></script>
   <script src="{{ asset('assets/auth/plugins/morris.js/morris.js')}}"></script>
  <!-- Echarts js -->
  <script src="{{ asset('assets/auth/pages/chart/echarts/js/echarts-all.js')}}" type="text/javascript"></script>
    
  <!-- Morris Chart Custom js -->
  <script type="text/javascript" src="{{ asset('assets/auth/pages/dashboard/project-dashboard.js')}}"></script>
  
  <!-- Custom js -->
  <script type="text/javascript" src="{{ asset('assets/auth/js/script.js')}}"></script>
  <script src="{{ asset('assets/auth/js/pcoded.min.js')}}"></script>
  <script src="{{ asset('assets/auth/js/demo-12.js')}}"></script>
  <script src="{{ asset('assets/auth/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

   <script>
    $(document).ready(function() {
        let table = $('.datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route("users.index") }}',
                type: 'GET'
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'gender', name: 'gender' },
                { data: 'city', name: 'city' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });


        //delete user
        $('.datatable').on('click', '.delete-user', function() {
            const userId = $(this).data('id');

            if (userId) {
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: `{{ url('users') }}/${userId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                table.ajax.reload(null, false);
                                alert('User deleted successfully');
                            } else {
                                alert('Error deleting user');
                            }
                        },
                        error: function() {
                            alert('Error deleting user');
                        }
                    });
                }
            }
        });

        const editableColumns = [1, 2, 3, 4, 5];
        let currentEditableRow = null;

        //edit user
        $('.datatable').on('click', '.edit-user', function() {
          const userId = $(this).data('id');
          const currentRow = $(this).closest('tr');

          if (currentEditableRow && currentEditableRow[0] !== currentRow[0]) {
              resetEditableRow(currentEditableRow);
              }

          makeEditableRow(currentRow);
          currentEditableRow = currentRow;
          //console.log(currentRow);

          currentRow.find('td:last').html(`
        <button class="btn btn-primary btn-sm btn-update" data-id="${userId}">Update</button>
        <button data-id="${userId}" class="btn btn-danger btn-sm delete-user">Delete</button>
    `);

        });

        function makeEditableRow(currentRow){
          currentRow.find('td').each(function(index){
            
            const currentCell = $(this);
            const currentText = currentCell.text().trim();

            if(editableColumns.includes(index)){
                currentCell.html(`<input type="text" class="form-control editable-input" value="${currentText}" />`);
            }
          });
        }

        function resetEditableRow(currentEditableRow) {
          currentEditableRow.find('td').each(function(index) {
            const currentCell = $(this);

            if (editableColumns.includes(index)) {
              const currentValue = currentCell.find('input').val();
              currentCell.html(`${currentValue}`);
            }
          });

          const userId = currentEditableRow.find('.btn-update').data('id');

          currentEditableRow.find('td:last').html(`
            <button class="btn btn-success btn-sm edit-user" data-id="${userId}">Edit</button>
            <button class="btn btn-danger btn-sm delete-user" data-id="${userId}">Delete</button>
          `);
            currentEditableRow = null; // Clear the current editable row
        }

        $('table').on('click', '.btn-update', function() {
          const userId = $(this).data('id');
          const currentRow = $(this).closest('tr');
          const updatedUserData = {};

          currentRow.find('td').each(function(index) {
            if (editableColumns.includes(index)) {
              const inputValue = $(this).find('input').val();

              if (index === 1) updatedUserData.name = inputValue;
              if (index === 2) updatedUserData.email = inputValue;
              if (index === 3) updatedUserData.phone = inputValue;
              if (index === 4) updatedUserData.gender = inputValue;
              if (index === 5) updatedUserData.city = inputValue;
              
            }
          });
 

          $.ajax({
            url: '{{ route('users.update') }}',
              type: 'POST',
              data: {
                _method: "POST",
                id: userId,
                name: updatedUserData.name,
                email: updatedUserData.email,
                phone: updatedUserData.phone,
                gender: updatedUserData.gender,
                city: updatedUserData.city,
                
                _token: "{{ csrf_token() }}"
              },
                    success: function(response) {
                        if (response.status === 'success') {
                            table.ajax.reload(null,
                            false); // Reload table without resetting pagination
                            table.rowReorder.enable(); // Re-enable rowReorder
                            alert('User updated successfully!');
                        } else {
                            alert(response.message || 'Failed to update user.');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error occurred while updating the user.');
                    }
                });

                // Reset the row regardless of success or failure
                resetEditableRow(currentRow);
                currentEditableRow = null;
            });
    });
    
  </script>

</body>
</html>
 --}}

 @extends('layouts.manageadminlayout')
 
 @section('title')
 Manage User
 @endsection

 @section('activemanageuser')
 active
 @endsection

 @section('content')
<!-- Confirmation Modal -->
<div id="confirmationModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); z-index: 9999;">
    <div class="modal-content">
        <h5 class="modal-title" style="color: #333;">Confirm Deletion</h5>
        <p style="color: #666;">Are you sure you want to delete this user?</p>
        <div class="modal-actions" style="margin-top: 20px; text-align: center;">
            <button id="confirmDelete" class="btn btn-danger" style="padding: 10px 20px; border-radius: 5px; background-color: #dc3545; color: white; border: none;">Yes, Delete</button>
            <button id="cancelDelete" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 5px; background-color: #6c757d; color: white; border: none;">Cancel</button>
        </div>
    </div>
</div>

<div class="pcoded-inner-content">
    <!-- Main body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Manage User</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Manage User</a></li>
                    </ul>
                </div>
            </div>
            <!-- Page-header end -->
            <div id="toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
                <div id="toast-message" class="toast-message" style="background-color: #28a745; color: white; padding: 10px 20px; border-radius: 5px; min-width: 400px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);">
                    <!-- Message will be inserted here -->
                </div>
                </div>
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <!-- Card Header -->
                                <div class="col-12">
                                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Manage User</h5>
                                        <!-- Add User Button -->
                                        <a href="{{ route('user.create') }}" class="btn btn-primary d-flex align-items-center text-white text-decoration-none">
                                            <span class="pcoded-micon me-2"><i class="icofont icofont-user-alt-7"></i></span>
                                            <span class="pcoded-mtext">Add User</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Role Filter Dropdown -->
                            <div class="form-group mt-3 mb-4 d-flex align-items-center col-lg-4">
                                <label for="roleFilter" class="form-label mb-0 me-3 mr-2">Role:</label>
                                <select id="roleFilter" class="form-control custom-select w-auto">
                                    <option value="">All Roles</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->role }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body m-2">
                                <div class="table-responsive">
                                    <table class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>City</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
    <!-- Main body end -->
</div>



 @endsection

 @section('script')
 <script>
    $(document).ready(function() {
        let table = $('.datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: '{{ route("users.index") }}',
                type: 'GET',
                data: function(d) {
                    d.role = $('#roleFilter').val(); // Add the selected role filter to the request
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'gender', name: 'gender' },
                { data: 'city', name: 'city' },
                { data: 'role', name: 'role' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Re-trigger the DataTable AJAX call when the filter changes
        $('#roleFilter').on('change', function() {
            table.ajax.reload(); // Reload the table with the new filter
        });



        //delete user
        function showToast(message, color) {
        var toastContainer = document.getElementById('toast');
        var toastMessage = document.getElementById('toast-message');
        
        toastMessage.style.backgroundColor = color;
        toastMessage.textContent = message;
        
        toastContainer.style.display = 'block';
        
        setTimeout(function() {
            toastContainer.classList.add('toast-hide');
        }, 5000);
        
        setTimeout(function() {
            toastContainer.style.display = 'none';
            toastContainer.classList.remove('toast-hide');
        }, 5500);
    }

        $('.datatable').on('click', '.delete-user', function() {
        const userId = $(this).data('id');

        if (userId) {
            // Show the custom confirmation modal
            $('#confirmationModal').fadeIn();

            // Handle the confirmation of deletion
            $('#confirmDelete').on('click', function() {
                $.ajax({
                    url: `{{ url('users') }}/${userId}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            $('.datatable').DataTable().ajax.reload(null, false);
                            showToast("User deleted successfully!", "#28a745");
                        } else {
                            showToast("Error deleting user.", "#dc3545");
                        }
                        $('#confirmationModal').fadeOut(); // Hide modal after action
                    },
                    error: function() {
                        showToast("Error deleting user.", "#dc3545");
                        $('#confirmationModal').fadeOut(); // Hide modal if error
                    }
                });
            });

        // Handle cancellation of deletion
        $('#cancelDelete').on('click', function() {
            $('#confirmationModal').fadeOut(); // Hide modal if cancelled
        });
    }
});

        const editableColumns = [1, 2, 3, 4, 5];
        let currentEditableRow = null;

    //     //edit user
    //     $('.datatable').on('click', '.edit-user', function() {
    //       const userId = $(this).data('id');
    //       const currentRow = $(this).closest('tr');

    //       if (currentEditableRow && currentEditableRow[0] !== currentRow[0]) {
    //           resetEditableRow(currentEditableRow);
    //           }

    //       makeEditableRow(currentRow);
    //       currentEditableRow = currentRow;
    //       //console.log(currentRow);

    //       currentRow.find('td:last').html(`
    //     <button class="btn btn-primary btn-sm btn-update" data-id="${userId}">Update</button>
    //     <button data-id="${userId}" class="btn btn-danger btn-sm delete-user">Delete</button>
    // `);

    //     });

    $('.datatable').on('click', '.edit-user', function() {
    const userId = $(this).data('id');
    
    // Redirect to the edit page with the user's ID
    if (userId) {
        window.location.href = `{{ url('users') }}/${userId}/edit`;
    }
});


        function makeEditableRow(currentRow){
          currentRow.find('td').each(function(index){
            
            const currentCell = $(this);
            const currentText = currentCell.text().trim();

            if(editableColumns.includes(index)){
                currentCell.html(`<input type="text" class="form-control editable-input" value="${currentText}" />`);
            }
          });
        }

        function resetEditableRow(currentEditableRow) {
          currentEditableRow.find('td').each(function(index) {
            const currentCell = $(this);

            if (editableColumns.includes(index)) {
              const currentValue = currentCell.find('input').val();
              currentCell.html(`${currentValue}`);
            }
          });

          const userId = currentEditableRow.find('.btn-update').data('id');

          currentEditableRow.find('td:last').html(`
            <button class="btn btn-success btn-sm edit-user" data-id="${userId}">Edit</button>
            <button class="btn btn-danger btn-sm delete-user" data-id="${userId}">Delete</button>
          `);
            currentEditableRow = null; // Clear the current editable row
        }

        $('table').on('click', '.btn-update', function() {
          const userId = $(this).data('id');
          const currentRow = $(this).closest('tr');
          const updatedUserData = {};

          currentRow.find('td').each(function(index) {
            if (editableColumns.includes(index)) {
              const inputValue = $(this).find('input').val();

              if (index === 1) updatedUserData.name = inputValue;
              if (index === 2) updatedUserData.email = inputValue;
              if (index === 3) updatedUserData.phone = inputValue;
              if (index === 4) updatedUserData.gender = inputValue;
              if (index === 5) updatedUserData.city = inputValue;
              if (index === 6) updatedUserData.role = inputValue;
              
            }
          });
 

          $.ajax({
            url: '{{ route('users.update') }}',
              type: 'POST',
              data: {
                _method: "POST",
                id: userId,
                name: updatedUserData.name,
                email: updatedUserData.email,
                phone: updatedUserData.phone,
                gender: updatedUserData.gender,
                city: updatedUserData.city,
                role: updatedUserData.role,
                
                _token: "{{ csrf_token() }}"
              },
                    success: function(response) {
                        if (response.status === 'success') {
                            table.ajax.reload(null,
                            false); // Reload table without resetting pagination
                            table.rowReorder.enable(); // Re-enable rowReorder
                            alert('User updated successfully!');
                        } else {
                            alert(response.message || 'Failed to update user.');
                        }
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error occurred while updating the user.');
                    }
                });

                // Reset the row regardless of success or failure
                resetEditableRow(currentRow);
                currentEditableRow = null;
            });
    });
    
  </script>
 @endsection