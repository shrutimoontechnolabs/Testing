<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
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

    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- <meta name="csrf-token" content="{{csrf_token()}}"/> --}}

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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    
    <style>
              /* Modal Background */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
}

/* Modal Content */
.modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    min-width: 300px;
}

.modal-title {
    font-size: 18px;
    margin-bottom: 10px;
}

.modal-actions {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button#confirmDelete {
    background-color: #dc3545;
    color: white;
}

button#cancelDelete {
    background-color: #6c757d;
    color: white;
}

/* Custom Prompt Modal (Centered Horizontally at Top) */
.custom-prompt-modal {
    position: fixed;
    top: 10%; /* Position the modal near the top of the screen */
    left: 50%; /* Horizontally center the modal */
    transform: translateX(-50%); /* Center the modal horizontally */
    background: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Ensure it appears on top of other elements */
}

/* Custom Prompt Modal Content */
.custom-prompt-content {
    background: white;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    min-width: 250px;
    max-width: 300px;
}

/* Prompt Modal Title */
.custom-prompt-title {
    font-size: 16px;
    margin-bottom: 10px;
    font-weight: bold;
}

/* Prompt Modal Input Field */
.custom-prompt-input {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    font-size: 14px;
    box-sizing: border-box;
}

/* Prompt Modal Action Buttons */
.custom-prompt-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

/* Button Style */
button {
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

/* Confirm Button */
button#confirmPrompt {
    background-color: #007bff; /* Blue for "Confirm" */
    color: white;
}

/* Cancel Button */
button#cancelPrompt {
    background-color: #6c757d; /* Gray for "Cancel" */
    color: white;
}


    </style>
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
                                        <img src="{{asset('storage/'.Auth::user()->file_name)}}" alt="User-Profile-Image">
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

                            
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="@yield('activedashboard') pcoded-trigger ">
                                    <a href="{{route('dashboard')}} ">
                                        <span class="pcoded-micon"><i class="ti-comments"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                {{-- <li class="@yield('activeadduser')pcoded-trigger ">
                                    <a href=" {{route('user.create')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-user-alt-7"></i></span>
                                        <span class="pcoded-mtext">Add User</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li> --}}

                                <li class="@yield('activemanageuser')pcoded-trigger ">
                                    <a href="{{route('users.index')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-girl"></i></span>
                                        <span class="pcoded-mtext">
                                            Manage User</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                {{-- <li class="@yield('activeaddrole')pcoded-trigger ">
                                    <a href="{{route('role.create')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-people"></i></span>
                                        <span class="pcoded-mtext">
                                            Add Role</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li> --}}

                                
                                <li class="@yield('activemanagerole')pcoded-trigger ">
                                    <a href="{{route('roles.index')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-ui-user-group"></i></span>
                                        <span class="pcoded-mtext">
                                            Manage Role</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activecalender')pcoded-trigger ">
                                    <a href="{{route('calender')}}">
                                        <span class="pcoded-micon"><i class="ti-calendar"></i></span>
                                        <span class="pcoded-mtext">
                                            Calender</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activemanagefaq')pcoded-trigger ">
                                    <a href="{{route('faqs.index')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-support-faq"></i></span>
                                        <span class="pcoded-mtext">
                                            Manage FAQ</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activefaq')pcoded-trigger ">
                                    <a href="{{route('faqs.show')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-support-faq"></i></span>
                                        <span class="pcoded-mtext">
                                             FAQ</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activemanagecms')pcoded-trigger ">
                                    <a href="{{route('cmss.index')}}">
                                        <span class="pcoded-micon"></span>
                                        <span class="pcoded-mtext">
                                             CMS</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activemanageleave')pcoded-trigger ">
                                    <a href="{{route('leaves.adminIndex')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-exit"></i></span>
                                        <span class="pcoded-mtext">
                                             Leave</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activemanagecleave')pcoded-trigger ">
                                    <a href="{{route('contacts.index')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-contacts"></i></span>
                                        <span class="pcoded-mtext">
                                             Contact</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activemanagetask')pcoded-trigger ">
                                    <a href="{{route('tasks.index')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-tasks"></i></span>
                                        <span class="pcoded-mtext">
                                             Task</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>


                                <li class="@yield('activemanagetask')pcoded-trigger ">
                                    <a href="{{route('holidays.index')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-beach-bed"></i></span>
                                        <span class="pcoded-mtext">
                                             Holiday</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/tether/dist/js/tether.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/modernizr/modernizr.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/auth/plugins/modernizr/feature-detects/css-scrollbars.js')}}"></script>


    <!-- Morris Chart js -->
    <script src="{{ asset('assets/auth/plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{ asset('assets/auth/plugins/morris.js/morris.js')}}"></script>
    <!-- echart js -->
    <script src="{{ asset('assets/auth/pages/chart/echarts/js/echarts-all.js')}}" type="text/javascript"></script>
    <!-- Morris Chart Custom js -->
    <script type="text/javascript" src="{{ asset('assets/auth/pages/dashboard/project-dashboard.js')}}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('assets/auth/js/script.js')}}"></script>
    <script src="{{ asset('assets/auth/js/pcoded.min.js')}}"></script>
    <script src="{{ asset('assets/auth/js/demo-12.js')}}"></script>
   <script src="{{ asset('assets/auth/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

   
   
