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
    @yield('link')
    <style>
         /* In Out*/

         .clock-in {
            border: 2px;
            border-radius: 20px;
            background-color: green;
            color: white;
        }

        .clock-out {
            border: 2px;
            border-radius: 20px;
            background-color: red;
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
                               
                                <li class="user-profile header-notification">
                                    <button id="clockButton" data-user-id="{{ auth()->user()->id }}" class="btn clock-in" data-clocked="false">Clock In</button>
                                </li>
                                

                                <li class="header-notification">
                                    <a href="#!">
                                        <i class="ti-bell"></i>
                                        {{-- <span class="badge">{{ count($notifications) }}</span> <!-- Show the count of notifications --> --}}
                                    </a>
                                    <ul class="show-notification">
                                        <li>
                                            <h6>Notifications</h6>
                                            <label class="label label-danger">New</label>
                                        </li>
                                
                                        <!-- Loop through notifications -->
                                        @foreach ($notifications as $notification)
                                            <li>
                                                <div class="media">
                                                    <img class="d-flex align-self-center" src="{{ asset('assets/auth/images/user.png') }}" alt="User Image">
                                                    <div class="media-body">
                                                        <h5 class="notification-user">{{ $notification->fromUser->name }}</h5> <!-- Assuming 'fromUser' is a relationship -->
                                                        <p class="notification-msg">{{ $notification->message }}</p>
                                                        <span class="notification-time">{{ $notification->created_at->diffForHumans() }}</span> <!-- Time ago -->
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
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
                                    <a href="{{route('user.userdashboard')}} ">
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

                                <li class="@yield('activeleave') pcoded-trigger ">
                                    <a href="{{route('leaves.index')}} ">
                                        <span class="pcoded-micon"><i class="icofont icofont-ui-home"></i></span>
                                        <span class="pcoded-mtext">Leave</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activeInout') pcoded-trigger ">
                                    <a href="{{route('inout.create')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-ui-home"></i></span>
                                        <span class="pcoded-mtext">
                                             InOut</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                                <li class="@yield('activeusertasks') pcoded-trigger">
                                    <a href="{{ route('user.usertasks') }}">
                                        <span class="pcoded-micon"><i class="icofont icofont-tasks"></i></span>
                                        <span class="pcoded-mtext">Task</span>
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

{{-- clock in clock out --}}
{{-- <script>
    document.getElementById('clockButton').addEventListener('click', function () {
      let isClockedIn = this.getAttribute('data-clocked') === 'true';
  
      // Function to format time to 12-hour format with AM/PM
      function formatTo12Hour(time) {
        const [hour, minute, second] = time.split(':').map(Number);
        const period = hour >= 12 ? 'PM' : 'AM';
        const adjustedHour = hour % 12 || 12; // Convert to 12-hour format
        return `${String(adjustedHour).padStart(2, '0')}:${String(minute).padStart(2, '0')}:${String(second).padStart(2, '0')} ${period}`;
      }
  
      // Get the current date and time
      let currentDate = new Date();
      let currentDay = currentDate.toLocaleString('en-US', { weekday: 'long' }); // Get the current day (e.g., Monday)
      let currentTime = currentDate.toLocaleTimeString('en-US', { hour12: true }); // Get time in 24-hour format HH:MM:SS
      let currentISODate = currentDate.toISOString().split('T')[0]; // Format the current date to YYYY-MM-DD
  
      // Convert current time to 12-hour format with AM/PM
      currentTime = formatTo12Hour(currentTime);
  
      // Define the endpoint for the fetch request
      let url = isClockedIn ? '/clock-out' : '/clock-in'; // Choose the appropriate URL based on clock-in/out status
  
      // Prepare form data
      let formData = new FormData();
      formData.append('date', currentISODate); // Store only the date part
      formData.append('day', currentDay);
      formData.append(isClockedIn ? 'out_time' : 'in_time', currentTime); // Append either in_time or out_time
  
      // Send data to the server
      fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(data => {
        console.log(data); // Log response for debugging
        
        // Check the message from the server
        if (data.message === 'You are already clocked in.' || data.message === 'You are not clocked in.') {
            alert(data.message);  // Show a message if the user tries to clock in/out at the wrong time
            return;
        }

        // Update the button state based on clocking in/out
        if (isClockedIn) {
            this.textContent = 'Clock In';
            this.classList.remove('clock-out');
            this.classList.add('clock-in');
            this.setAttribute('data-clocked', 'false'); // Update the state to clocked out
        } else {
            this.textContent = 'Clock Out';
            this.classList.remove('clock-in');
            this.classList.add('clock-out');
            this.setAttribute('data-clocked', 'true'); // Update the state to clocked in
        }
        })

        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred. Please try again.'); // Alert in case of error
        });
    });
</script> --}}
    
