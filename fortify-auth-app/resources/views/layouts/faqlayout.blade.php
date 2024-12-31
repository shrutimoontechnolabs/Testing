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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

<style>
.faq-accordion {
    width: 100%;
}

.faq-item {
    margin-bottom: 15px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.faq-item:hover {
    background-color: #e7e7e7;
}

.faq-question h4 {
    font-size: 16px;
    color: #333;
    margin: 0;
    font-weight: 600;
    display: inline-block;
}

.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.faq-answer {
    display: block;  /* This is now visible by default, controlled by max-height */
    max-height: 0;   /* Initially hidden */
    padding-top: 0;
    padding-bottom: 0;
    background-color: #f0f0f0;
    font-size: 14px;
    overflow: hidden;
    transition: max-height 0.5s ease-out, padding-top 0.3s ease-out, padding-bottom 0.3s ease-out;
}

.faq-item.open .faq-answer {
    max-height: 1000px;  /* Allow content to expand fully */
    padding-top: 10px;
    padding-bottom: 10px;
}

.faq-item.open .faq-question h4 {
    color: #0073aa;
}

.toggle-icon {
    font-size: 20px;
    font-weight: bold;
    transition: transform 0.3s ease;
}

.faq-item.open .toggle-icon {
    transform: rotate(45deg);
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

                                <li class="@yield('activemanagecms')pcoded-trigger ">
                                    <a href="{{route('leaves.adminIndex')}}">
                                        <span class="pcoded-micon"><i class="icofont icofont-support-faq"></i></span>
                                        <span class="pcoded-mtext">
                                             Leave</span>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js"></script>
    <script>
       document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(function(item) {
        item.addEventListener('click', function() {
            this.classList.toggle('open');
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
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all the FAQ question elements
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        // Loop through each question and add an event listener
        faqQuestions.forEach(function(question) {
            question.addEventListener('click', function() {
                // Find the corresponding answer to toggle
                const answer = this.nextElementSibling;
                
                // Toggle the display of the answer
                if (answer.style.display === 'none') {
                    answer.style.display = 'block';
                } else {
                    answer.style.display = 'none';
                }
            });
        });
    });
</script> --}}
</body>

</html>