<script>
$(document).ready(function () {
   // Set up CSRF token for AJAX requests
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

   // Function to show the toast message
   function showToast(message, color) {
       var toastContainer = document.getElementById('toast');
       var toastMessage = document.getElementById('toast-message');
       
       if (!toastContainer || !toastMessage) {
           console.error('Toast elements not found');
           return;
       }

       // Set the background color dynamically and display the message
       toastMessage.style.backgroundColor = color;
       toastMessage.textContent = message;
       
       // Show the toast
       toastContainer.style.display = 'block';

       // Hide the toast after 5 seconds with fade-out effect
       setTimeout(function() {
           toastContainer.classList.add('toast-hide');
       }, 5000);

       // Completely hide the toast after the fade-out effect
       setTimeout(function() {
           toastContainer.style.display = 'none';
           toastContainer.classList.remove('toast-hide');
       }, 5500);
   }

   // Only show toast if session('success') has a value
   @if(session('success'))
       showToast("{{ session('success') }}", "#28a745");  // Green for success
   @endif

   // Initialize FullCalendar
   $('#calender').fullCalendar({
       editable: true,
       header: {
           left: 'prev,next today',
           center: 'title',
           right: 'month,agendaWeek,agendaDay'
       },
       events: "{{ url('/full_calender') }}",
       selectable: true,
       selectHelper: true,

       // When selecting a new time slot for an event
       select: function (start, end) {
                // Show the custom prompt modal
                $('#customPromptModal').fadeIn();

                // Bind the "Create Event" button to get the title from the input
                $('#confirmPrompt').off('click').on('click', function () {
                    var title = $('#eventTitle').val().trim();  // Get the input value

                    if (title) {
                        var startDate = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                        var endDate = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                        $.ajax({
                            url: "{{ url('/full_calender/action') }}",
                            type: "POST",
                            data: {
                                title: title,
                                start: startDate,
                                end: endDate,
                                type: 'add'
                            },
                            success: function (data) {
                                $('#calender').fullCalendar('refetchEvents');
                                showToast("Event created successfully!", "#28a745");  // Green for success
                            }
                        });

                        // Close the modal after creating the event
                        $('#customPromptModal').fadeOut();
                    } else {
                        alert("Please enter a title for the event.");
                    }
                });

                // Close the modal on cancel
                $('#cancelPrompt').off('click').on('click', function () {
                    $('#customPromptModal').fadeOut();
                });
            },


       // When resizing an event
       eventResize: function (event) {
           var startDate = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
           var endDate = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');

           $.ajax({
               url: "{{ url('/full_calender/action') }}",
               type: "POST",
               data: {
                   id: event.id,
                   title: event.title,
                   start: startDate,
                   end: endDate,
                   type: 'update'
               },
               success: function () {
                   $('#calender').fullCalendar('refetchEvents');
                   showToast("Event updated successfully!", "#17a2b8");  // Blue for update
               }
           });
       },

       // When dragging and dropping an event
       eventDrop: function (event) {
           var startDate = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
           var endDate = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');

           $.ajax({
               url: "{{ url('/full_calender/action') }}",
               type: "POST",
               data: {
                   id: event.id,
                   title: event.title,
                   start: startDate,
                   end: endDate,
                   type: 'update'
               },
               success: function () {
                   $('#calender').fullCalendar('refetchEvents');
                   showToast("Event updated successfully!", "#17a2b8");  // Blue for update
               }
           });
       },

       // When clicking on an event to delete
       eventClick: function (event) {
           $('#confirmationModal').fadeIn();  // Show confirmation modal

           // Bind the "Yes, Delete" button
           $('#confirmDelete').off('click').on('click', function () {
               var id = event.id;
               $.ajax({
                   url: "{{ url('/full_calender/action') }}",
                   type: "POST",
                   data: {
                       id: id,
                       type: 'delete',
                       _token: '{{ csrf_token() }}'  // CSRF token
                   },
                   success: function (data) {
                       if (data.success) {
                           $('#calender').fullCalendar('refetchEvents');
                           showToast("Event deleted successfully!", "#dc3545");  // Red for delete
                       } else {
                           showToast("Failed to delete event.", "#ffc107");  // Yellow for failure
                       }
                   },
                   error: function () {
                       alert("Error deleting event.");
                   }
               });

               // Close the modal after the action
               $('#confirmationModal').fadeOut();
           });

           // Close the modal on cancel
           $('#cancelDelete').off('click').on('click', function () {
               $('#confirmationModal').fadeOut();
           });
       }
   });
});
</script>

</body>
</html>