<script>
// document.addEventListener('DOMContentLoaded', function () {
//     const clockButton = document.getElementById('clockButton');

//     // Check the saved state in localStorage
//     const isClockedIn = localStorage.getItem('isClockedIn') === 'true';

//     // Set the initial button text and state
//     if (isClockedIn) {
//         clockButton.textContent = 'Clock Out';
//         clockButton.classList.add('clock-out');
//         clockButton.classList.remove('clock-in');
//         clockButton.setAttribute('data-clocked', 'true');
//     } else {
//         clockButton.textContent = 'Clock In';
//         clockButton.classList.add('clock-in');
//         clockButton.classList.remove('clock-out');
//         clockButton.setAttribute('data-clocked', 'false');
//     }

//     clockButton.addEventListener('click', function () {
//         let isCurrentlyClockedIn = clockButton.getAttribute('data-clocked') === 'true';

//         // Function to format time to 12-hour format with AM/PM
//         function formatTo12Hour(time) {
//             const [hour, minute, second] = time.split(':').map(Number);
//             const period = hour >= 12 ? 'PM' : 'AM';
//             const adjustedHour = hour % 12 || 12; // Convert to 12-hour format
//             return `${String(adjustedHour).padStart(2, '0')}:${String(minute).padStart(2, '0')}:${String(second).padStart(2, '0')} ${period}`;
//         }

//         // Get the current date and time
//         let currentDate = new Date();
//         let currentDay = currentDate.toLocaleString('en-US', { weekday: 'long' });
//         let currentTime = currentDate.toLocaleTimeString('en-US', { hour12: false });
//         let currentISODate = currentDate.toISOString().split('T')[0]; // Format the current date to YYYY-MM-DD

//         // Convert current time to 12-hour format with AM/PM
//         currentTime = formatTo12Hour(currentTime);

//         // Define the endpoint for the fetch request
//         let url = isCurrentlyClockedIn ? '/clock-out' : '/clock-in';

//         // Prepare form data
//         let formData = new FormData();
//         formData.append('date', currentISODate);
//         formData.append('day', currentDay);
//         formData.append(isCurrentlyClockedIn ? 'out_time' : 'in_time', currentTime);

//         // Send data to the server
//         fetch(url, {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log(data); // Log response for debugging

//             if (data.message === 'You have already clocked in and out today.' || 
//                 data.message === 'You have already clocked in today.' ||
//                 data.message === 'You have not clocked in today or already clocked out.') {
//                 alert(data.message);
//                 return;
//             }

//             // Update the button state and persist it in localStorage
//             if (isCurrentlyClockedIn) {
//                 clockButton.textContent = 'Clock In';
//                 clockButton.classList.remove('clock-out');
//                 clockButton.classList.add('clock-in');
//                 clockButton.setAttribute('data-clocked', 'false');
//                 localStorage.setItem('isClockedIn', 'false'); // Update the state
//             } else {
//                 clockButton.textContent = 'Clock Out';
//                 clockButton.classList.remove('clock-in');
//                 clockButton.classList.add('clock-out');
//                 clockButton.setAttribute('data-clocked', 'true');
//                 localStorage.setItem('isClockedIn', 'true'); // Update the state
//             }

//             // Optional: Refresh the page to reflect updated data
//             window.location.reload();
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             alert('An error occurred. Please try again.');
//         });
//     });
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const clockButton = document.getElementById('clockButton');
//     const userId = clockButton.getAttribute('data-user-id'); // Ensure each button has a unique user ID
//     const isClockedIn = localStorage.getItem('clockedIn_' + userId) === 'true'; // Use unique key for each user

//     // Set the initial button text and state based on clock-in status
//     if (isClockedIn) {
//         clockButton.textContent = 'Clock Out';
//         clockButton.classList.add('clock-out');
//         clockButton.classList.remove('clock-in');
//         clockButton.setAttribute('data-clocked', 'true');
//     } else {
//         clockButton.textContent = 'Clock In';
//         clockButton.classList.add('clock-in');
//         clockButton.classList.remove('clock-out');
//         clockButton.setAttribute('data-clocked', 'false');
//     }

//     clockButton.addEventListener('click', function () {
//         let isCurrentlyClockedIn = clockButton.getAttribute('data-clocked') === 'true';

//         // Function to format time to 12-hour format with AM/PM
//         function formatTo12Hour(time) {
//             const [hour, minute, second] = time.split(':').map(Number);
//             const period = hour >= 12 ? 'PM' : 'AM';
//             const adjustedHour = hour % 12 || 12; // Convert to 12-hour format
//             return `${String(adjustedHour).padStart(2, '0')}:${String(minute).padStart(2, '0')}:${String(second).padStart(2, '0')} ${period}`;
//         }

//         // Get the current date and time
//         let currentDate = new Date();
//         let currentDay = currentDate.toLocaleString('en-US', { weekday: 'long' });
//         let currentTime = currentDate.toLocaleTimeString('en-US', { hour12: false });
//         let currentISODate = currentDate.toISOString().split('T')[0]; // Format the current date to YYYY-MM-DD

//         // Convert current time to 12-hour format with AM/PM
//         currentTime = formatTo12Hour(currentTime);

//         // Define the endpoint for the fetch request
//         let url = isCurrentlyClockedIn ? '/clock-out' : '/clock-in';

//         // Prepare form data
//         let formData = new FormData();
//         formData.append('date', currentISODate);
//         formData.append('day', currentDay);
//         formData.append(isCurrentlyClockedIn ? 'out_time' : 'in_time', currentTime);

//         // Send data to the server
//         fetch(url, {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.message === 'You have already clocked in and out today.' || 
//                 data.message === 'You have already clocked in today.' ||
//                 data.message === 'You have not clocked in today or already clocked out.') {
//                 alert(data.message);
//                 return;
//             }

//             // Update the button state and persist it in localStorage
//             if (isCurrentlyClockedIn) {
//                 // Clock Out - Update UI and localStorage
//                 clockButton.textContent = 'Clock In';
//                 clockButton.classList.remove('clock-out');
//                 clockButton.classList.add('clock-in');
//                 clockButton.setAttribute('data-clocked', 'false');
//                 localStorage.setItem('clockedIn_' + userId, 'false'); // Update the state for this user
//             } else {
//                 // Clock In - Update UI and localStorage
//                 clockButton.textContent = 'Clock Out';
//                 clockButton.classList.remove('clock-in');
//                 clockButton.classList.add('clock-out');
//                 clockButton.setAttribute('data-clocked', 'true');
//                 localStorage.setItem('clockedIn_' + userId, 'true'); // Update the state for this user
//             }

//             // Optional: Refresh the page to reflect updated data
//             window.location.reload();
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             alert('An error occurred. Please try again.');
//         });
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    const clockButton = document.getElementById('clockButton');
    const userId = clockButton.getAttribute('data-user-id'); // Ensure each button has a unique user ID
    const isClockedIn = localStorage.getItem('clockedIn_' + userId) === 'true'; // Use unique key for each user

    // Set the initial button text and state based on clock-in status
    if (isClockedIn) {
        clockButton.textContent = 'Clock Out';
        clockButton.classList.add('clock-out');
        clockButton.classList.remove('clock-in');
        clockButton.setAttribute('data-clocked', 'true');
    } else {
        clockButton.textContent = 'Clock In';
        clockButton.classList.add('clock-in');
        clockButton.classList.remove('clock-out');
        clockButton.setAttribute('data-clocked', 'false');
    }

    clockButton.addEventListener('click', function () {
        let isCurrentlyClockedIn = clockButton.getAttribute('data-clocked') === 'true';

        // Get the current date and time
        let currentDate = new Date();

       // Format the date to d/m/Y (day/month/year)
                    let currentISODate = currentDate.getDate().toString().padStart(2, '0') + '/' +
                     (currentDate.getMonth() + 1).toString().padStart(2, '0') + '/' +
                     currentDate.getFullYear();


        // Format the time to H:i:s (24-hour format)
        let currentTime = currentDate.toTimeString().split(' ')[0];

        // Get the current day (e.g., Monday)
        let currentDay = currentDate.toLocaleString('en-US', { weekday: 'long' });

        // Define the endpoint for the fetch request
        let url = isCurrentlyClockedIn ? '/clock-out' : '/clock-in';

        // Prepare form data
        let formData = new FormData();
        formData.append('date', currentISODate);  // Y-m-d format
        formData.append('day', currentDay);       // String
        formData.append(isCurrentlyClockedIn ? 'out_time' : 'in_time', currentTime); // H:i:s format

        // Send data to the server
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'You have already clocked in and out today.' || 
                data.message === 'You have already clocked in today.' ||
                data.message === 'You have not clocked in today or already clocked out.') {
                alert(data.message);
                return;
            }

            // Update the button state and persist it in localStorage
            if (isCurrentlyClockedIn) {
                // Clock Out - Update UI and localStorage
                clockButton.textContent = 'Clock In';
                clockButton.classList.remove('clock-out');
                clockButton.classList.add('clock-in');
                clockButton.setAttribute('data-clocked', 'false');
                localStorage.setItem('clockedIn_' + userId, 'false'); // Update the state for this user
            } else {
                // Clock In - Update UI and localStorage
                clockButton.textContent = 'Clock Out';
                clockButton.classList.remove('clock-in');
                clockButton.classList.add('clock-out');
                clockButton.setAttribute('data-clocked', 'true');
                localStorage.setItem('clockedIn_' + userId, 'true'); // Update the state for this user
            }

            // Optional: Refresh the page to reflect updated data
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
});


</script>

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
    @yield('script')
</body>

</html>
